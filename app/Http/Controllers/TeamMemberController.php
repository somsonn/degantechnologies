<?php

// app/Http/Controllers/TeamMemberController.php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        return TeamMember::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'required|string|max:255',
            
        ]);

        return TeamMember::create($request->all());
    }

    public function show(TeamMember $teamMember)
    {
        return $teamMember;
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'required|string|max:255',
            
        ]);

        $teamMember->update($request->all());

        return $teamMember;
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return response()->noContent();
    }
}
