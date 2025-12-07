@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-600">Welcome to the Admin Panel</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-600">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Matches</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_matches'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-users"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Clubs</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_clubs'] }}</p>
            </div>
        </div>
    </div>

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
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-trophy"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Upcoming Matches</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['upcoming_matches'] }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Matches -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">Recent Matches</h2>
    </div>
    <div class="p-6">
        @if($recentMatches->count() > 0)
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
                        <div class="text-sm text-gray-500">{{ $match->match_date->format('M d, Y') }}</div>
                        <span class="inline-block px-2 py-1 text-xs rounded 
                            {{ $match->status === 'fulltime' ? 'bg-green-100 text-green-800' : 
                               ($match->status === 'scheduled' ? 'bg-blue-100 text-blue-800' : 
                               'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($match->status) }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-4">No matches found.</p>
        @endif
    </div>
</div>
@endsection