@extends('layouts.admin')

@section('title', 'Manage Standings')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">League Standings</h1>
    <p class="text-gray-600">View and manage league standings</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Club</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Played</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Won</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Drawn</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lost</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">GF</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">GA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">GD</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($standings as $index => $standing)
                <tr class="{{ $index < 4 ? 'bg-green-50' : ($index >= count($standings) - 3 ? 'bg-red-50' : '') }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="text-sm font-medium text-gray-900">{{ $index + 1 }}</span>
                            @if($index == 0)
                                <i class="fas fa-trophy text-yellow-500 ml-2"></i>
                            @elseif($index < 4)
                                <i class="fas fa-arrow-up text-green-500 ml-2"></i>
                            @elseif($index >= count($standings) - 3)
                                <i class="fas fa-arrow-down text-red-500 ml-2"></i>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                                <i class="fas fa-users text-gray-500"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $standing->club->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standing->played }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standing->won }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standing->draw }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standing->lost }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standing->goals_for }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standing->goals_against }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium 
                        {{ $standing->goal_diff > 0 ? 'text-green-600' : ($standing->goal_diff < 0 ? 'text-red-600' : 'text-gray-600') }}">
                        {{ $standing->goal_diff > 0 ? '+' : '' }}{{ $standing->goal_diff }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ $standing->points }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.standings.edit', $standing) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Legend and Statistics -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Legend -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Standings Legend</h3>
        <div class="space-y-3">
            <div class="flex items-center">
                <div class="w-4 h-4 bg-green-100 border border-green-300 rounded mr-3"></div>
                <span class="text-sm text-gray-600">Champions League Qualification (Top 4)</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 bg-red-100 border border-red-300 rounded mr-3"></div>
                <span class="text-sm text-gray-600">Relegation Zone (Bottom 3)</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-trophy text-yellow-500 mr-3"></i>
                <span class="text-sm text-gray-600">League Champion</span>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">League Statistics</h3>
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Total Matches Played</span>
                <span class="text-sm font-medium text-gray-900">{{ $standings->sum('played') / 2 }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Total Goals Scored</span>
                <span class="text-sm font-medium text-gray-900">{{ $standings->sum('goals_for') }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Average Goals per Match</span>
                <span class="text-sm font-medium text-gray-900">
                    @php
                        $totalMatches = $standings->sum('played') / 2;
                        $totalGoals = $standings->sum('goals_for');
                        $avgGoals = $totalMatches > 0 ? round($totalGoals / $totalMatches, 2) : 0;
                    @endphp
                    {{ $avgGoals }}
                </span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Best Attack</span>
                <span class="text-sm font-medium text-gray-900">
                    {{ $standings->sortByDesc('goals_for')->first()->club->name }} ({{ $standings->max('goals_for') }})
                </span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Best Defense</span>
                <span class="text-sm font-medium text-gray-900">
                    {{ $standings->sortBy('goals_against')->first()->club->name }} ({{ $standings->min('goals_against') }})
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Note -->
<div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
    <div class="flex">
        <i class="fas fa-exclamation-triangle text-yellow-400 mt-1 mr-3"></i>
        <div>
            <h4 class="text-sm font-medium text-yellow-800">Note</h4>
            <p class="text-sm text-yellow-700 mt-1">
                Standings are automatically calculated based on match results. Manual edits should only be used for corrections.
            </p>
        </div>
    </div>
</div>
@endsection