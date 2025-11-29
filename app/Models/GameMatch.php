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