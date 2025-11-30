<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_id',
        'name',
        'position',
        'jersey_no',
    ];

    protected $appends = [
        'matches_played',
        'total_goals',
        'total_assists',
        'total_yellow_cards',
        'total_red_cards',
        'avg_succ_passes',
        'avg_succ_ground_duels',
        'avg_succ_aerial_duels',
        'avg_succ_dribbles'
    ];

    // get club that owns player
    public function club() {
        return $this->belongsTo(Club::class);
    }

    // get player stats
    public function stats() {
        return $this->hasMany(Stat::class);
    }

    /**
     * Get matches played count - SIMPLIFIED: just check if end_time > 0
     */
    public function getMatchesPlayedCount() {
        return $this->stats()
            ->select('match_id')
            ->where('end_minute', '>', 0)
            ->distinct('match_id')
            ->count('match_id');
    }

    // calc matches played - SIMPLIFIED
    public function getMatchesPlayedAttribute() {
        if (!$this->relationLoaded('stats')) {
            return $this->getMatchesPlayedCount();
        }
        
        // Count distinct matches where end_minute > 0
        return $this->stats
            ->where('end_minute', '>', 0)
            ->groupBy('match_id')
            ->count();
    }

    // calc goals - FIXED
    public function getTotalGoalsAttribute() {
        if (!$this->relationLoaded('stats')) {
            return (int) $this->stats()->sum('goals');
        }
        return (int) $this->stats->sum('goals');
    }

    // calc assists - FIXED
    public function getTotalAssistsAttribute() {
        if (!$this->relationLoaded('stats')) {
            return (int) $this->stats()->sum('assists');
        }
        return (int) $this->stats->sum('assists');
    }

    // calc yellow - FIXED
    public function getTotalYellowCardsAttribute() {
        if (!$this->relationLoaded('stats')) {
            return (int) $this->stats()->sum('yellow_cards');
        }
        return (int) $this->stats->sum('yellow_cards');
    }

    // calc red - FIXED
    public function getTotalRedCardsAttribute() {
        if (!$this->relationLoaded('stats')) {
            return (int) $this->stats()->sum('red_cards');
        }
        return (int) $this->stats->sum('red_cards');
    }

    // calc saves
    public function getTotalSavesAttribute() {
        if (!$this->relationLoaded('stats')) {
            return (int) $this->stats()->sum('saves');
        }
        return (int) $this->stats->sum('saves');
    }

    // calc tackles
    public function getTotalTacklesAttribute() {
        if (!$this->relationLoaded('stats')) {
            return (int) $this->stats()->sum('tackles');
        }
        return (int) $this->stats->sum('tackles');
    }

    // calc intercepts
    public function getTotalInterceptionsAttribute() {
        if (!$this->relationLoaded('stats')) {
            return (int) $this->stats()->sum('interceptions');
        }
        return (int) $this->stats->sum('interceptions');
    }

    // calc clearances
    public function getTotalClearancesAttribute() {
        if (!$this->relationLoaded('stats')) {
            return (int) $this->stats()->sum('clearances');
        }
        return (int) $this->stats->sum('clearances');
    }

    // calc fouls
    public function getTotalFoulsAttribute() {
        if (!$this->relationLoaded('stats')) {
            return (int) $this->stats()->sum('fouls');
        }
        return (int) $this->stats->sum('fouls');
    }

    // AVERAGE CALCULATIONS FOR ALL MATCHES

    // average successful passes (all matches) - FIXED
    public function getAvgSuccPassesAttribute() {
        if (!$this->relationLoaded('stats')) {
            $avg = $this->stats()->avg('succ_passes');
            return $avg ? round($avg, 2) : 0;
        }
        
        $avg = $this->stats->avg('succ_passes');
        return $avg ? round($avg, 2) : 0;
    }

    // average successful ground duels (all matches) - FIXED
    public function getAvgSuccGroundDuelsAttribute() {
        if (!$this->relationLoaded('stats')) {
            $avg = $this->stats()->avg('succ_ground_duels');
            return $avg ? round($avg, 2) : 0;
        }
        
        $avg = $this->stats->avg('succ_ground_duels');
        return $avg ? round($avg, 2) : 0;
    }

    // average successful aerial duels (all matches) - FIXED
    public function getAvgSuccAerialDuelsAttribute() {
        if (!$this->relationLoaded('stats')) {
            $avg = $this->stats()->avg('succ_aerial_duels');
            return $avg ? round($avg, 2) : 0;
        }
        
        $avg = $this->stats->avg('succ_aerial_duels');
        return $avg ? round($avg, 2) : 0;
    }

    // average successful dribbles (all matches) - FIXED
    public function getAvgSuccDribblesAttribute() {
        if (!$this->relationLoaded('stats')) {
            $avg = $this->stats()->avg('succ_dribbles');
            return $avg ? round($avg, 2) : 0;
        }
        
        $avg = $this->stats->avg('succ_dribbles');
        return $avg ? round($avg, 2) : 0;
    }

    // STATS FOR SPECIFIC MATCH

    /**
     * Get player stats for a specific match
     */
    public function getStatsForMatch($matchId) {
        if (!$this->relationLoaded('stats')) {
            return $this->stats()->where('match_id', $matchId)->first();
        }
        return $this->stats->where('match_id', $matchId)->first();
    }

    /**
     * Get goals for specific match
     */
    public function getGoalsForMatch($matchId) {
        $stat = $this->getStatsForMatch($matchId);
        return $stat ? ($stat->goals ?? 0) : 0;
    }

    /**
     * Get assists for specific match
     */
    public function getAssistsForMatch($matchId) {
        $stat = $this->getStatsForMatch($matchId);
        return $stat ? ($stat->assists ?? 0) : 0;
    }

    /**
     * Get yellow cards for specific match
     */
    public function getYellowCardsForMatch($matchId) {
        $stat = $this->getStatsForMatch($matchId);
        return $stat ? ($stat->yellow_cards ?? 0) : 0;
    }

    /**
     * Get red cards for specific match
     */
    public function getRedCardsForMatch($matchId) {
        $stat = $this->getStatsForMatch($matchId);
        return $stat ? ($stat->red_cards ?? 0) : 0;
    }

    /**
     * Get successful passes for specific match
     */
    public function getSuccPassesForMatch($matchId) {
        $stat = $this->getStatsForMatch($matchId);
        return $stat ? ($stat->succ_passes ?? 0) : 0;
    }

    /**
     * Get successful ground duels for specific match
     */
    public function getSuccGroundDuelsForMatch($matchId) {
        $stat = $this->getStatsForMatch($matchId);
        return $stat ? ($stat->succ_ground_duels ?? 0) : 0;
    }

    /**
     * Get successful aerial duels for specific match
     */
    public function getSuccAerialDuelsForMatch($matchId) {
        $stat = $this->getStatsForMatch($matchId);
        return $stat ? ($stat->succ_aerial_duels ?? 0) : 0;
    }

    /**
     * Get successful dribbles for specific match
     */
    public function getSuccDribblesForMatch($matchId) {
        $stat = $this->getStatsForMatch($matchId);
        return $stat ? ($stat->succ_dribbles ?? 0) : 0;
    }

    /**
     * Get minutes played for specific match
     */
    public function getMinutesPlayedForMatch($matchId) {
        $stat = $this->getStatsForMatch($matchId);
        if (!$stat || !$stat->start_minute || !$stat->end_minute) {
            return 0;
        }
        return max(0, $stat->end_minute - $stat->start_minute);
    }

    /**
     * Check if player played in specific match
     */
    public function playedInMatch($matchId) {
        $stat = $this->getStatsForMatch($matchId);
        return $stat && $stat->end_minute > 0;
    }

    // BATCH STATS FOR MULTIPLE MATCHES

    /**
     * Get total stats for multiple matches
     */
    public function getStatsForMatches(array $matchIds) {
        if (!$this->relationLoaded('stats')) {
            $stats = $this->stats()->whereIn('match_id', $matchIds)->get();
        } else {
            $stats = $this->stats->whereIn('match_id', $matchIds);
        }
        
        // SIMPLIFIED: Count distinct matches where end_minute > 0
        $matchesPlayed = $stats->where('end_minute', '>', 0)
            ->groupBy('match_id')
            ->count();

        return [
            'goals' => $stats->sum('goals') ?? 0,
            'assists' => $stats->sum('assists') ?? 0,
            'yellow_cards' => $stats->sum('yellow_cards') ?? 0,
            'red_cards' => $stats->sum('red_cards') ?? 0,
            'saves' => $stats->sum('saves') ?? 0,
            'tackles' => $stats->sum('tackles') ?? 0,
            'interceptions' => $stats->sum('interceptions') ?? 0,
            'clearances' => $stats->sum('clearances') ?? 0,
            'fouls' => $stats->sum('fouls') ?? 0,
            'avg_succ_passes' => round($stats->avg('succ_passes') ?? 0, 2),
            'avg_succ_ground_duels' => round($stats->avg('succ_ground_duels') ?? 0, 2),
            'avg_succ_aerial_duels' => round($stats->avg('succ_aerial_duels') ?? 0, 2),
            'avg_succ_dribbles' => round($stats->avg('succ_dribbles') ?? 0, 2),
            'matches_played' => $matchesPlayed
        ];
    }

    /**
     * Get all match statistics with match details
     */
    public function getAllMatchStats() {
        if (!$this->relationLoaded('stats')) {
            $stats = $this->stats()
                ->with('match')
                ->where('end_minute', '>', 0)
                ->orderBy('match_id')
                ->get();
        } else {
            $stats = $this->stats
                ->where('end_minute', '>', 0)
                ->sortBy('match_id');
        }

        return $stats->map(function($stat) {
            return [
                'match_id' => $stat->match_id,
                'minutes_played' => max(0, $stat->end_minute - $stat->start_minute),
                'goals' => $stat->goals ?? 0,
                'assists' => $stat->assists ?? 0,
                'yellow_cards' => $stat->yellow_cards ?? 0,
                'red_cards' => $stat->red_cards ?? 0,
                'succ_passes' => $stat->succ_passes ?? 0,
                'succ_ground_duels' => $stat->succ_ground_duels ?? 0,
                'succ_aerial_duels' => $stat->succ_aerial_duels ?? 0,
                'succ_dribbles' => $stat->succ_dribbles ?? 0,
                'saves' => $stat->saves ?? 0,
                'tackles' => $stat->tackles ?? 0,
                'interceptions' => $stat->interceptions ?? 0,
                'clearances' => $stat->clearances ?? 0,
                'fouls' => $stat->fouls ?? 0,
            ];
        });
    }
}