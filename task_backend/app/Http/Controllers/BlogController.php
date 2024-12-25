<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    // Get all blogs
    public function getAllBlogs()
    {
        $blogs = Blogs::with('category')->get();

        return response()->json([
            'status' => 'success',
            'data' => $blogs
        ]);
    }

    // Get blog by ID
    public function getBlogById($id)
    {
        $blog = Blogs::with('category')->find($id);

        if ($blog) {
            return response()->json([
                'status' => 'success',
                'data' => $blog
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Blog not found'
        ], 404);
    }

    // Create a new blog
    public function postBlog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Ensure category exists
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $blog = new Blogs();
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
        $blog->category_id = $request->input('category_id');

        if ($blog->save()) {
            $blog->load('category');
            return response()->json([
                'status' => 'success',
                'data' => $blog,
                'message' => 'Blog created successfully'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to create blog'
        ]);
    }

    // Update an existing blog
    public function updateBlog(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $blog = Blogs::find($id);

        if (!$blog) {
            return response()->json([
                'status' => 'error',
                'message' => 'Blog not found'
            ], 404);
        }

        $blog->update($request->only(['title', 'description', 'category_id']));

        return response()->json([
            'status' => 'success',
            'data' => $blog,
            'message' => 'Blog updated successfully'
        ]);
    }
}
