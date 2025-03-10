<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogController extends Controller
{
    public function index()
    {
        try {
            $blogs = Blog::orderBy('id', 'desc')->get();

            if ($blogs->isEmpty()) {
                return response()->json(['error' => 'No blogs found'], 404);
            }

            return response()->json(['blogs' => $blogs], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $blog = Blog::create($request->all());

            return response()->json(['message' => 'Blog created successfully', 'blog' => $blog], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to create blog'], 500);
        }
    }
    public function show(string $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            return response()->json(['blog' => $blog], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No blog found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $blog = Blog::findOrFail($id);

            $blog->update($request->all());

            return response()->json(['message' => 'Blog updated successfully', 'blog' => $blog], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No blog found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to update blog'], 500);
        }
    }
    public function destroy(Request $request)
    {
        $blogIds = $request->id;

        try {
            foreach ($blogIds as $blogId) {
                $blog = Blog::findOrFail($blogId);
                $blog->delete();
            }

            return response()->json(['message' => 'Blogs deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'One or more blogs not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to delete blogs'], 500);
        }
    }
}
