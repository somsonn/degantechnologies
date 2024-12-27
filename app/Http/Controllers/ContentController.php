<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
 
    public function index()
    {
        $contents = Content::all();
        return response()->json(['data' => $contents], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string|max:255',
        ]);

        $content = Content::create($validated);

        return response()->json(['message' => 'Content created successfully!', 'data' => $content], 201);
    }

    public function show(Content $content)
    {
        return response()->json(['data' => $content], 200);
    }

    public function update(Request $request, Content $content)
    {
        $validated = $request->validate([
            'type' => 'sometimes|string|max:255',
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'image' => 'nullable|string|max:255',
        ]);

        $content->update($validated);

        return response()->json(['message' => 'Content updated successfully!', 'data' => $content], 200);
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return response()->json(['message' => 'Content deleted successfully!'], 200);
    }
}
