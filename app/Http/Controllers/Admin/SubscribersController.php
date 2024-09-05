<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    public function index()
    {
        $subs = Subscriber::all();
        return view('admin.subs.index' , compact('subs'));
    }
    public function delete($id)
    {
        $sub = Subscriber::find($id);
        if($sub){
            $sub->delete();
        }
        return redirect()->back()->with('message' , 'subscriber deleted successfully.');
    }
}
