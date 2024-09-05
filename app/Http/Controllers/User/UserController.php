<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AddCourse;
use App\Models\Todo;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;

class UserController extends Controller
{
    public function getTodos()
    {
        $userId = auth()->id();
        $todos = Todo::where('user_id', $userId)->get();
        return response()->json(['todos' => $todos]);
    }
    public function dashboard()
    {
        if (auth()->check()) {
            $userId = auth()->id();
            $wishlistEntries = Wishlist::where('userID', $userId)->get();
            $wishlistCourseIds = $wishlistEntries->pluck('courseId')->toArray();
            $courses = AddCourse::whereIn('id', $wishlistCourseIds)->get();
            $soon = Carbon::now()->addDays(3);
            $courses->each(function ($course) use ($soon) {
                $course->inWishlist = true;
                $course->expiringSoon = $course->ApplicationDeadline >= Carbon::now() && $course->ApplicationDeadline <= $soon;
            });
            $todos = Todo::where('user_id', $userId)->get();
        }
        return view('user.dashboard', compact('courses', 'todos'));
    }
    public function profile()
    {
        return view('user.profile');
    }
    public function updateInfo(Request $request)
    {
        $user = User::find(Auth::id());
        $data = $request->all();

        if (!empty($data['old_password'])) {
            if (Hash::check($data['old_password'], $user->password)) {
                if (!empty($data['password']) && !empty($data['password_confirmation'])) {
                    if ($data['password'] === $data['password_confirmation']) {
                        $user->password = Hash::make($data['password']);
                        $user->save();
                        return redirect()->back()->with('success', 'Password updated successfully.');
                    } else {
                        return redirect()->back()->with('error', 'New passwords do not match.');
                    }
                } else {
                    return redirect()->back()->with('error', 'New password and confirmation are required.');
                }
            } else {
                return redirect()->back()->with('error', 'Your current password does not match the password you provided. Please try again.');
            }
        } else {
            unset($data['password'], $data['password_confirmation'], $data['old_password']);
            $user->update($data);
            return redirect()->back()->with('success', 'Profile updated successfully.');
        }
    }

    public function addToList(Request $request)
    {
        $request->validate([
            'task_description' => 'required',
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::id();
        Todo::create($data);
        return response()->json(['message' => 'To do list added successfully.']);
    }
    public function deleteToList($id)
    {
        Todo::where('id', $id)->where('user_id', Auth::id())->first()->delete();
        return response()->json(['success' => true]);
    }
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required']);
        DB::table('subscribe')->insert(['email' => $request->email]);
        return redirect()->back()->with('success', 'Subscribed successfully.');
    }

    public function processPayment(Request $request)
    {
        if(auth()->check()){

        
            $request->validate([
                'stripeToken' => 'required',
                // 'name' => 'required',
                'email' => 'required',
                'guidance_country' => 'required',
                
            ]);

            Stripe::setApiKey(env('STRIPE_SECRET'));
            $type = $request->input('type');

            try {
                if($type == 'ekas' ){
                   
                    $customer = Customer::create([
                        "email" => $request->input('email'),
                        "name" => $request->first_name." ".$request->last_name,
                        "source" => $request->stripeToken
                    ]);

                    $charge = Charge::create([
                        "amount" =>100 ,
                        "currency" => "eur",
                        'description' => 'EKAS Guidance Document Payment',
                        "customer" => $customer->id,
                    ]);

                }
                

                DB::table('user_guidance_country_document')->insert([
                    // 'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'guidance_country' => $request->input('guidance_country'),
                    'user_id' => auth()->user()->id,
                    'created_at' => Carbon::now()
                ]);

                return response()->json(['success' => true, 'message' => 'Payment successful!']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Payment failed! ' . $e->getMessage()], 500);
            }
        }else{
            return response()->json(['success' => false, 'message' => 'Not authenticated! ' . $e->getMessage()], 500);
        }
    }

    public function downloadGuidancePDF(Request $request, $country, $type) {

        if(auth()->check()){

            $userDocPayment = DB::table('user_guidance_country_document')->where('user_id',auth()->user()->id)->where('guidance_country',$country)->first();

            if($userDocPayment){
                $filePath = storage_path('app/pdfs/'.$type.'/'.$country.'.pdf');
                // dd($filePath);
        
                // Check if file exists (optional)
                if (!file_exists($filePath)) {
                return abort(404); // Shortcut for non-existent file
                }
            
                // Download the file directly
               
                $fileName = ucfirst($country) . " " . ucfirst($type) . " Guide.pdf";
                $headers = [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . $fileName . '"'
                ];

                return  response()->make(file_get_contents($filePath), 200, $headers);
            }
        }

        
      }
}



// CREATE TABLE `ekas`.`user_guidance_country_document` (`name` TEXT NULL DEFAULT NULL , `email` TEXT NULL DEFAULT NULL , `guidance_country` TEXT NULL DEFAULT NULL , `user_id` INT NULL DEFAULT NULL , `payment_status` INT NULL DEFAULT '1' , `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , `id` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`))