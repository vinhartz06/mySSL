<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GameMatch extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'matches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'home_club_id',
        'away_club_id',
        'match_date',
        'venue',
        'status',
        'home_score',
        'away_score',
        'home_shots',
        'away_shots',
        'home_shots_on_target',
        'away_shots_on_target',
        'home_offsides',
        'away_offsides',
        'home_corners',
        'away_corners',
        'home_possession',
        'away_possession',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'match_date' => 'datetime',
        'home_score' => 'integer',
        'away_score' => 'integer',
        'home_shots' => 'integer',
        'away_shots' => 'integer',
        'home_shots_on_target' => 'integer',
        'away_shots_on_target' => 'integer',
        'home_offsides' => 'integer',
        'away_offsides' => 'integer',
        'home_corners' => 'integer',
        'away_corners' => 'integer',
        'home_possession' => 'decimal:2',
        'away_possession' => 'decimal:2',
    ];

    // get home club
    public function homeClub(): BelongsTo {
        return $this->belongsTo(Club::class, 'home_club_id');
    }

    // get away club
    public function awayClub(): BelongsTo {
        return $this->belongsTo(Club::class, 'away_club_id');
    }

    // get lineup
    public function lineups(): HasMany {
        return $this->hasMany(Lineup::class, 'match_id');
    }

    // get starting lineup
    public function startingLineups(): HasMany {
        return $this->lineups()->where('role', 'start');
    }

    // get subs
    public function substituteLineups(): HasMany {
        return $this->lineups()->where('role', 'sub');
    }

    // get home club standings
    public function homeStandings(): HasOne {
        return $this->hasOne(Standing::class, 'club_id', 'home_club_id');
    }

    // get away club standing
    public function awayStandings(): HasOne {
        return $this->hasOne(Standing::class, 'club_id', 'away_club_id');
    }

    // checks if match is played
    public function isPlayed(): bool
    {
        return $this->status === 'fulltime';
    }

    // get match result
    public function getResultAttribute(): string {
        if (!$this->isPlayed() || is_null($this->home_score) || is_null($this->away_score)) {
            return 'Not Played';
        }

        return "{$this->home_score} - {$this->away_score}";
    }

    // get winner
    public function getWinnerAttribute(): ?Club {
        if (!$this->isPlayed() || is_null($this->home_score) || is_null($this->away_score)) {
            return null;
        }

        if ($this->home_score > $this->away_score) {
            return $this->homeClub;
        } elseif ($this->away_score > $this->home_score) {
            return $this->awayClub;
        }

        return null; // Draw
    }

    // get loser
    public function getLoserAttribute(): ?Club {
        if (!$this->isPlayed() || is_null($this->home_score) || is_null($this->away_score)) {
            return null;
        }

        if ($this->home_score < $this->away_score) {
            return $this->homeClub;
        } elseif ($this->away_score < $this->home_score) {
            return $this->awayClub;
        }

        return null; // Draw
    }

    // check draw
    public function isDraw(): bool {
        return $this->isPlayed() && 
               !is_null($this->home_score) && 
               !is_null($this->away_score) && 
               $this->home_score === $this->away_score;
    }

    // total goals
    public function getTotalGoalsAttribute(): int {
        if (!$this->isPlayed() || is_null($this->home_score) || is_null($this->away_score)) {
            return 0;
        }

        return $this->home_score + $this->away_score;
    }

    // home gd
    public function getHomeGoalDifferenceAttribute(): int {
        if (!$this->isPlayed() || is_null($this->home_score) || is_null($this->away_score)) {
            return 0;
        }

        return $this->home_score - $this->away_score;
    }

    // away gd
    public function getAwayGoalDifferenceAttribute(): int {
        if (!$this->isPlayed() || is_null($this->home_score) || is_null($this->away_score)) {
            return 0;
        }

        return $this->away_score - $this->home_score;
    }

    // home points
    public function getHomePointsAttribute(): int {
        if (!$this->isPlayed() || is_null($this->home_score) || is_null($this->away_score)) {
            return 0;
        }

        if ($this->home_score > $this->away_score) {
            return 3;
        } elseif ($this->home_score === $this->away_score) {
            return 1;
        }

        return 0;
    }

    // away points
    public function getAwayPointsAttribute(): int {
        if (!$this->isPlayed() || is_null($this->home_score) || is_null($this->away_score)) {
            return 0;
        }

        if ($this->away_score > $this->home_score) {
            return 3;
        } elseif ($this->away_score === $this->home_score) {
            return 1;
        }

        return 0;
    }

    // Get total shots for the match
    public function getTotalShotsAttribute(): int {
        return ($this->home_shots ?? 0) + ($this->away_shots ?? 0);
    }

    // Get total shots on target for the match
    public function getTotalShotsOnTargetAttribute(): int {
        return ($this->home_shots_on_target ?? 0) + ($this->away_shots_on_target ?? 0);
    }

    // Get total corners for the match
    public function getTotalCornersAttribute(): int {
        return ($this->home_corners ?? 0) + ($this->away_corners ?? 0);
    }

    // Get total offsides for the match
    public function getTotalOffsidesAttribute(): int {
        return ($this->home_offsides ?? 0) + ($this->away_offsides ?? 0);
    }

    /**
     * Scope a query to only include completed matches.
     */
    public function scopeCompleted($query) {
        return $query->where('status', 'fulltime');
    }

    /**
     * Scope a query to only include upcoming matches.
     */
    public function scopeUpcoming($query) {
        return $query->where('status', 'scheduled')
                    ->orWhere('status', 'postponed');
    }

    /**
     * Scope a query to get matches for a specific club.
     */
    public function scopeForClub($query, $clubId) {
        return $query->where('home_club_id', $clubId)
                    ->orWhere('away_club_id', $clubId);
    }

    /**
     * Scope a query to get matches between two clubs.
     */
    public function scopeBetweenClubs($query, $club1Id, $club2Id) {
        return $query->where(function ($q) use ($club1Id, $club2Id) {
            $q->where('home_club_id', $club1Id)
              ->where('away_club_id', $club2Id);
        })->orWhere(function ($q) use ($club1Id, $club2Id) {
            $q->where('home_club_id', $club2Id)
              ->where('away_club_id', $club1Id);
        });
    }

    /**
     * Scope a query to order matches by date (most recent first).
     */
    public function scopeLatestFirst($query) {
        return $query->orderBy('match_date', 'desc');
    }

    /**
     * Scope a query to order matches by date (upcoming first).
     */
    public function scopeUpcomingFirst($query) {
        return $query->orderBy('match_date', 'asc');
    }
}