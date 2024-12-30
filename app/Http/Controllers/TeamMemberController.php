<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamMemberController extends Controller
{
    public function index()
    {
        try {
            $teamMembers = TeamMember::all();

            if ($teamMembers->isEmpty()) {
                return response()->json(['error' => 'No team members found'], 404);
            }

            return response()->json(['data' => $teamMembers], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'required|mimes:png,jpg,jpeg|max:2048'
            

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $teamMember = TeamMember::create($validator->validated());

            return response()->json(['message' => 'Team member created successfully!', 'data' => $teamMember], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to create team member'], 500);
        }
    }
    public function show(TeamMember $teamMember)
    {
        try {
            return response()->json(['data' => $teamMember], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }
    public function update(Request $request, TeamMember $teamMember)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'position' => 'sometimes|string|max:255',
            'photo' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $teamMember->update($validator->validated());

            return response()->json(['message' => 'Team member updated successfully!', 'data' => $teamMember], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to update team member'], 500);
        }
    }
    public function destroy(TeamMember $teamMember)
    {
        try {
            $teamMember->delete();

            return response()->json(['message' => 'Team member deleted successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error, failed to delete team member'], 500);
        }
    }
}
