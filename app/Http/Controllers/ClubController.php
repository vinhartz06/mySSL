<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    /**
     * Display a listing of the clubs.
     */
    public function index()
    {
        $clubs = Club::all();
        return view('clubs.index', compact('clubs'));
    }

    public function show(Club $club)
    {
        // Eager load players with their stats
        $club->load(['players.stats']); // Important: load the stats relationship

        // Calculate totals using the computed attributes
        $totalGoals = $club->players->sum('total_goals');
        $totalAssists = $club->players->sum('total_assists');
        
        // For matches played, we need to calculate differently to avoid duplicates
        $totalMatches = $club->players->max(function($player) {
            return $player->matches_played;
        });

        return view('clubs.show', compact('club', 'totalGoals', 'totalAssists', 'totalMatches'));
    }
}