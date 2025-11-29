<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'player_id',
        'start_minute',
        'end_minute',
        'goals',
        'assists',
        'interceptions',
        'clearances',
        'tackles',
        'saves',
        'fouls',
        'yellow_cards',
        'red_cards',
        'succ_passes',
        'succ_ground_duels',
        'succ_aerial_duels',
        'succ_dribbles',
    ];

    /**
     * Get the player that owns the stat.
     */
    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * Get the match that owns the stat.
     */
    // public function match()
    // {
    //     return $this->belongsTo(Match::class);
    // }
}