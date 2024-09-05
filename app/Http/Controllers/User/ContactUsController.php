<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('content.contact-us.index' , compact('contacts'));
    }
    public function contactUs(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
        Contact::create($request->all());
        return redirect()->back()->with('success', 'Contact Form Submitted Successfully');
    }
    public function view($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contact-us.view' , compact('contact'));
    }
    public function delete($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Record Deleted Successfully');
    }
}
