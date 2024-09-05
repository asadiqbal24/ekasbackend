<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TempTransaction;
use Illuminate\Http\Request;
use App\Services\StripeService;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
// use Stripe;
use Session;
use App\Models\Appointment;

class StripeController extends Controller
{
    // protected $stripeService;

    // public function __construct(StripeService $stripeService)
    // {
    //     $this->stripeService = $stripeService;
    // }

    // public function index()
    // {
    //     $customers = $this->stripeService->getCustomers();
    //     return response()->json($customers);
    // }

    // public function webhook(Request $request)
    // {
    //     $payload = $request->getContent();
    //     $event = null;

    //     try {
    //         $event = \Stripe\Event::constructFrom(
    //             json_decode($payload, true)
    //         );
    //     } catch (\UnexpectedValueException $e) {
    //         return response()->json(['error' => 'Invalid payload'], 400);
    //     }

    //     switch ($event->type) {
    //         case 'checkout.session.completed':
    //             $this->handleCheckoutSessionCompleted($event->data->object);
    //             break;

    //         case 'charge.updated':
    //             $this->handleChargeUpdated($event->data->object);
    //             break;

    //         default:
    //             Log::info('Unhandled event type', ['type' => $event->type]);
    //     }
    //     return response()->json(['status' => 'success'], 200);
    // }

    // public function handleCheckoutSessionCompleted($session)
    // {
    //     $tempTrans = TempTransaction::where('email' , '=' , $session->customer_details->email)->first();
    //     $transaction = new Transaction([
    //         'payment_intent' => $session->payment_intent,
    //         'amount' => $session->amount_total / 100,
    //         'currency' => $session->currency,
    //         'status' => $session->payment_status,
    //         'service' => $tempTrans->service,
    //         'selected_date' => $tempTrans->selected_date,
    //         'guidance_package' => $tempTrans->guidance_package,
    //         'phone' => $tempTrans->phone,
    //     ]);
    //     if (isset($session->customer_details)) {
    //         $transaction->email = $session->customer_details->email ?? null;
    //         $transaction->name = $session->customer_details->name ?? null;
    //     }
    //     $transaction->save();
    //     $tempTrans->delete();
    // }

    // protected function handleChargeUpdated($charge)
    // {
    //     $transaction = Transaction::where('payment_intent', $charge->payment_intent)->first();

    //     if ($transaction) {
    //         // Update transaction with receipt URL and other details if needed
    //         $transaction->receipt_url = $charge->receipt_url;
    //         $transaction->save();

    //         Log::info('Transaction updated with receipt URL', ['id' => $transaction->id]);
    //     } else {
    //         Log::warning('Transaction not found for updated charge', ['payment_intent' => $charge->payment_intent]);
    //     }
    // }

    // 
    public function getPaymentDetails()
    {
        return view('content.payments.index');
    }

    public function paymentsList(Request $request)
    {
        $columns = [
        1 => 'id',
        2 => 'email',
        3 => 'amount',
        4 => 'currency',
        5 => 'status',
        6 => 'phone_no',
        7 => 'service_type',
        8 => 'date',
        9 => 'package',
        ];

        $search = [];

        $totalData = Appointment::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
        $users = Appointment::offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        } else {
        $search = $request->input('search.value');

        $users = Appointment::where(function($q) use ($search){
            $q->where('email', 'LIKE', "%{$search}%");
            $q->orWhere('amount', 'LIKE', "%{$search}%");
            $q->orWhere('currency', 'LIKE', "%{$search}%");
            $q->orWhere('status', 'LIKE', "%{$search}%");
            $q->orWhere('phone_no', 'LIKE', "%{$search}%");
            $q->orWhere('service_type', 'LIKE', "%{$search}%");
            $q->orWhere('date', 'LIKE', "%{$search}%");
            $q->orWhere('package', 'LIKE', "%{$search}%");
        })->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $totalFiltered = Appointment::where(function($q) use ($search){
            $q->where('email', 'LIKE', "%{$search}%");
            $q->orWhere('amount', 'LIKE', "%{$search}%");
            $q->orWhere('currency', 'LIKE', "%{$search}%");
            $q->orWhere('status', 'LIKE', "%{$search}%");
            $q->orWhere('phone_no', 'LIKE', "%{$search}%");
            $q->orWhere('service_type', 'LIKE', "%{$search}%");
            $q->orWhere('date', 'LIKE', "%{$search}%");
            $q->orWhere('package', 'LIKE', "%{$search}%");

        })->count();
        }

        $data = [];

        if (!empty($users)) {
        // providing a dummy id instead of database ids
        $ids = $start;

        foreach ($users as $user) {
            $nestedData['id'] = $user->id;
        $nestedData['email'] = $user->email;
        $nestedData['amount'] = $user->amount;
        $nestedData['status'] = $user->status;
        $nestedData['phone_no'] = $user->phone_no;
        $nestedData['service_type'] = $user->service_type;
        $nestedData['date'] = $user->date;
        $nestedData['package'] = $user->package;

            $data[] = $nestedData;
        }
        }

        if ($data) {
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            'code' => 200,
            'data' => $data,
        ]);
        } else {
        return response()->json([
            'message' => 'Internal Server Error',
            'code' => 500,
            'data' => [],
        ]);
        }
    }

    public function delete($id)
    {
        $details = Transaction::findOrFail($id);
        return redirect()->back()->with('message', 'Record deleted successfully.');
    }
//     public function getUserData(Request $request)
//     {
//         $request->validate([
//             'service' => 'required',
//             'guidance_package' => 'required',
//             'selected_date' => 'required',
//         ]);
//         TempTransaction::create($request->all());
//         $selectedOption = $request->input('guidance_package');

//         if ($selectedOption === 'single session') {
//             return 'sessionone';
//         } else if ($selectedOption === 'Bundle One') {
//             return 'bundleone';
//         } else if ($selectedOption === 'Bundle Two') {
//             return 'bundletwo';
//         } else {
//             // Handle unexpected option
//             return response('Unexpected option', 400);
//         }
        
//     }


//       public function StripePost(Request $request)
// {
//     try {

       
//        $email= $request->email;
//     //    $amount= 100 * 100;

//         $result = $request->package;
//         $result_explode = explode('|', $result);
//         $package = $result_explode[0];
//         $amount = $result_explode[1];

//         Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
//         $customer = Stripe\Customer::create([
//             "email" => $email,
//             "name" => $request->first_name." ".$request->last_name,
//             "source" => $request->stripeToken
//         ]);
//         $charge = Stripe\Charge::create([
//             "amount" =>$amount*100 ,
//             "currency" => "eur",
//             "customer" => $customer->id,
//         ]);

        

//         Appointment::create([
//             'service_type' => $request->service,
//             'package' => $package,
//             'date' => $request->date,
//             'time' => $request->time,
//             'phone_no' => $request->phone_no,
//             'email' => $email,
//             'payment_mode' => $request->payment_mode,
//             'amount' => $amount,
//             'status' => 'Success',
//             'user_id' => auth()->user()->id
//         ]);
      
//         // Flash success message
//         Session::flash('success', 'Payment successful!');

//         // Redirect back or to a specific route
//         return redirect()->back();
//     } catch (Stripe\Exception\CardException $e) {
//         // Handle card errors
//         Session::flash('error', 'Card error: ' . $e->getMessage());
//         return redirect()->back();
//     } catch (Exception $e) {
//         // Handle other errors
//         Session::flash('error', 'Payment failed: ' . $e->getMessage());
//         return redirect()->back();
//     }
// }

    
}
