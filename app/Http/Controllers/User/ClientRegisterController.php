<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClientRegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:clients,email', // assuming 'users' is your table name
            'password' => 'required|min:8|confirmed',
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female ,Other', // Add other genders if needed
            'level' => 'required|string',
            'looking' => 'required|array',
            'looking.*' => 'required|string|distinct', // If you want each array element to be string and distinct
            'number' => 'required|digits_between:10,15', // Adjust according to your country's number format
            'address' => 'required|string|max:255',
            'postcode' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'terms_agreed' => 'required|in:yes', // Make sure only 'yes' is considered as agreed
        ]);
        $data = $request->all();
        $data = $request->except('password_confirmation');
        $data['looking'] = serialize($data['looking']);
        $data['password'] = Hash::make($request->password);
        $user = Client::create($data);
        Auth::guard('cus')->login($user);
        return redirect()->intended('/');
    }
}
