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

    /**
     * Display the specified club.
     */
    public function show(Club $club)
    {
        // Eager load players with their stats for better performance
        $club->load(['players' => function($query) {
            $query->orderBy('jersey_no')
                ->with(['stats']); // Eager load stats relationship
        }]);        

        // Calculate totals manually to ensure accuracy
        $totalGoals = 0;
        $totalAssists = 0;
        $totalMatches = 0;

        foreach ($club->players as $player) {
            $totalGoals += $player->stats->sum('goals');
            $totalAssists += $player->stats->sum('assists');
            $totalMatches += $player->stats
                ->filter(function($stat) {
                    return $stat->start_minute && 
                           $stat->end_minute && 
                           ($stat->end_minute - $stat->start_minute > 0);
                })
                ->unique('match_id')
                ->count();
        }

        return view('clubs.show', compact('club', 'totalGoals', 'totalAssists', 'totalMatches'));
    }
}