@extends('layouts.app')

@section('title', "Matchday $matchday")

@push('styles')
<style>
    .matches-container {
        padding-top: 80px;
        padding-bottom: 60px;
        max-width: 900px;
        margin: 0 auto;
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .matchday-header {
        background: linear-gradient(135deg, #4A148C 0%, #6A1B9A 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
    }
    
    .match-card {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.2s ease;
    }
    
    .match-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    
    .club-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
    }
    
    .score {
        font-size: 1.5rem;
        font-weight: bold;
        margin: 0 1rem;
        white-space: nowrap;
    }
    
    .match-date {
        color: #666;
        font-size: 0.9rem;
    }
    
    .venue {
        font-size: 0.9rem;
    }
    
    .no-matches {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    /* Responsive Styles */
    @media (max-width: 640px) {
        .matches-container {
            padding-top: 70px;
        }

        .match-card {
            padding: 1rem;
        }

        .club-info {
            gap: 0.25rem;
        }

        .club-info .font-semibold {
            font-size: 0.9rem;
        }

        .score {
            font-size: 1.2rem;
            margin: 0 0.5rem;
        }

        .match-date {
            font-size: 0.8rem;
        }

        .venue {
            font-size: 0.8rem;
        }

        .match-date-venue {
            flex-direction: column;
            gap: 0.25rem;
        }

        .match-date-venue .mx-2 {
            display: none;
        }

        .no-matches {
            padding: 2rem 1rem;
        }

        .no-matches .text-2xl {
            font-size: 1.5rem;
        }

        .no-matches .text-6xl {
            font-size: 3rem;
        }
    }

    @media (max-width: 480px) {
        .club-info .font-semibold {
            font-size: 0.85rem;
        }

        .score {
            font-size: 1.1rem;
            margin: 0 0.25rem;
        }
    }
</style>
@endpush

@section('content')
<div class="matches-container">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold mb-2">Matchday {{ $matchday }}</h1>
            <p class="text-gray-600 text-sm sm:text-base">Soegija Super League 2025/2026</p>
        </div>

        <!-- Back to all matches -->
        <div class="text-center mb-6">
            <a href="{{ route('matches.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-800 text-sm sm:text-base">
                <i class="fas fa-arrow-left mr-2"></i> Back to All Matches
            </a>
        </div>

        <!-- Matches for this matchday -->
        @if($matches->count() > 0)
            @foreach($matches as $match)
                <a href="{{ route('matches.show', $match->id) }}" class="block no-underline text-gray-800 hover:text-gray-800">
                    <div class="match-card">
                        <div class="text-center mb-3 match-date-venue flex flex-col sm:flex-row items-center justify-center">
                            <span class="match-date">
                                {{ $match->match_date->format('F j, Y • g:i A') }}
                            </span>
                            <span class="mx-2 hidden sm:inline">•</span>
                            <span class="venue">{{ $match->venue }}</span>
                        </div>
                        
                        <div class="club-info">
                            <div class="text-right flex-1 min-w-0">
                                <div class="font-semibold text-base sm:text-lg truncate">{{ $match->homeClub->name }}</div>
                            </div>
                            
                            <div class="score">
                                @if($match->isPlayed())
                                    {{ $match->home_score }} - {{ $match->away_score }}
                                @else
                                    VS
                                @endif
                            </div>
                            
                            <div class="text-left flex-1 min-w-0">
                                <div class="font-semibold text-base sm:text-lg truncate">{{ $match->awayClub->name }}</div>
                            </div>
                        </div>
                        
                        @if($match->isPlayed())
                            <div class="text-center mt-3">
                                @if($match->isDraw())
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs sm:text-sm">Draw</span>
                                @else
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs sm:text-sm">
                                        Winner: {{ $match->winner->name ?? 'N/A' }}
                                    </span>
                                @endif
                            </div>
                        @else
                            <div class="text-center mt-3">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs sm:text-sm">Scheduled</span>
                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        @else
            <div class="no-matches">
                <i class="fas fa-futbol text-4xl sm:text-6xl text-gray-400 mb-4"></i>
                <h3 class="text-xl sm:text-2xl font-semibold mb-2">No Matches for Matchday {{ $matchday }}</h3>
                <p class="text-gray-600 mb-4 text-sm sm:text-base">There are no scheduled matches for this matchday.</p>
                <a href="{{ route('matches.index') }}" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition duration-300 text-sm sm:text-base inline-block">
                    View All Matches
                </a>
            </div>
        @endif
    </div>
</div>
@endsection