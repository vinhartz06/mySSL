<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Standing;
use App\Models\GameMatch;
use Illuminate\Http\Request;

class StandingController extends Controller {
    public function index() {
        // Get standings ordered by points (desc), goal difference (desc), goals for (desc)
        $standings = Standing::with('club')
            ->orderBy('points', 'desc')
            ->orderBy('goal_diff', 'desc')
            ->orderBy('goals_for', 'desc')
            ->get();

        // Calculate real statistics
        $totalClubs = Club::count();
        $totalMatches = GameMatch::completed()->count();
        
        // Calculate total goals from completed matches
        $completedMatches = GameMatch::completed()->get();
        $totalGoals = 0;
        foreach ($completedMatches as $match) {
            $totalGoals += ($match->home_score ?? 0) + ($match->away_score ?? 0);
        }

        // Calculate most wins
        $mostWinsStanding = Standing::orderBy('won', 'desc')
            ->orderBy('goal_diff', 'desc')
            ->first();
        $mostWins = $mostWinsStanding->won ?? 0;
        $mostWinsClub = $mostWinsStanding->club->name ?? 'N/A';

        // Calculate most goals
        $mostGoalsStanding = Standing::orderBy('goals_for', 'desc')
            ->orderBy('goal_diff', 'desc')
            ->first();
        $mostGoals = $mostGoalsStanding->goals_for ?? 0;
        $mostGoalsClub = $mostGoalsStanding->club->name ?? 'N/A';

        // Calculate best defense (least goals conceded)
        $bestDefenseStanding = Standing::orderBy('goals_against', 'asc')
            ->orderBy('goal_diff', 'desc')
            ->first();
        $bestDefense = $bestDefenseStanding->goals_against ?? 0;
        $bestDefenseClub = $bestDefenseStanding->club->name ?? 'N/A';

        return view('standings.index', compact(
            'standings',
            'totalClubs',
            'totalMatches',
            'totalGoals',
            'mostWins',
            'mostWinsClub',
            'mostGoals',
            'mostGoalsClub',
            'bestDefense',
            'bestDefenseClub'
        ));
    }
}