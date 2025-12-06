<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GameMatch;
use App\Models\Club;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index()
    {
        $matches = GameMatch::with(['homeClub', 'awayClub'])
            ->orderBy('match_date', 'desc')
            ->paginate(10);

        return view('admin.matches.index', compact('matches'));
    }

    public function create()
    {
        $clubs = Club::all();
        $matchdays = range(1, 18);
        $statuses = ['scheduled'];

        return view('admin.matches.create', compact('clubs', 'matchdays', 'statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_club_id' => 'required|exists:clubs,id',
            'away_club_id' => 'required|exists:clubs,id|different:home_club_id',
            'matchday' => 'required|integer|min:1',
            'match_date' => 'required|date',
            'venue' => 'required|string|max:255',
            'status' => 'required|in:scheduled,postponed,fulltime,cancelled',
        ]);

        GameMatch::create($validated);

        return redirect()->route('admin.matches.index')
            ->with('success', 'Match created successfully!');
    }

    public function edit(GameMatch $match)
    {
        $clubs = Club::all();
        $matchdays = range(1, 38);
        $statuses = ['scheduled', 'postponed', 'fulltime', 'cancelled'];

        return view('admin.matches.edit', compact('match', 'clubs', 'matchdays', 'statuses'));
    }

    public function update(Request $request, GameMatch $match)
    {
        $validated = $request->validate([
            'home_club_id' => 'required|exists:clubs,id',
            'away_club_id' => 'required|exists:clubs,id|different:home_club_id',
            'matchday' => 'required|integer|min:1',
            'match_date' => 'required|date',
            'venue' => 'required|string|max:255',
            'status' => 'required|in:scheduled,postponed,fulltime,cancelled',
            'home_score' => 'nullable|integer|min:0',
            'away_score' => 'nullable|integer|min:0',
            'home_shots' => 'nullable|integer|min:0',
            'away_shots' => 'nullable|integer|min:0',
            'home_shots_on_target' => 'nullable|integer|min:0',
            'away_shots_on_target' => 'nullable|integer|min:0',
            'home_possession' => 'nullable|numeric|min:0|max:100',
            'away_possession' => 'nullable|numeric|min:0|max:100',
            'home_corners' => 'nullable|integer|min:0',
            'away_corners' => 'nullable|integer|min:0',
            'home_offsides' => 'nullable|integer|min:0',
            'away_offsides' => 'nullable|integer|min:0',
        ]);

        $match->update($validated);

        return redirect()->route('admin.matches.index')
            ->with('success', 'Match updated successfully!');
    }

    public function destroy(GameMatch $match)
    {
        $match->delete();

        return redirect()->route('admin.matches.index')
            ->with('success', 'Match deleted successfully!');
    }
}