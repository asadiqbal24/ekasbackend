<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('content.feedback.index' , compact('feedbacks'));
    }
    public function create()
    {
        $subheading = 'You can add your Feedbacks here';
        $heading = 'Add a new Feedback';
        return view('content.feedback.add' , compact('heading', 'subheading'));
    }
    public function view($id)
    {
        $feedback = Feedback::find($id);
        return view('content.feedback.show' , compact('feedback'));
    }
    public function delete($id)
    {
        $feedback = Feedback::find($id);
        if($feedback){
            $feedback->delete();
        }
        return redirect()->back()->with('message' , 'Feedback deleted successfully.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'review' => 'required',
            'name' => 'required',
            'image' => 'required|image',
        ]);
        $data = $request->all();
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('images' , 'public');
        }
        Feedback::create($data);
        return redirect()->back()->with('message' , 'Feedback created successfully.');
    }
}
