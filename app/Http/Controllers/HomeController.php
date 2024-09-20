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

    // public function document_checker_pdf($id)
    // {
    //     //dd($id);
    //     $documents = DB::table('user_document_checker')
    //         ->where('id', $id)->first();
    //     // dd($documents);

    //     return view('documentchecker.checker_pdf', compact('documents'));
    //     // dd($documents);
    // }






    public function ekas_guidance_list()
    {
        $ekas_guidance_document = UserGuidanceDocuments::where('status', '=', 'Active')->get();
        return view('ekas_guidance_document.index', compact('ekas_guidance_document'));
    }

    public function ekas_guidance_delete($id)
    {

        $updated = DB::table('user_guidance_country_document')
            ->where('id', $id)
            ->update(['status' => 'InActive']);
        if ($updated) {
            return response()->json(['message' => 'Record updated successfully']);
        } else {
            return response()->json(['error' => 'Record not found or already deleted'], 404);
        }
    }


    public function approve(Request $request)
    {
        $this->saveDocumentStatus($request->user_doc_id, $request->file_name, $request->field, 'approved');
        return redirect()->back()->with('success', 'Document approved successfully.');
    }

    public function disapprove(Request $request)
    {
        $this->saveDocumentStatus($request->user_doc_id, $request->file_name, $request->field, 'disapproved');
        return redirect()->back()->with('success', 'Document disapproved successfully.');
    }

    private function saveDocumentStatus($userDocId, $fileName, $field, $status)
    {
        DB::table('user_document_checker_status')->updateOrInsert(
            ['user_doc_id' => $userDocId, 'file_name' => $fileName],
            ['status' => $status]
        );
    }


    // public function document_checker_pdf($id)
    // {
    //     $documents = DB::table('user_document_checker')->where('id', $id)->first();

    //     // Fetch document statuses for this user
    //     $documentStatuses = DB::table('user_document_checker_status')
    //         ->where('user_doc_id', $documents->id)
    //         ->get()
    //         ->keyBy('file_name'); // Use file_name as key for easy access

    //     // Pass the data to the view
    //     return view('documentchecker.checker_pdf', compact('documents', 'documentStatuses'));
    // }


    public function document_checker_pdf($id)
    {
        // Fetch documents for the user
        $documents = DB::table('user_document_checker')->where('id', $id)->first();

        // Fetch document statuses for the user's documents
        $documentStatuses = DB::table('user_document_checker_status')
            ->where('user_doc_id', $id)
            ->get()
            ->keyBy('file_name'); // Assuming 'file_name' is the field storing the document name

        $documentFields = [
            'updated_cv' => 'Updated CV',
            'visa_application_form' => 'Visa Application Form',
            'passport' => 'Passport',
            'masters_degree' => 'Master’s Degree',
            'masters_degree_transcript' => 'Master’s Degree Transcript',
            'bachelors_degree' => 'Bachelor’s Degree',
            'bachelors_degree_transcript' => 'Bachelor’s Degree Transcript',
            'metric_gcse_diploma' => 'Metric/GCSE Diploma',
            'higher_secondary_a_level_diploma' => 'Higher Secondary/A-Level Diploma',
            'english_language_test' => 'English Language Test',
            'recommendation_letter' => 'Recommendation Letter',
            'letter_of_acceptance' => 'Letter of Acceptance',
            'proof_of_financial_support' => 'Proof of Financial Support',
            'hec_attestations_or_equivalency' => 'HEC Attestations or Equivalency',
            'any_other_document' => 'Any Other Document'
            ];

        return view('documentchecker.checker_pdf', compact('documents', 'documentStatuses', 'documentFields'));
    }
}
