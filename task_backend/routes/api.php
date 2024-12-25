<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;


// Endpoint for user registration and token generation
// This route creates a new user with random details using the Faker library and returns an auth token.
// Users can save this token and use it to perform authenticated operations in POSTMAN.
Route::any("user/register",function(){
    $faker = Faker\Factory::create();

    $user = new User();
    $user->name = $faker->name;
    $user->email = $faker->unique()->safeEmail;
    $user->password = Hash::make('password');
    if($user->save()){
       $token = $user->createToken("auth_token")->plainTextToken;
        return response()->json([
            "success"=>"success",
            "data" => $user,
            "token" => $token,
            "message" => "User created Successfully"
        ]);
    }
    return response()->json([
        "success"=> "failed",
        "message"=> "Failed to create User"
    ]);
});
// Routes for category operations
// These routes are prefixed with 'api/category' and require authentication via Sanctum tokens.
// Users must include the token in their requests to access these endpoints.
Route::prefix('category')->middleware('auth:sanctum')->group(function () {
    Route::post('create', [CategoryController::class, 'create']); // Create category

});
// Routes for blog operations
// These routes are prefixed with 'api/blog'. Each endpoint corresponds to a specific blog action.

Route::prefix('blog')->middleware('auth:sanctum')->group(function () {
    Route::get('all', [BlogController::class, 'getAllBlogs'])->name('blog.all'); // Retrieve all blogs
    Route::get('view/{id}', [BlogController::class, 'getBlogById'])->name('blog.view'); // View a single blog by ID
    Route::post('create', [BlogController::class, 'postBlog'])->name('blog.create'); // Create a new blog
    Route::put('update/{id}', [BlogController::class, 'updateBlog'])->name('blog.update'); // Update an existing blog
    Route::delete('delete/{id}', [BlogController::class, 'deleteBlog'])->name('blog.delete'); // Delete a blog
});




