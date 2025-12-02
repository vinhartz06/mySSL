<?php

namespace App\Http\Controllers\ClubAdmin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\GameMatch;
use App\Models\Player;
use App\Models\Lineup;
use App\Models\Stat;
use App\Models\Standing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubAdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $club = $user->club;

        if (!$club) {
            return redirect()->route('show.login')
                ->with('error', 'No club assigned to your account.');
        }

        // Get club statistics
        $stats = [
            'total_players' => $club->players()->count(),
            'upcoming_matches' => GameMatch::forClub($club->id)
                ->upcoming()
                ->count(),
            'completed_matches' => GameMatch::forClub($club->id)
                ->completed()
                ->count(),
            'total_goals' => $this->getClubTotalGoals($club->id),
        ];

        // Get upcoming matches
        $upcomingMatches = GameMatch::with(['homeClub', 'awayClub'])
            ->forClub($club->id)
            ->upcoming()
            ->upcomingFirst()
            ->limit(5)
            ->get();

        // Get recent matches
        $recentMatches = GameMatch::with(['homeClub', 'awayClub'])
            ->forClub($club->id)
            ->latestFirst()
            ->limit(5)
            ->get();

        // Get club standing
        $standing = Standing::where('club_id', $club->id)->first();

        return view('clubadmin.dashboard', compact('club', 'stats', 'upcomingMatches', 'recentMatches', 'standing'));
    }

    public function showClub()
    {
        $user = Auth::user();
        $club = $user->club;

        if (!$club) {
            return redirect()->route('clubadmin.dashboard')
                ->with('error', 'No club assigned to your account.');
        }

        $players = $club->players()->orderBy('jersey_no')->get();
        $standing = Standing::where('club_id', $club->id)->first();

        return view('clubadmin.club.show', compact('club', 'players', 'standing'));
    }

    public function upcomingMatches()
    {
        $user = Auth::user();
        $club = $user->club;

        if (!$club) {
            return redirect()->route('clubadmin.dashboard')
                ->with('error', 'No club assigned to your account.');
        }

        $matches = GameMatch::with(['homeClub', 'awayClub'])
            ->forClub($club->id)
            ->upcoming()
            ->upcomingFirst()
            ->paginate(10);

        return view('clubadmin.matches.upcoming', compact('matches', 'club'));
    }

    public function showMatch(GameMatch $match)
    {
        $user = Auth::user();
        $club = $user->club;

        if (!$club) {
            return redirect()->route('clubadmin.dashboard')
                ->with('error', 'No club assigned to your account.');
        }

        // Verify the match belongs to the club
        if ($match->home_club_id !== $club->id && $match->away_club_id !== $club->id) {
            return redirect()->route('clubadmin.matches.upcoming')
                ->with('error', 'Unauthorized access to this match.');
        }

        // Get players for the club
        $players = $club->players()->orderBy('jersey_no')->get();

        // Get existing lineups
        $lineups = Lineup::where('match_id', $match->id)
            ->with('player')
            ->get();

        $startingLineup = $lineups->where('role', 'start');
        $substituteLineup = $lineups->where('role', 'sub');

        return view('clubadmin.matches.show', compact('match', 'club', 'players', 'startingLineup', 'substituteLineup'));
    }

    public function storeLineup(Request $request, GameMatch $match)
    {
        $user = Auth::user();
        $club = $user->club;

        if (!$club) {
            return redirect()->route('clubadmin.dashboard')
                ->with('error', 'No club assigned to your account.');
        }

        // Verify the match belongs to the club
        if ($match->home_club_id !== $club->id && $match->away_club_id !== $club->id) {
            return redirect()->route('clubadmin.matches.upcoming')
                ->with('error', 'Unauthorized access to this match.');
        }

        // Verify players belong to the club
        $validated = $request->validate([
            'starters' => 'required|array|min:11|max:11',
            'starters.*' => 'required|exists:players,id',
            'substitutes' => 'nullable|array|max:12',
            'substitutes.*' => 'nullable|exists:players,id',
        ]);

        // Filter out empty/null values from substitutes
        $substitutes = array_filter($validated['substitutes'] ?? [], function($value) {
            return !empty($value);
        });

        // Check all players belong to the club
        $allPlayerIds = array_merge($validated['starters'], $substitutes);
        $clubPlayerIds = $club->players()->pluck('id')->toArray();

        foreach ($allPlayerIds as $playerId) {
            if (!in_array($playerId, $clubPlayerIds)) {
                return back()->with('error', 'All players must belong to your club.');
            }
        }

        // Delete existing lineups for this match and club
        $clubPlayerIds = $club->players()->pluck('id')->toArray();
        Lineup::where('match_id', $match->id)
            ->whereIn('player_id', $clubPlayerIds)
            ->delete();

        // Create starting lineup
        foreach ($validated['starters'] as $playerId) {
            Lineup::create([
                'match_id' => $match->id,
                'player_id' => $playerId,
                'role' => 'start',
            ]);
        }

        // Create substitute lineup
        foreach ($substitutes as $playerId) {
            Lineup::create([
                'match_id' => $match->id,
                'player_id' => $playerId,
                'role' => 'sub',
            ]);
        }

        return redirect()->route('clubadmin.matches.show', $match)
            ->with('success', 'Lineup saved successfully!');
    }

    public function players()
    {
        $user = Auth::user();
        $club = $user->club;

        if (!$club) {
            return redirect()->route('clubadmin.dashboard')
                ->with('error', 'No club assigned to your account.');
        }

        $players = $club->players()->with('stats')->orderBy('jersey_no')->paginate(10);

        return view('clubadmin.players.index', compact('players', 'club'));
    }

    public function createPlayer()
    {
        $user = Auth::user();
        $club = $user->club;

        if (!$club) {
            return redirect()->route('clubadmin.dashboard')
                ->with('error', 'No club assigned to your account.');
        }

        return view('clubadmin.players.create', compact('club'));
    }

    public function storePlayer(Request $request)
    {
        $user = Auth::user();
        $club = $user->club;

        if (!$club) {
            return redirect()->route('clubadmin.dashboard')
                ->with('error', 'No club assigned to your account.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'jersey_no' => 'required|integer|min:1|max:99|unique:players,jersey_no,NULL,id,club_id,' . $club->id,
        ]);

        $validated['club_id'] = $club->id;

        Player::create($validated);

        return redirect()->route('clubadmin.players.index')
            ->with('success', 'Player created successfully!');
    }

    public function editPlayer(Player $player)
    {
        $user = Auth::user();
        $club = $user->club;

        if (!$club) {
            return redirect()->route('clubadmin.dashboard')
                ->with('error', 'No club assigned to your account.');
        }

        // Verify player belongs to the club
        if ($player->club_id !== $club->id) {
            return redirect()->route('clubadmin.players.index')
                ->with('error', 'Unauthorized access to this player.');
        }

        return view('clubadmin.players.edit', compact('player', 'club'));
    }

    public function updatePlayer(Request $request, Player $player)
    {
        $user = Auth::user();
        $club = $user->club;

        if (!$club) {
            return redirect()->route('clubadmin.dashboard')
                ->with('error', 'No club assigned to your account.');
        }

        // Verify player belongs to the club
        if ($player->club_id !== $club->id) {
            return redirect()->route('clubadmin.players.index')
                ->with('error', 'Unauthorized access to this player.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'jersey_no' => 'required|integer|min:1|max:99|unique:players,jersey_no,' . $player->id . ',id,club_id,' . $club->id,
        ]);

        $player->update($validated);

        return redirect()->route('clubadmin.players.index')
            ->with('success', 'Player updated successfully!');
    }

    public function destroyPlayer(Player $player)
    {
        $user = Auth::user();
        $club = $user->club;

        if (!$club) {
            return redirect()->route('clubadmin.dashboard')
                ->with('error', 'No club assigned to your account.');
        }

        // Verify player belongs to the club
        if ($player->club_id !== $club->id) {
            return redirect()->route('clubadmin.players.index')
                ->with('error', 'Unauthorized access to this player.');
        }

        $player->delete();

        return redirect()->route('clubadmin.players.index')
            ->with('success', 'Player deleted successfully!');
    }

    public function matchStats(GameMatch $match)
    {
        $user = Auth::user();
        $club = $user->club;

        if (!$club) {
            return redirect()->route('clubadmin.dashboard')
                ->with('error', 'No club assigned to your account.');
        }

        // Verify the match belongs to the club
        if ($match->home_club_id !== $club->id && $match->away_club_id !== $club->id) {
            return redirect()->route('clubadmin.matches.upcoming')
                ->with('error', 'Unauthorized access to this match.');
        }

        // Get players for the club
        $players = $club->players()->orderBy('jersey_no')->get();

        // Get existing stats
        $playerIds = $players->pluck('id')->toArray();
        $stats = Stat::where('match_id', $match->id)
            ->whereIn('player_id', $playerIds)
            ->with('player')
            ->get()
            ->keyBy('player_id');

        return view('clubadmin.stats.match', compact('match', 'club', 'players', 'stats'));
    }

    public function storeMatchStats(Request $request, GameMatch $match)
    {
        $user = Auth::user();
        $club = $user->club;

        if (!$club) {
            return redirect()->route('clubadmin.dashboard')
                ->with('error', 'No club assigned to your account.');
        }

        // Verify the match belongs to the club
        if ($match->home_club_id !== $club->id && $match->away_club_id !== $club->id) {
            return redirect()->route('clubadmin.matches.upcoming')
                ->with('error', 'Unauthorized access to this match.');
        }

        $validated = $request->validate([
            'stats' => 'required|array',
            'stats.*.player_id' => 'required|exists:players,id',
            'stats.*.start_minute' => 'nullable|integer|min:0',
            'stats.*.end_minute' => 'nullable|integer|min:0',
            'stats.*.goals' => 'nullable|integer|min:0',
            'stats.*.assists' => 'nullable|integer|min:0',
            'stats.*.yellow_cards' => 'nullable|integer|min:0',
            'stats.*.red_cards' => 'nullable|integer|min:0',
            'stats.*.succ_passes' => 'nullable|numeric|min:0',
            'stats.*.succ_ground_duels' => 'nullable|numeric|min:0',
            'stats.*.succ_aerial_duels' => 'nullable|numeric|min:0',
            'stats.*.succ_dribbles' => 'nullable|numeric|min:0',
            'stats.*.saves' => 'nullable|integer|min:0',
            'stats.*.tackles' => 'nullable|integer|min:0',
            'stats.*.interceptions' => 'nullable|integer|min:0',
            'stats.*.clearances' => 'nullable|integer|min:0',
            'stats.*.fouls' => 'nullable|integer|min:0',
        ]);

        // Verify all players belong to the club
        $clubPlayerIds = $club->players()->pluck('id')->toArray();
        foreach ($validated['stats'] as $statData) {
            if (!in_array($statData['player_id'], $clubPlayerIds)) {
                return back()->with('error', 'All players must belong to your club.');
            }
        }

        // Update or create stats
        foreach ($validated['stats'] as $statData) {
            Stat::updateOrCreate(
                [
                    'match_id' => $match->id,
                    'player_id' => $statData['player_id'],
                ],
                $statData
            );
        }

        return redirect()->route('clubadmin.stats.match', $match)
            ->with('success', 'Statistics saved successfully!');
    }

    private function getClubTotalGoals($clubId)
    {
        $homeGoals = GameMatch::where('home_club_id', $clubId)
            ->where('status', 'fulltime')
            ->sum('home_score') ?? 0;

        $awayGoals = GameMatch::where('away_club_id', $clubId)
            ->where('status', 'fulltime')
            ->sum('away_score') ?? 0;

        return $homeGoals + $awayGoals;
    }
}

