// app/Http/Controllers/DocumentCheckerController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentCheckerController extends Controller
{
    public function showForm()
    {
        return view('document-checker-form');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'service' => 'required',
            'selected_date' => 'required|date',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'guidance_package' => 'required',
            'documents' => 'required|array',
            'documents.*' => 'file|mimes:pdf,doc,docx,jpg,png|max:2048'
        ]);

        // Process the uploaded documents and form data

        return back()->with('success', 'Form submitted successfully!');
    }
}
