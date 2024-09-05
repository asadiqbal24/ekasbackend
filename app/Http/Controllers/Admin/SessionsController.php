<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\SessionReport;

class SessionsController extends Controller
{


    public function appointment_list()
    {
        $appointments = Appointment::orderby('id', 'DESC')->with('user')->with('appointments_date')->get();
    //    dd($appointments);
        return view('appointments.index', compact('appointments'));
    }

    public function user_session_report($id)
    {
        $session = Appointment::find($id);

        return view('appointments.user_session_report', compact('session'));
    }

    public function user_session_report_store(Request $request)
    {



        $session = new SessionReport();
        if ($request->hasFile('userfile')) {
            $filenamewithext = $request->file('userfile')->getClientOriginalName();
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
            $extension = $request->file('userfile')->getClientOriginalExtension();
            $FileNameApplicant = $filename . '-' . time() . '.' . $extension;
            $path = $request->file('userfile')->storeAs('public/Customer/SessionReport/', $FileNameApplicant);
            $session->file = $FileNameApplicant;
        }

        $session->appointment_id = $request->appointment_id;
        $session->user_id = $request->user_id;

        $session->save();
        return redirect()->back()->with('success', 'Report Created Successfully');
    }









    public function index()
    {
        $single = singlesession::all()->map(function ($item) {
            $item = $item->toArray();
            $item['source'] = 'single';
            return $item;
        })->toArray();
        $bundle1 = bundle1::all()->map(function ($item) {
            $item = $item->toArray();
            $item['source'] = 'bundle1';
            return $item;
        })->toArray();
        $bundle2 = bundle2::all()->map(function ($item) {
            $item = $item->toArray();
            $item['source'] = 'bundle2';
            return $item;
        })->toArray();
        $sessions = array_merge($single, $bundle1, $bundle2);
        return view('content.sessions.index', compact('sessions'));
    }

    public function sessionList(Request $request)
    {
        $columns = [
        1 => 'id',
        2 => 'username',
        3 => 'email',
        4 => 'datetime',
        ];

        $search = [];

        $totalData = User::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
        $users = User::offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        } else {
        $search = $request->input('search.value');

        $users = User::where(function($q) use ($search){
            $q->where('username', 'LIKE', "%{$search}%");
            $q->orWhere('email', 'LIKE', "%{$search}%");
            $q->orWhere('datetime', 'LIKE', "%{$search}%");

        })->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $totalFiltered = User::where(function($q) use ($search){
            $q->where('username', 'LIKE', "%{$search}%");
            $q->orWhere('email', 'LIKE', "%{$search}%");
            $q->orWhere('datetime', 'LIKE', "%{$search}%");

        })->count();
        }

        $data = [];

        if (!empty($users)) {
        // providing a dummy id instead of database ids
        $ids = $start;

        foreach ($users as $user) {
            $nestedData['id'] = $user->id;
            $nestedData['username'] = $user->username;
            $nestedData['email'] = $user->email;
            $nestedData['datetime'] = $user->datetime;

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


    public function create($name)
    {
        return view('content.sessions.add', compact('name'));
    }
    public function store(Request $request, $name)
    {
        $request->validate([
            'price' => 'required|integer',
            'minutes' => 'required|integer',
            'session' => 'required|integer',
        ]);
        if ($name == 'singlesession') {
            singlesession::create($request->all());
        } elseif ($name == 'bundle1') {
            bundle1::create($request->all());
        } else {
            bundle2::create($request->all());
        }
        return redirect()->back()->with('message', 'Record created successfully.');
    }
    public function edit($itemId, $itemSource)
    {
        switch ($itemSource) {
            case 'single':
                $session = singlesession::find($itemId);
                break;
            case 'bundle1':
                $session =  bundle1::find($itemId);
                break;
            case 'bundle2':
                $session =  bundle2::find($itemId);
                break;
            default:
                return redirect()->back()->with('message', 'data not found.');
                break;
        }
        return view('content.sessions.edit', compact('session', 'itemSource'));
    }
    public function update(Request $request, $id, $modelName)
    {

        $request->validate([
            'price' => 'required',
            'minutes' => 'required',
            'session' => 'required',
        ]);
        if($modelName == 'single') {
            $modelName = 'singlesession';
        }
        $validModels = ['singlesession', 'bundle1', 'bundle2'];
        if (!in_array($modelName, $validModels)) {
            abort(404, "Invalid model name.");
        }

        // Resolve the full model class name. Adjust the namespace based on your application structure
        $modelClass = "App\\Models\\" . $modelName;

        // Fetch the model instance
        $modelInstance = $modelClass::findOrFail($id);

        // Update the model instance
        $modelInstance->update($request->all()); // Make sure to validate your data as needed

        // Redirect or return a response
        return redirect()->back()->with('message', 'Record updated successfully!');
    }
    public function delete($itemId, $itemSource)
    {
        switch ($itemSource) {
            case 'single':
                singlesession::find($itemId)->delete();
                break;
            case 'bundle1':
                bundle1::find($itemId)->delete();
                break;
            case 'bundle2':
                bundle2::find($itemId)->delete();
                break;
            default:
                return redirect()->back()->with('message', 'data not found.');
                break;
        }
        return redirect()->back()->with('message', 'Record deleted successfully.');
    }
}
