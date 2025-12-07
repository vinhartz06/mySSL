<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Standing;
use Illuminate\Http\Request;

class StandingController extends Controller
{
    public function index()
    {
        $standings = Standing::with('club')
            ->orderBy('points', 'desc')
            ->orderBy('goal_diff', 'desc')
            ->orderBy('goals_for', 'desc')
            ->get();

        return view('admin.standings.index', compact('standings'));
    }

    public function edit(Standing $standing)
    {
        return view('admin.standings.edit', compact('standing'));
    }

    public function update(Request $request, Standing $standing)
    {
        $validated = $request->validate([
            'played' => 'required|integer|min:0',
            'won' => 'required|integer|min:0',
            'draw' => 'required|integer|min:0',
            'lost' => 'required|integer|min:0',
            'goals_for' => 'required|integer|min:0',
            'goals_against' => 'required|integer|min:0',
            'goal_diff' => 'required|integer',
            'points' => 'required|integer|min:0',
        ]);

        $standing->update($validated);

        return redirect()->route('admin.standings.index')
            ->with('success', 'Standing updated successfully!');
    }
}