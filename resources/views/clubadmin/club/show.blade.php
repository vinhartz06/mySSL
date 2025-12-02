@extends('layouts.clubadmin')

@section('title', 'Club Details')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Club Details</h1>
    <p class="text-gray-600">View and manage your club information</p>
</div>

<!-- Club Information -->
<div class="bg-white rounded-lg shadow mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">{{ $club->name }}</h2>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-600 mb-1">Coach</p>
                <p class="text-lg font-semibold text-gray-900">{{ $club->coach ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Players</p>
                <p class="text-lg font-semibold text-gray-900">{{ $players->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Club Standing -->
@if($standing)
<div class="bg-white rounded-lg shadow mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">League Standing</h2>
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
                <p class="text-sm text-gray-600">Drawn</p>
                <p class="text-3xl font-bold text-gray-600">{{ $standing->draw }}</p>
            </div>
            <div class="text-center p-4 bg-red-50 rounded-lg">
                <p class="text-sm text-gray-600">Lost</p>
                <p class="text-3xl font-bold text-red-600">{{ $standing->lost }}</p>
            </div>
            <div class="text-center p-4 bg-blue-50 rounded-lg">
                <p class="text-sm text-gray-600">Goals For</p>
                <p class="text-3xl font-bold text-blue-600">{{ $standing->goals_for }}</p>
            </div>
            <div class="text-center p-4 bg-red-50 rounded-lg">
                <p class="text-sm text-gray-600">Goals Against</p>
                <p class="text-3xl font-bold text-red-600">{{ $standing->goals_against }}</p>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600">Goal Difference</p>
                <p class="text-3xl font-bold text-gray-600">{{ $standing->goal_diff > 0 ? '+' : '' }}{{ $standing->goal_diff }}</p>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Players List -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-800">Players</h2>
        <a href="{{ route('clubadmin.players.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            <i class="fas fa-plus mr-2"></i>Add Player
        </a>
    </div>
    <div class="p-6">
        @if($players->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jersey #</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($players as $player)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $player->jersey_no }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $player->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $player->position }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('clubadmin.players.edit', $player) }}" class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-center py-4">No players found. <a href="{{ route('clubadmin.players.create') }}" class="text-green-600 hover:text-green-700">Add your first player</a></p>
        @endif
    </div>
</div>
@endsection

