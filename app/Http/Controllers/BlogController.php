<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            // Handle file upload
            $imageName = null;
            if ($image = $request->file('image')) {
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
            }

            // Create the blog entry
            $blog = Blog::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'image' => $imageName,
            ]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Blog added successfully',
                'data' => $blog,
            ], 200);
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Failed to create blog. Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function index()
    {
        $blogs = Blog::all();
        return response()->json([
            'success' => true,
            'message' => 'Blogs fetched successfully',
            'data' => $blogs,
        ]);
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        // You can pass $blog to the view if needed
        return response()->json([
            'success' => true,
            'data' => $blog,
        ]);
    }



    public function update(Request $request, $id)
{
    try {
        // Validate the request
        $validated = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Find the blog by ID
        $blogs = Blog::findOrFail($id);

        // Handle file upload and update the image if necessary
        if ($image = $request->file('image')) {
            if ($blogs->image && file_exists(public_path('images/' . $blogs->image))) {
                unlink(public_path('images/' . $blogs->image)); // Delete the old image
            }

            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $blogs->image = $imageName; // Update image field
        }

        // Update other fields
        $blogs->title = $validated['title'];
        $blogs->description = $validated['description'];

        // Save the updated blog
        $blogs->save();

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Blog updated successfully',
            'data' => $blogs
        ], 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Handle not found error
        return response()->json([
            'success' => false,
            'message' => 'Blog not found',
        ], 404);
    } catch (\Exception $e) {
        // Handle general errors
        return response()->json([
            'success' => false,
            'message' => 'Failed to update blog. Error: ' . $e->getMessage(),
        ], 500);
    }
}

    public function delete($id)
{
    try {
        // Find the blog by ID
        $blog = Blog::findOrFail($id);

        // Delete the associated image if it exists
        if ($blog->image && file_exists(public_path('images/' . $blog->image))) {
            unlink(public_path('images/' . $blog->image));
        }

        // Delete the blog
        $blog->delete();

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully',
        ], 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Handle not found error
        return response()->json([
            'success' => false,
            'message' => 'Blog not found',
        ], 404);
    } catch (\Exception $e) {
        // Handle general errors
        return response()->json([
            'success' => false,
            'message' => 'Failed to delete blog. Error: ' . $e->getMessage(),
        ], 500);
    }
}

    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Blog showed successfully',
            'data' => $blog
        ], 200);
    }
}
