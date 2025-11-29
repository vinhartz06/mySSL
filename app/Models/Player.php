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

    // calc matches played
    public function getMatchesPlayedAttribute() {
        return $this->stats()
            ->whereNotNull('start_minute')
            ->whereNotNull('end_minute')
            ->whereRaw('end_minute - start_minute > 0')
            ->distinct('match_id')
            ->count('match_id');
    }

    // calc goals
    public function getTotalGoalsAttribute() {
        return $this->stats()->sum('goals') ?? 0;
    }

    // calc assists
    public function getTotalAssistsAttribute() {
        return $this->stats()->sum('assists') ?? 0;
    }

    // calc yellow
    public function getTotalYellowCardsAttribute() {
        return $this->stats()->sum('yellow_cards') ?? 0;
    }

    // calc red
    public function getTotalRedCardsAttribute() {
        return $this->stats()->sum('red_cards') ?? 0;
    }

    // calc saves
    public function getTotalSavesAttribute() {
        return $this->stats()->sum('saves') ?? 0;
    }

    // calc tackles
    public function getTotalTacklesAttribute() {
        return $this->stats()->sum('tackles') ?? 0;
    }

    // calc intercepts
    public function getTotalInterceptionsAttribute() {
        return $this->stats()->sum('interceptions') ?? 0;
    }

    // calc clearances
    public function getTotalClearancesAttribute() {
        return $this->stats()->sum('clearances') ?? 0;
    }

    // calc fouls
    public function getTotalFoulsAttribute() {
        return $this->stats()->sum('fouls') ?? 0;
    }

    // AVERAGE CALCULATIONS FOR ALL MATCHES

    // average successful passes (all matches)
    public function getAvgSuccPassesAttribute() {
        return round($this->stats()->avg('succ_passes') ?? 0, 2);
    }

    // average successful ground duels (all matches)
    public function getAvgSuccGroundDuelsAttribute() {
        return round($this->stats()->avg('succ_ground_duels') ?? 0, 2);
    }

    // average successful aerial duels (all matches)
    public function getAvgSuccAerialDuelsAttribute() {
        return round($this->stats()->avg('succ_aerial_duels') ?? 0, 2);
    }

    // average successful dribbles (all matches)
    public function getAvgSuccDribblesAttribute() {
        return round($this->stats()->avg('succ_dribbles') ?? 0, 2);
    }

    // STATS FOR SPECIFIC MATCH

    /**
     * Get player stats for a specific match
     */
    public function getStatsForMatch($matchId) {
        return $this->stats()->where('match_id', $matchId)->first();
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
        return $this->getMinutesPlayedForMatch($matchId) > 0;
    }

    // BATCH STATS FOR MULTIPLE MATCHES

    /**
     * Get total stats for multiple matches
     */
    public function getStatsForMatches(array $matchIds) {
        $stats = $this->stats()->whereIn('match_id', $matchIds)->get();
        
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
            'matches_played' => $stats->filter(function($stat) {
                return $stat->start_minute && $stat->end_minute && ($stat->end_minute - $stat->start_minute > 0);
            })->count()
        ];
    }

    /**
     * Get all match statistics with match details
     */
    public function getAllMatchStats() {
        return $this->stats()
            ->with('match') // assuming you have a Match model
            ->whereNotNull('start_minute')
            ->whereNotNull('end_minute')
            ->whereRaw('end_minute - start_minute > 0')
            ->orderBy('match_id')
            ->get()
            ->map(function($stat) {
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