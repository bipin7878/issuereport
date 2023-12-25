<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issuerecord;

class IssuerecordController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'issuetitle' => 'required|string|max:255',
            'description' => 'required|string',
            'attached_files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'priority' => 'required|string|in:highest,high,medium,low,lowest',
            'reportedname' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Handle file uploads
        $attachedFiles = [];
        if ($request->hasFile('attached_files')) {
            foreach ($request->file('attached_files') as $file) {
                $path = $file->store('attachments', 'public');
                // Get the file name from the path
        $filename = pathinfo($path, PATHINFO_FILENAME);
        
        // Get the file extension
        $extension = $file->extension();
        
        // Build the URL for the file
        $url = asset("storage/attachments/{$filename}.{$extension}");
                $attachedFiles[] = $url;
            }
        }

        // Store data in the database using the Issuerecord model
        $issueRecord = Issuerecord::create([
            'issuetitle' => $request->input('issuetitle'),
            'description' => $request->input('description'),
            'attached_files' => $attachedFiles,
            'priority' => $request->input('priority'),
            'reportedname' => $request->input('reportedname'),
            'email' => $request->input('email'),
        ]);

        return response()->json(['message' => 'Issue record submitted successfully', 'data' => $issueRecord], 201);
 
    }
    // app/Http/Controllers/IssuerecordController.php

public function show()
{
    $issuerecords = Issuerecord::all();
    return response()->json(['issuerecords' => $issuerecords], 200);
}

}
