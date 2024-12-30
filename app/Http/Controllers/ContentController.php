<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    public function index()
    {
        try {
            $contents = Content::all();

            if ($contents->isEmpty()) {
                return response()->json(['error' => 'No content records found'], 404);
            }

            return response()->json(['data' => $contents], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $content = Content::create($request->all());

            return response()->json(['message' => 'Content created successfully!', 'data' => $content], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to create content'], 500);
        }
    }
    public function show(Content $content)
    {
        try {
            return response()->json(['data' => $content], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function update(Request $request, Content $content)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'sometimes|string',
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $content->update($validator->validated());

            return response()->json(['message' => 'Content updated successfully!', 'data' => $content], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to update content'], 500);
        }
    }

    public function destroy(Content $content)
    {
        try {
            $content->delete();

            return response()->json(['message' => 'Content deleted successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to delete content'], 500);
        }
    }
}
