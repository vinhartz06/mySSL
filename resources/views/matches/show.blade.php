@extends('layouts.app')

@section('title', 'Match Details')

@push('styles')
<style>
    .match-detail-container {
        padding-top: 80px;
        padding-bottom: 60px;
    }
    
    .team-header {
        background: linear-gradient(135deg, #4A148C 0%, #6A1B9A 100%);
        color: white;
    }
    
    .score-display {
        font-size: 3rem;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    
    .lineup-section {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .player-card {
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 8px;
        background: #f8f9fa;
        transition: background-color 0.3s;
    }
    
    .player-card:hover {
        background: #e9ecef;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
    
    .stat-item {
        background: white;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .stat-value {
        font-size: 1.5rem;
        font-weight: bold;
        color: #4A148C;
    }
    
    .formation-badge {
        background: #4A148C;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="match-detail-container">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Back Button -->
        <a href="{{ route('matches.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-800 mb-6">
            <i class="fas fa-arrow-left mr-2"></i> Back to Matches
        </a>

        <!-- Match Header -->
        <div class="team-header rounded-lg p-6 mb-8">
            <div class="flex justify-between items-center mb-4">
                <span class="formation-badge">
                    {{ $match->status === 'fulltime' ? 'FULLTIME' : strtoupper($match->status) }}
                </span>
                <span class="text-white opacity-90">
                    {{ $match->match_date->format('l, F j, Y • H:i') }} • {{ $match->venue }}
                </span>
            </div>
            
            <div class="flex justify-between items-center">
                <!-- Home Team -->
                <div class="text-center flex-1">
                    <div class="text-2xl font-bold mb-2">{{ $match->homeClub->name }}</div>
                    <div class="text-sm opacity-90">Home</div>
                </div>
                
                <!-- Score -->
                <div class="text-center px-8">
                    @if($match->isPlayed())
                        <div class="score-display">
                            {{ $match->home_score }} - {{ $match->away_score }}
                        </div>
                        <div class="text-white opacity-90 mt-2">
                            Final Score
                        </div>
                    @else
                        <div class="score-display">VS</div>
                        <div class="text-white opacity-90 mt-2">
                            {{ $match->match_date->format('H:i') }}
                        </div>
                    @endif
                </div>
                
                <!-- Away Team -->
                <div class="text-center flex-1">
                    <div class="text-2xl font-bold mb-2">{{ $match->awayClub->name }}</div>
                    <div class="text-sm opacity-90">Away</div>
                </div>
            </div>
            
            @if($match->isPlayed())
                <div class="text-center mt-4">
                    @if($match->winner)
                        <div class="text-lg font-semibold bg-yellow-400 text-black inline-block px-4 py-1 rounded-full">
                            🏆 {{ $match->winner->name }} wins the match!
                        </div>
                    @else
                        <div class="text-lg font-semibold bg-gray-400 text-white inline-block px-4 py-1 rounded-full">
                            🤝 Match ended in a draw
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Lineups and Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Home Team Lineup -->
            <div class="lineup-section">
                <h3 class="text-xl font-bold mb-4 flex items-center justify-between">
                    <span>{{ $match->homeClub->name }} Lineup</span>
                    <span class="formation-badge">4-3-3</span>
                </h3>
                
                <h4 class="font-semibold text-gray-700 mb-3">Starting XI</h4>
                @if($homeStarters->count() > 0)
                    @foreach($homeStarters as $lineup)
                        <div class="player-card">
                            <div class="flex justify-between items-center">
                                <div>
                                    <strong>{{ $lineup->player->name }}</strong>
                                    <span class="text-sm text-gray-600 ml-2">#{{ $lineup->player->jersey_no }}</span>
                                </div>
                                <span class="text-sm text-gray-500">{{ $lineup->player->position }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 text-center py-4">Lineup not available</p>
                @endif
                
                <h4 class="font-semibold text-gray-700 mt-6 mb-3">Substitutes</h4>
                @if($homeSubstitutes->count() > 0)
                    @foreach($homeSubstitutes as $lineup)
                        <div class="player-card">
                            <div class="flex justify-between items-center">
                                <div>
                                    <strong>{{ $lineup->player->name }}</strong>
                                    <span class="text-sm text-gray-600 ml-2">#{{ $lineup->player->jersey_no }}</span>
                                </div>
                                <span class="text-sm text-gray-500">{{ $lineup->player->position }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 text-center py-4">No substitutes listed</p>
                @endif
            </div>

            <!-- Away Team Lineup -->
            <div class="lineup-section">
                <h3 class="text-xl font-bold mb-4 flex items-center justify-between">
                    <span>{{ $match->awayClub->name }} Lineup</span>
                    <span class="formation-badge">4-4-2</span>
                </h3>
                
                <h4 class="font-semibold text-gray-700 mb-3">Starting XI</h4>
                @if($awayStarters->count() > 0)
                    @foreach($awayStarters as $lineup)
                        <div class="player-card">
                            <div class="flex justify-between items-center">
                                <div>
                                    <strong>{{ $lineup->player->name }}</strong>
                                    <span class="text-sm text-gray-600 ml-2">#{{ $lineup->player->jersey_no }}</span>
                                </div>
                                <span class="text-sm text-gray-500">{{ $lineup->player->position }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 text-center py-4">Lineup not available</p>
                @endif
                
                <h4 class="font-semibold text-gray-700 mt-6 mb-3">Substitutes</h4>
                @if($awaySubstitutes->count() > 0)
                    @foreach($awaySubstitutes as $lineup)
                        <div class="player-card">
                            <div class="flex justify-between items-center">
                                <div>
                                    <strong>{{ $lineup->player->name }}</strong>
                                    <span class="text-sm text-gray-600 ml-2">#{{ $lineup->player->jersey_no }}</span>
                                </div>
                                <span class="text-sm text-gray-500">{{ $lineup->player->position }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 text-center py-4">No substitutes listed</p>
                @endif
            </div>
        </div>

        <!-- Match Statistics -->
        @if($match->isPlayed())
        <div class="lineup-section mt-8">
            <h3 class="text-xl font-bold mb-6 text-center">Match Statistics</h3>
            
            <div class="stats-grid">
                <!-- Goals -->
                <div class="stat-item">
                    <div class="stat-value">{{ $matchStats['home']['goals'] }} - {{ $matchStats['away']['goals'] }}</div>
                    <div class="text-gray-600">Goals</div>
                </div>
                
                <!-- Assists -->
                <div class="stat-item">
                    <div class="stat-value">{{ $matchStats['home']['assists'] }} - {{ $matchStats['away']['assists'] }}</div>
                    <div class="text-gray-600">Assists</div>
                </div>
                
                <!-- Shots -->
                <div class="stat-item">
                    <div class="stat-value">{{ $matchStats['home']['shots'] }} - {{ $matchStats['away']['shots'] }}</div>
                    <div class="text-gray-600">Shots</div>
                </div>
                
                <!-- Possession -->
                <div class="stat-item">
                    <div class="stat-value">{{ $matchStats['home']['possession'] }}% - {{ $matchStats['away']['possession'] }}%</div>
                    <div class="text-gray-600">Possession</div>
                </div>
                
                <!-- Fouls -->
                <div class="stat-item">
                    <div class="stat-value">{{ $matchStats['home']['fouls'] }} - {{ $matchStats['away']['fouls'] }}</div>
                    <div class="text-gray-600">Fouls</div>
                </div>
                
                <!-- Yellow Cards -->
                <div class="stat-item">
                    <div class="stat-value">{{ $matchStats['home']['yellow_cards'] }} - {{ $matchStats['away']['yellow_cards'] }}</div>
                    <div class="text-gray-600">Yellow Cards</div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection