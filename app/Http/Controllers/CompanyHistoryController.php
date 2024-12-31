<?php

namespace App\Http\Controllers;

use App\Models\CompanyHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyHistoryController extends Controller
{
    public function index()
    {
        try {
            $companyHistories = CompanyHistory::all();

            if ($companyHistories->isEmpty()) {
                return response()->json(['error' => 'No company history records found'], 404);
            }

            return response()->json(['companyHistories' => $companyHistories], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $companyHistory = CompanyHistory::create($request->all());

            return response()->json(['message' => 'Company history record created successfully', 'companyHistory' => $companyHistory], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to create company history record'], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $companyHistory = CompanyHistory::findOrFail($id);

            return response()->json(['companyHistory' => $companyHistory], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No company history record found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $companyHistory = CompanyHistory::findOrFail($id);

            $companyHistory->update($request->all());

            return response()->json(['message' => 'Company history record updated successfully', 'companyHistory' => $companyHistory], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No company history record found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to update company history record'], 500);
        }
    }

    public function destroy(Request $request)
    {
        $historyIds = $request->id;

        try {
            foreach ($historyIds as $historyId) {
                $companyHistory = CompanyHistory::findOrFail($historyId);
                $companyHistory->delete();
            }

            return response()->json(['message' => 'Company history records deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'One or more company history records not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to delete company history records'], 500);
        }
    }
}
