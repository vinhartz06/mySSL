<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use App\Models\Stat;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        // get top goalscorers
        $topGoalscorers = Stat::selectRaw('player_id, SUM(goals) as total_goals')
            ->groupBy('player_id')
            ->orderByDesc('total_goals')
            ->limit(5)
            ->with('player.club')
            ->get()
            ->map(function ($stat) {
                return [
                    'player' => $stat->player,
                    'total_goals' => $stat->total_goals,
                ];
            });

        // get 2 last matches FT
        $recentMatches = GameMatch::where('status', 'fulltime')
            ->orderByDesc('match_date')
            ->limit(2)
            ->with('homeClub', 'awayClub')
            ->get();

        return view('home', [
            'topGoalscorers' => $topGoalscorers,
            'recentMatches' => $recentMatches,
        ]);
    }
}
