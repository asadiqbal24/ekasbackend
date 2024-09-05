<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddCourse;
use App\Models\Blog;
use App\Models\Feedback;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\Appointment;

class Analytics extends Controller
{
  public function index()
  {
    $subscribers = Subscriber::all()->count();
    $courses = AddCourse::all()->count();
    $blogs = Blog::all()->count();
    $feedbacks = Feedback::all()->count();
    $users = User::all()->count();
    $payments = Appointment::sum('amount');

    return view('content.dashboard.dashboards-analytics', compact('subscribers', 'courses', 'feedbacks', 'blogs', 'users','payments'));
  }
}
