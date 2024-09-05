<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



class UsersController extends Controller
{
    public function index()
    {
        return view('content.users.index');
    }

    // public function UsersList(Request $request)
    // {
    //     $columns = [
    //         1 => 'id',
    //         2 => 'username',
    //         3 => 'email',
    //         4 => 'datetime',
    //     ];

    //     $search = [];

    //     $totalData = User::count();

    //     $totalFiltered = $totalData;

    //     $limit = $request->input('length');
    //     $start = $request->input('start');
    //     $order = $columns[$request->input('order.0.column')];
    //     $dir = $request->input('order.0.dir');

    //     if (empty($request->input('search.value'))) {
    //         $users = User::offset($start)
    //             ->limit($limit)
    //             ->orderBy($order, $dir)
    //             ->get();
    //     } else {
    //         $search = $request->input('search.value');

    //         $users = User::where(function ($q) use ($search) {
    //             $q->where('username', 'LIKE', "%{$search}%");
    //             $q->orWhere('email', 'LIKE', "%{$search}%");
    //             $q->orWhere('datetime', 'LIKE', "%{$search}%");
    //         })->offset($start)
    //             ->limit($limit)
    //             ->orderBy($order, $dir)
    //             ->get();

    //         $totalFiltered = User::where(function ($q) use ($search) {
    //             $q->where('username', 'LIKE', "%{$search}%");
    //             $q->orWhere('email', 'LIKE', "%{$search}%");
    //             $q->orWhere('datetime', 'LIKE', "%{$search}%");
    //         })->count();
    //     }

    //     $data = [];

    //     if (!empty($users)) {
    //         // providing a dummy id instead of database ids
    //         $ids = $start;

    //         foreach ($users as $user) {
    //             $nestedData['id'] = $user->id;
    //             $nestedData['username'] = $user->username;
    //             $nestedData['email'] = $user->email;
    //             $nestedData['datetime'] = $user->datetime;

    //             $data[] = $nestedData;
    //         }
    //     }

    //     if ($data) {
    //         return response()->json([
    //             'draw' => intval($request->input('draw')),
    //             'recordsTotal' => intval($totalData),
    //             'recordsFiltered' => intval($totalFiltered),
    //             'code' => 200,
    //             'data' => $data,
    //         ]);
    //     } else {
    //         return response()->json([
    //             'message' => 'Internal Server Error',
    //             'code' => 500,
    //             'data' => [],
    //         ]);
    //     }
    // }



    public function UsersList(Request $request)
    {
        $columns = [
            1 => 'id',
            2 => 'username',
            3 => 'email',
            4 => 'datetime',
            5 => 'role',  // Add this column to handle roles
        ];

        $search = [];

        $totalData = User::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $users = User::with('roles')  // Include roles in the query
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $users = User::with('roles')
                ->where(function ($q) use ($search) {
                    $q->where('username', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('datetime', 'LIKE', "%{$search}%");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = User::with('roles')
                ->where(function ($q) use ($search) {
                    $q->where('username', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('datetime', 'LIKE', "%{$search}%");
                })
                ->count();
        }

        $data = [];

        if (!empty($users)) {
            foreach ($users as $user) {
                $nestedData['id'] = $user->id;
                $nestedData['username'] = $user->username;
                $nestedData['email'] = $user->email;
                $nestedData['datetime'] = $user->datetime;
                $nestedData['role'] = $user->roles->pluck('name')->implode(', ');  // Get role names

                $data[] = $nestedData;
            }
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            'code' => 200,
            'data' => $data,
        ]);
    }


    public function create()
    {
        $heading = 'Create a new user';
        $sub_heading = 'You can now create a new user';
        return view('content.users.add', compact('heading', 'sub_heading'));
    }
    public function assign_role($id)
    {
        $heading = 'Assign role';
        $user = User::find($id);
        $userRole = $user->roles->pluck('name')->toArray();
        $roles = Role::latest()->get();

        return view('content.users.assign_role', compact('heading', 'user', 'roles', 'userRole'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'username' => 'required',
            'password' => 'required',
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect()->back()->with('message', 'user created successfully');
    }


    public function update(Request $request)
    {


        $request->validate([
            'email' => 'required',
            'username' => 'required',
            'role' => 'required',
        ]);

        // $data = $request->all();
        // $user =  User::create($data);
        // $user->syncRoles($request->get('role'));
        // return redirect()->back()->with('message', 'user updated  successfully');


        $data = $request->except('role');

        $user = User::create($data);


        // Find role by ID
        $role = Role::findById($request->get('role'));

        // Assign role by its name
        $user->syncRoles($role->name);

        return redirect()->back()->with('message', 'User updated successfully');
    }


    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        return view('content.users.index', compact('user'));
    }

    public function makeAdmin($id)
    {
        $user = User::find($id);
        if ($user) {
            if ($user->is_admin == 0) {
                $var = 'admin';
                $user->is_admin = 1;
            } else {
                $var = 'not admin';
                $user->is_admin = 0;
            }
        }
        $user->save();
        return redirect()->back()->with('message', 'now user is ' . $var);
    }
    public function verifyUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->email_verified_at = time();
            $user->save();
        }
        $user->save();
        return redirect()->back()->with('message', 'now user is verified ');
    }
}
