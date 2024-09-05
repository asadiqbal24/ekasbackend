<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\singlesession;
use App\Models\bundle1;
use App\Models\bundle2;
use App\Models\Feedback;

class HomeController extends Controller
{
    public function index()
    {
        $singleSession = singlesession::first();
        $bundle1 = bundle1::first();
        $bundle2 = bundle2::first();
        $feedbacks = Feedback::all();
        return view('index', compact('singleSession', 'bundle1', 'bundle2', 'feedbacks'));
    }
}
