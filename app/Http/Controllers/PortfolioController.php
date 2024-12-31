<?php

namespace App\Http\Controllers;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    public function index()
    {
        try {
            $portfolios = Portfolio::all();

            if ($portfolios->isEmpty()) {
                return response()->json(['error' => 'No portfolio records found'], 404);
            }

            return response()->json(['data' => $portfolios], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'file' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $portfolio = Portfolio::create($validator->validated());

            return response()->json(['message' => 'Portfolio created successfully!', 'data' => $portfolio], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to create portfolio'], 500);
        }
    }
    public function show(Portfolio $portfolio)
    {
        try {
            return response()->json(['data' => $portfolio], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }
    public function update(Request $request, Portfolio $portfolio)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'file' => 'required|mimes:png,jpg,jpeg|max:2048'

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $portfolio->update($validator->validated());

            return response()->json(['message' => 'Portfolio updated successfully!', 'data' => $portfolio], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to update portfolio'], 500);
        }
    }
    public function destroy(Portfolio $portfolio)
    {
        try {
            $portfolio->delete();

            return response()->json(['message' => 'Portfolio deleted successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to delete portfolio'], 500);
        }
    }
}
