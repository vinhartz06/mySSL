<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Standing extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_id',
        'played',
        'won',
        'draw',
        'lost',
        'goals_for',
        'goals_against',
        'goal_diff',
        'points'
    ];

    protected $casts = [
        'played' => 'integer',
        'won' => 'integer',
        'draw' => 'integer',
        'lost' => 'integer',
        'goals_for' => 'integer',
        'goals_against' => 'integer',
        'goal_diff' => 'integer',
        'points' => 'integer',
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }
}