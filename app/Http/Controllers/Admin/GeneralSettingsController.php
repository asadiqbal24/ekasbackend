<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GeneralSettingsController extends Controller
{
    public function index()
    {
        return view('content.settings.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'mainimage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'site_title' => 'string|nullable',
            'tagline' => 'string|nullable',
            'meta_title' => 'string|nullable',
            'meta_description' => 'string|nullable',
        ]);

        // Handle file uploads
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('dashbord', 'public');
            setting::updateOrCreate(['key' => 'dashboard_logo'], ['value' => $imagePath]);
        }

        if ($request->hasFile('mainimage')) {
            $mainImagePath = $request->file('mainimage')->store('images', 'public');
            setting::updateOrCreate(['key' => 'site_logo'], ['value' => $mainImagePath]);
        }
        if ($request->hasFile('user_dashbord_logo')) {
            $userdashbordpath = $request->file('user_dashbord_logo')->store('images', 'public');
            setting::updateOrCreate(['key' => 'user_dashbord_logo'], ['value' => $userdashbordpath]);
        }
        if ($request->hasFile('user_normal_logo')) {
            $usernormallogo = $request->file('user_normal_logo')->store('images', 'public');
            setting::updateOrCreate(['key' => 'user_normal_logo'], ['value' => $usernormallogo]);
        }
        if ($request->hasFile('user_logged_in_logo')) {
            $userloggedinlogo = $request->file('user_logged_in_logo')->store('images', 'public');
            setting::updateOrCreate(['key' => 'user_logged_in_logo'], ['value' => $userloggedinlogo]);
        }
        
        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon')->store('images', 'public');
            setting::updateOrCreate(['key' => 'favicon'], ['value' => $favicon]);
        }

        // Handle text inputs
        setting::updateOrCreate(['key' => 'site_title'], ['value' => $request->input('site_title')]);
        setting::updateOrCreate(['key' => 'tagline'], ['value' => $request->input('tagline')]);
        setting::updateOrCreate(['key' => 'meta_title'], ['value' => $request->input('meta_title')]);
        setting::updateOrCreate(['key' => 'meta_description'], ['value' => $request->input('meta_description')]);

        return redirect()->back();
    }

    // 
    public function profileSettings()
    {
        return view('content.settings.profile-settings');
        // return view('admin.settings.profile-settings');
    }
    public function updateSetting(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with(['error' , 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->password);
        $user->email = $request->email;

        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }
}
