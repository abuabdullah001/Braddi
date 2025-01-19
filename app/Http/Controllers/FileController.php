<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function store(Request $request)
{
    $file = $request->file('zip_file');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $filePath = $file->storeAs('images', $fileName, 'public'); // Store in the 'public/images' directory
    $fileUrl = asset('storage/' . $filePath); // Generate a public URL for the file

    File::create([
        'sr_no' => $request->sr_no,
        'name' => $request->name,
        'category' => json_encode($request->category),
        'meta_tags' => json_encode($request->meta_tags),
        'file_url' => $fileUrl,
        'file_name' => $fileName,
        'file_path' => $filePath,
    ]);

    return redirect()->route('file.index')->with('success', 'Zip file uploaded successfully!');
}

public function index()
{
    $zipFiles = File::all()->map(function ($file) {
        $file->meta_tags = json_decode($file->meta_tags);
        return $file;
    });

    return view('file.index', compact('zipFiles'));
}

public function create(){
    return view('file.create');
}

public function show($id)
{
    $file = File::findOrFail($id);

    // Ensure meta_tags is decoded only if it's a JSON string
    if (is_string($file->meta_tags)) {
        $file->meta_tags = json_decode($file->meta_tags, true);
    }

    return view('file.show', ['zipFile' => $file]);
}
public function delete($id)
{
    $file = File::findOrFail($id);

   $file->delete();

    return view('file.show', ['zipFile' => $file]);
}

public function edit($id)
{
    $file = File::findOrFail($id);

    // Decode JSON fields into arrays
    $file->category = json_decode($file->category, true) ?? [];
    $file->meta_tags = json_decode($file->meta_tags, true) ?? [];

    return view('file.edit', compact('file'));
}
/**
 * Update the specified file in the database and replace the file if uploaded.
 */
public function update(Request $request, $id)
{
    $file = File::findOrFail($id);

    // Update fields from the request
    $file->sr_no = $request->sr_no;
    $file->name = $request->name;
    $file->category = json_encode($request->category);
    $file->meta_tags = json_encode($request->meta_tags);

    // Handle file upload if a new file is provided
    if ($request->hasFile('zip_file')) {
        $uploadedFile = $request->file('zip_file');

        // Generate file name and store the file
        $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
        $filePath = $uploadedFile->storeAs('images', $fileName, 'public');
        $fileUrl = asset('storage/' . $filePath);

        // Delete the old file if it exists
        if ($file->file_path && \Storage::disk('public')->exists($file->file_path)) {
            \Storage::disk('public')->delete($file->file_path);
        }

        // Update file-related fields
        $file->file_url = $fileUrl;
        $file->file_name = $fileName;
        $file->file_path = $filePath;
    }

    // Save updated file record
    $file->save();

    return redirect()->route('file.index')->with('success', 'File updated successfully!');
}



}
