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
                  ->with('stats'); // Eager load stats relationship
        }]);

        return view('clubs.show', compact('club'));
    }
}