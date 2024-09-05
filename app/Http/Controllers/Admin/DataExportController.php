<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\CourseExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DataExportController extends Controller
{
    public function export()
    {
        return Excel::download(new CourseExport, 'courses.xlsx');
    }
}
