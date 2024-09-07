<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserGuidanceDocuments;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function document_checker()
    {
        $user_document_checker = DB::table('user_document_checker')->where('status', '=', 'Success')->get();
        return view('documentchecker.index', compact('user_document_checker'));
    }

    public function document_checker_delete($id)
    {
        $updated = DB::table('user_document_checker')
            ->where('id', $id)
            ->update(['status' => 'Deleted']);
        if ($updated) {
            return response()->json(['message' => 'Record updated successfully']);
        } else {
            return response()->json(['error' => 'Record not found or already deleted'], 404);
        }
    }

    public function ekas_guidance_list()
    {
        $ekas_guidance_document = UserGuidanceDocuments::where('status', '=', 'Active')->get();
        return view('ekas_guidance_document.index', compact('ekas_guidance_document'));
    }

    public function ekas_guidance_delete($id) {

        $updated = DB::table('user_guidance_country_document')
        ->where('id', $id)
        ->update(['status' => 'InActive']);
        if ($updated) {
            return response()->json(['message' => 'Record updated successfully']);
        } else {
            return response()->json(['error' => 'Record not found or already deleted'], 404);
        }
    }
}
