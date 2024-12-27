<?php

// app/Http/Controllers/PortfolioController.php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        return Portfolio::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|string|max:255',
        ]);

        return Portfolio::create($request->all());
    }

    public function show(Portfolio $portfolio)
    {
        return $portfolio;
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|string|max:255',
        ]);

        $portfolio->update($request->all());

        return $portfolio;
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return response()->noContent();
    }
}
