<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GameMatch;
use App\Models\Club;
use App\Models\Player;
use App\Models\Standing;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_matches' => GameMatch::count(),
            'total_clubs' => Club::count(),
            'total_players' => Player::count(),
            'upcoming_matches' => GameMatch::upcoming()->count(),
            'completed_matches' => GameMatch::completed()->count(),
        ];

        $recentMatches = GameMatch::with(['homeClub', 'awayClub'])
            ->latestFirst()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentMatches'));
    }
}