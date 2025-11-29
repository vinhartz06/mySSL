<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use App\Models\Club;
use App\Models\Lineup;
use App\Models\Stat;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index()
    {
        // Get all matches with home and away club info, ordered by match date
        $matches = GameMatch::with(['homeClub', 'awayClub'])
            ->orderBy('match_date', 'asc')
            ->get();

        // Group matches by matchday (you might need to add matchday column to matches table)
        // For now, we'll group by date or create virtual matchdays
        $matchesByDate = $matches->groupBy(function($match) {
            return $match->match_date->format('Y-m-d');
        });

        return view('matches.index', compact('matches', 'matchesByDate'));
    }

    public function show($id)
    {
        $match = GameMatch::with([
            'homeClub',
            'awayClub', 
            'lineups.player.club',
            'lineups.player.stats' => function($query) use ($id) {
                $query->where('match_id', $id);
            }
        ])->findOrFail($id);

        // Get starting lineups
        $homeStarters = $match->lineups->filter(function($lineup) use ($match) {
            return $lineup->role === 'start' && $lineup->player->club_id === $match->home_club_id;
        });

        $awayStarters = $match->lineups->filter(function($lineup) use ($match) {
            return $lineup->role === 'start' && $lineup->player->club_id === $match->away_club_id;
        });

        // Get substitutes
        $homeSubstitutes = $match->lineups->filter(function($lineup) use ($match) {
            return $lineup->role === 'sub' && $lineup->player->club_id === $match->home_club_id;
        });

        $awaySubstitutes = $match->lineups->filter(function($lineup) use ($match) {
            return $lineup->role === 'sub' && $lineup->player->club_id === $match->away_club_id;
        });

        // Get match statistics
        $matchStats = [
            'home' => $this->getTeamStats($match->home_club_id, $id),
            'away' => $this->getTeamStats($match->away_club_id, $id)
        ];

        // Add match-specific stats from the matches table
        $matchStats['home'] = array_merge($matchStats['home'], [
            'shots' => $match->home_shots ?? 0,
            'shots_on_target' => $match->home_shots_on_target ?? 0,
            'possession' => $match->home_possession ?? 50,
            'offsides' => $match->home_offsides ?? 0,
            'corners' => $match->home_corners ?? 0,
        ]);

        $matchStats['away'] = array_merge($matchStats['away'], [
            'shots' => $match->away_shots ?? 0,
            'shots_on_target' => $match->away_shots_on_target ?? 0,
            'possession' => $match->away_possession ?? 50,
            'offsides' => $match->away_offsides ?? 0,
            'corners' => $match->away_corners ?? 0,
        ]);

        return view('matches.show', compact(
            'match',
            'homeStarters',
            'awayStarters',
            'homeSubstitutes',
            'awaySubstitutes',
            'matchStats'
        ));
    }

    private function getTeamStats($clubId, $matchId)
    {
        // Get all players from the club who played in this match
        $players = \App\Models\Player::where('club_id', $clubId)
            ->whereHas('stats', function($query) use ($matchId) {
                $query->where('match_id', $matchId);
            })
            ->with(['stats' => function($query) use ($matchId) {
                $query->where('match_id', $matchId);
            }])
            ->get();

        $teamStats = [
            'goals' => 0,
            'assists' => 0,
            'shots' => 0,
            'shots_on_target' => 0,
            'possession' => 50, // Default value, will be overridden from matches table
            'pass_accuracy' => 0,
            'fouls' => 0,
            'yellow_cards' => 0,
            'red_cards' => 0,
            'offsides' => 0,
            'corners' => 0,
        ];

        $totalPassAccuracy = 0;
        $playersWithPassStats = 0;

        foreach ($players as $player) {
            $stat = $player->stats->first();
            if ($stat) {
                $teamStats['goals'] += $stat->goals ?? 0;
                $teamStats['assists'] += $stat->assists ?? 0;
                $teamStats['fouls'] += $stat->fouls ?? 0;
                $teamStats['yellow_cards'] += $stat->yellow_cards ?? 0;
                $teamStats['red_cards'] += $stat->red_cards ?? 0;
                
                // Calculate pass accuracy average
                if (!is_null($stat->succ_passes)) {
                    $totalPassAccuracy += $stat->succ_passes;
                    $playersWithPassStats++;
                }
            }
        }

        // Calculate average pass accuracy
        if ($playersWithPassStats > 0) {
            $teamStats['pass_accuracy'] = round($totalPassAccuracy / $playersWithPassStats, 2);
        }

        return $teamStats;
    }

    public function byMatchday($matchday)
    {
        // If you have a matchday column in your matches table:
        // $matches = GameMatch::with(['homeClub', 'awayClub'])
        //     ->where('matchday', $matchday)
        //     ->orderBy('match_date', 'asc')
        //     ->get();

        // For now, we'll simulate matchdays by grouping matches
        $allMatches = GameMatch::with(['homeClub', 'awayClub'])
            ->orderBy('match_date', 'asc')
            ->get();

        // Create virtual matchdays (5 matches per matchday)
        $matches = $allMatches->slice(($matchday - 1) * 5, 5);

        return view('matches.matchday', compact('matches', 'matchday'));
    }
}