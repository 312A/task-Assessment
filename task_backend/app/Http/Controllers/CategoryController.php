<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255', // Ensure name is required and valid
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()
            ]);
        }

        // Create the category
        $category = new Category();
        $category->name = $request->input('name');

        if ($category->save()) {
            return response()->json([
                'status' => 'success',
                'category' => $category,
                'message' => 'Category created successfully'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Category creation failed'
        ]);
    }
}
