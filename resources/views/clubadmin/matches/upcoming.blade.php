@extends('layouts.clubadmin')

@section('title', 'Upcoming Matches')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Upcoming Matches</h1>
    <p class="text-gray-600">Manage lineups for your upcoming matches</p>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">{{ $club->name }} - Upcoming Matches</h2>
    </div>
    <div class="p-6">
        @if($matches->count() > 0)
            <div class="space-y-4">
                @foreach($matches as $match)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-green-50 transition">
                    <div class="flex items-center space-x-4">
                        <div class="text-center">
                            <div class="font-semibold {{ $match->home_club_id === $club->id ? 'text-green-600' : '' }}">{{ $match->homeClub->name }}</div>
                            <div class="text-sm text-gray-500">Home</div>
                        </div>
                        <div class="text-xl font-bold px-4">VS</div>
                        <div class="text-center">
                            <div class="font-semibold {{ $match->away_club_id === $club->id ? 'text-green-600' : '' }}">{{ $match->awayClub->name }}</div>
                            <div class="text-sm text-gray-500">Away</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500 mb-2">{{ $match->match_date->format('M d, Y H:i') }}</div>
                        <div class="text-sm text-gray-500 mb-2">Matchday {{ $match->matchday }}</div>
                        <a href="{{ route('clubadmin.matches.show', $match) }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition text-sm">
                            <i class="fas fa-users mr-2"></i>Manage Lineup
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $matches->links() }}
            </div>
        @else
            <p class="text-gray-500 text-center py-4">No upcoming matches found.</p>
        @endif
    </div>
</div>
@endsection

