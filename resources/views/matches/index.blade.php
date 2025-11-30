@extends('layouts.app')

@section('title', 'Matches')

@push('styles')
<style>
    .matches-container {
        padding-top: 80px;
        padding-bottom: 60px;
    }
    
    .matchday-nav {
        background: linear-gradient(135deg, #4A148C 0%, #6A1B9A 100%);
    }
    
    .match-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .match-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    
    .team-logo {
        width: 50px;
        height: 50px;
        background: #f0f0f0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    
    .match-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .status-completed {
        background-color: #10B981;
        color: white;
    }
    
    .status-upcoming {
        background-color: #F59E0B;
        color: white;
    }
    
    .status-cancelled {
        background-color: #EF4444;
        color: white;
        /* animation: pulse 2s infinite; */
    }

    /* .status-live {
        background-color: #EF4444;
        color: white;
        animation: pulse 2s infinite;
    } */
    
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.7; }
        100% { opacity: 1; }
    }
    
    .match-date-header {
        background: #f8f9fa;
        padding: 10px 20px;
        margin: 20px 0 10px 0;
        border-radius: 8px;
        font-weight: 600;
        color: #4A148C;
    }
</style>
@endpush

@section('content')
<div class="matches-container">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold mb-2">Soegija Super League Matches</h1>
            <p class="text-gray-600">2025/2026 Season - All Matchdays</p>
        </div>

        <!-- Matchday Navigation -->
        <div class="matchday-nav text-white rounded-lg p-4 mb-8">
            <div class="flex flex-wrap gap-2 justify-center">
                @for($i = 1; $i <= 18; $i++)
                    <a href="{{ route('matches.by-matchday', $i) }}" 
                       class="px-4 py-2 rounded bg-white bg-opacity-20 hover:bg-opacity-30 transition">
                        Matchday {{ $i }}
                    </a>
                @endfor
            </div>
        </div>

        <!-- Matches List -->
        @if($matches->count() > 0)
            @foreach($matchesByDate as $date => $matchesOnDate)
                <div class="match-date-header">
                    {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}
                </div>
                
                @foreach($matchesOnDate as $match)
                    <a href="{{ route('matches.show', $match->id) }}" class="block">
                        <div class="match-card">
                            <div class="flex justify-between items-center mb-3">
                                <span class="match-status 
                                    {{ $match->status === 'fulltime' ? 'status-completed' : '' }}
                                    {{ in_array($match->status, ['scheduled', 'postponed']) ? 'status-upcoming' : '' }}
                                    {{ $match->status === 'cancelled' ? 'status-cancelled' : '' }}">
                                    @if($match->status === 'fulltime')
                                        FT
                                    @else
                                        {{ ucfirst($match->status) }}
                                    @endif
                                </span>
                                <span class="text-gray-500 text-sm">
                                    {{ $match->match_date->format('H:i') }} • {{ $match->venue }}
                                </span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <!-- Home Team -->
                                <div class="text-center flex-1">
                                    <div class="team-logo mx-auto mb-2">
                                        ⚽
                                    </div>
                                    <strong class="text-lg">{{ $match->homeClub->name }}</strong>
                                    @if($match->isPlayed())
                                        <div class="text-2xl font-bold mt-1">{{ $match->home_score }}</div>
                                    @endif
                                </div>
                                
                                <!-- VS / Score -->
                                <div class="text-center px-4">
                                    @if($match->isPlayed())
                                        <div class="text-xl font-bold">VS</div>
                                        <div class="text-sm text-gray-500">Final Score</div>
                                    @else
                                        <div class="text-2xl font-bold">VS</div>
                                        <div class="text-sm text-gray-500">{{ $match->match_date->format('H:i') }}</div>
                                    @endif
                                </div>
                                
                                <!-- Away Team -->
                                <div class="text-center flex-1">
                                    <div class="team-logo mx-auto mb-2">
                                        ⚽
                                    </div>
                                    <strong class="text-lg">{{ $match->awayClub->name }}</strong>
                                    @if($match->isPlayed())
                                        <div class="text-2xl font-bold mt-1">{{ $match->away_score }}</div>
                                    @endif
                                </div>
                            </div>
                            
                            @if($match->isPlayed() && $match->winner)
                                <div class="text-center mt-3 text-sm text-green-600 font-semibold">
                                    🏆 {{ $match->winner->name }} wins!
                                </div>
                            @elseif($match->isPlayed() && $match->isDraw())
                                <div class="text-center mt-3 text-sm text-gray-600 font-semibold">
                                    🤝 Match ended in a draw
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            @endforeach
        @else
            <div class="text-center py-12">
                <i class="fas fa-futbol text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">No Matches Scheduled</h3>
                <p class="text-gray-600">Matches will appear here once the schedule is released.</p>
            </div>
        @endif
    </div>
</div>
@endsection