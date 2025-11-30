<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Club;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::with('club')->paginate(10);
        return view('admin.players.index', compact('players'));
    }

    public function create()
    {
        $clubs = Club::all();
        return view('admin.players.create', compact('clubs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'jersey_no' => 'required|integer|min:1|max:99',
        ]);

        Player::create($validated);

        return redirect()->route('admin.players.index')
            ->with('success', 'Player created successfully!');
    }

    public function edit(Player $player)
    {
        $clubs = Club::all();
        return view('admin.players.edit', compact('player', 'clubs'));
    }

    public function update(Request $request, Player $player)
    {
        $validated = $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'jersey_no' => 'required|integer|min:1|max:99',
        ]);

        $player->update($validated);

        return redirect()->route('admin.players.index')
            ->with('success', 'Player updated successfully!');
    }

    public function destroy(Player $player)
    {
        $player->delete();

        return redirect()->route('admin.players.index')
            ->with('success', 'Player deleted successfully!');
    }
}