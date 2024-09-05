<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddCourse;
use App\Models\Blog;
use App\Models\Feedback;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function adminLogin()
    {
        return view('admin.auth.login');
    }
    public function index()
    {
        $subscribers = Subscriber::all()->count();
        $courses = AddCourse::all()->count();
        $blogs = Blog::all()->count();
        $feedbacks = Feedback::all()->count();
        $users = User::all()->count();
        return view('admin.index', compact('subscribers', 'courses', 'feedbacks', 'blogs', 'users'));
    }
}
