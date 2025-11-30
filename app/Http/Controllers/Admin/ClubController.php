<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::withCount('players')->paginate(10);
        return view('admin.clubs.index', compact('clubs'));
    }

    public function edit(Club $club)
    {
        // Add players_count + load players with their stats
        $club->loadCount('players')
            ->load([
                'players' => function ($query) {
                    $query->with('stats');
                }
            ]);

        return view('admin.clubs.edit', compact('club'));
    }

    public function update(Request $request, Club $club)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'coach' => 'nullable|string|max:255',
        ]);

        $club->update($validated);

        return redirect()->route('admin.clubs.index')
            ->with('success', 'Club updated successfully!');
    }
}