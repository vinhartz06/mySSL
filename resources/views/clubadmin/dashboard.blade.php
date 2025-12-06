@extends('layouts.clubadmin')

@section('title', 'Club Admin Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-600">Welcome to the Club Admin Panel - {{ $club->name }}</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-user"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Players</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_players'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Upcoming Matches</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['upcoming_matches'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Completed Matches</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['completed_matches'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-futbol"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Goals</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_goals'] }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Club Stats -->
@if($standing)
<div class="bg-white rounded-lg shadow mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">Club Stats</h2>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center p-4 bg-green-50 rounded-lg">
                <p class="text-sm text-gray-600">Points</p>
                <p class="text-3xl font-bold text-green-600">{{ $standing->points }}</p>
            </div>
            <div class="text-center p-4 bg-blue-50 rounded-lg">
                <p class="text-sm text-gray-600">Played</p>
                <p class="text-3xl font-bold text-blue-600">{{ $standing->played }}</p>
            </div>
            <div class="text-center p-4 bg-green-50 rounded-lg">
                <p class="text-sm text-gray-600">Won</p>
                <p class="text-3xl font-bold text-green-600">{{ $standing->won }}</p>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600">Goal Difference</p>
                <p class="text-3xl font-bold text-gray-600">{{ $standing->goal_diff > 0 ? '+' : '' }}{{ $standing->goal_diff }}</p>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Upcoming Matches -->
@if($upcomingMatches->count() > 0)
<div class="bg-white rounded-lg shadow mb-8">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-800">Upcoming Matches</h2>
        <a href="{{ route('clubadmin.matches.upcoming') }}" class="text-green-600 hover:text-green-700 text-sm font-medium">View All</a>
    </div>
    <div class="p-6">
        <div class="space-y-4">
            @foreach($upcomingMatches as $match)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-green-50 transition">
                <div class="flex items-center space-x-4">
                    <div class="text-center">
                        <div class="font-semibold">{{ $match->homeClub->name }}</div>
                        <div class="text-sm text-gray-500">Home</div>
                    </div>
                    <div class="text-xl font-bold px-4">VS</div>
                    <div class="text-center">
                        <div class="font-semibold">{{ $match->awayClub->name }}</div>
                        <div class="text-sm text-gray-500">Away</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-500 mb-2">{{ $match->match_date->format('M d, Y') }}</div>
                    <a href="{{ route('clubadmin.matches.show', $match) }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition text-sm">
                        Manage Lineup
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Recent Matches -->
@if($recentMatches->count() > 0)
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">Recent Matches</h2>
    </div>
    <div class="p-6">
        <div class="space-y-4">
            @foreach($recentMatches as $match)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center space-x-4">
                    <div class="text-center">
                        <div class="font-semibold">{{ $match->homeClub->name }}</div>
                        <div class="text-sm text-gray-500">Home</div>
                    </div>
                    <div class="text-xl font-bold px-4">
                        @if($match->isPlayed())
                            {{ $match->home_score }} - {{ $match->away_score }}
                        @else
                            VS
                        @endif
                    </div>
                    <div class="text-center">
                        <div class="font-semibold">{{ $match->awayClub->name }}</div>
                        <div class="text-sm text-gray-500">Away</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-500 mb-2">{{ $match->match_date->format('M d, Y') }}</div>
                    <span class="inline-block px-2 py-1 text-xs rounded 
                        {{ $match->status === 'fulltime' ? 'bg-green-100 text-green-800' : 
                           ($match->status === 'scheduled' ? 'bg-blue-100 text-blue-800' : 
                           'bg-yellow-100 text-yellow-800') }}">
                        {{ ucfirst($match->status) }}
                    </span>
                    @if($match->isPlayed())
                    <div class="mt-2">
                        <a href="{{ route('clubadmin.stats.match', $match) }}" class="text-green-600 hover:text-green-700 text-sm font-medium">
                            View Stats
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection

