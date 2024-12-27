<?php
// app/Http/Controllers/CompanyHistoryController.php

namespace App\Http\Controllers;

use App\Models\CompanyHistory;
use Illuminate\Http\Request;

class CompanyHistoryController extends Controller
{
    public function index()
    {
        return CompanyHistory::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
        ]);

        return CompanyHistory::create($request->all());
    }

    public function show(CompanyHistory $companyHistory)
    {
        return $companyHistory;
    }

    public function update(Request $request, CompanyHistory $companyHistory)
    {
        $request->validate([
            'year' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $companyHistory->update($request->all());

        return $companyHistory;
    }

    public function destroy(CompanyHistory $companyHistory)
    {
        $companyHistory->delete();

        return response()->noContent();
    }
}
