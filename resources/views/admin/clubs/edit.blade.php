@extends('layouts.admin')

@section('title', 'Edit Club')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Club: {{ $club->name }}</h1>
    <p class="text-gray-600">Update club information</p>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.clubs.update', $club) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Club Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $club->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="coach" class="block text-sm font-medium text-gray-700">Coach</label>
                <input type="text" name="coach" id="coach" value="{{ old('coach', $club->coach) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('coach')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Club Statistics -->
        <div class="border-t pt-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Club Statistics</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-2xl font-bold text-gray-900">{{ $club->players_count }}</div>
                    <div class="text-sm text-gray-600">Players</div>
                </div>
                
                @php
                    $totalGoals = $club->players->sum('total_goals');
                    $totalAssists = $club->players->sum('total_assists');
                    $maxMatchesPlayed = $club->players->max('matches_played') ?? 0;
                @endphp
                
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-600">{{ $totalGoals }}</div>
                    <div class="text-sm text-gray-600">Total Goals</div>
                </div>
                
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600">{{ $totalAssists }}</div>
                    <div class="text-sm text-gray-600">Total Assists</div>
                </div>
                
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-2xl font-bold text-yellow-600">{{ $maxMatchesPlayed }}</div>
                    <div class="text-sm text-gray-600">Matches Played</div>
                </div>
            </div>
        </div>

        <!-- Players List -->
        <div class="border-t pt-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Players</h3>
            
            @if($club->players->count() > 0)
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Player</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Position</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Jersey</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Goals</th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Assists</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($club->players as $player)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                    <div class="font-medium">{{ $player->name }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $player->position }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">#{{ $player->jersey_no }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $player->total_goals }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $player->total_assists }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 bg-gray-50 rounded-lg">
                    <i class="fas fa-users text-gray-400 text-4xl mb-3"></i>
                    <p class="text-gray-500">No players found for this club.</p>
                    <a href="{{ route('admin.players.create') }}" class="inline-block mt-2 text-red-600 hover:text-red-700">
                        Add players to this club
                    </a>
                </div>
            @endif
        </div>

        <div class="flex justify-end space-x-3 pt-6 border-t">
            <a href="{{ route('admin.clubs.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Cancel</a>
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Update Club</button>
        </div>
    </form>
</div>
@endsection