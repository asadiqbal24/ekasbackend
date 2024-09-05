<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddNotification;
use App\Events\NotificationEvent;

class NotificationController extends Controller
{
    public function notification_list()
    {

        $notificationData = AddNotification::orderby('id', 'desc')->get();
        return view('notification.index', compact('notificationData'));
    }
    public function addnotification()
    {
        return view('notification.add_notification');
    }

    public function notificationstore(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',

        ]);

        AddNotification::create($request->all());
          
        /* code for send real time notification */  

        // $data = [
        //     'title' => $request->title,
        //     'description' => $request->description,
        // ];
        // event(new NotificationEvent($data));
        return redirect()->back()->with('success', 'Notification added successfully.');
    }




    public function Notificationdelete($id)
    {
        $notification = AddNotification::find($id);

        if ($notification) {
            $notification->delete();
            return response()->json(['message' => 'Record deleted successfully.']);
        }

        return response()->json(['message' => 'Record not found.'], 404);
    }

    public function sendNotification(Request $request)
    {
        $title = $request->input('title');
        $description = $request->input('description');

        $data = [
            'title' => $title,
            'description' => $description,
        ];
        event(new NotificationEvent($data));
        return response()->json(['status' => 'Notification sent successfully!']);
    }
}
