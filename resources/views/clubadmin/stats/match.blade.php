@extends('layouts.clubadmin')

@section('title', 'Match Statistics')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Match Statistics</h1>
    <p class="text-gray-600">{{ $match->homeClub->name }} vs {{ $match->awayClub->name }} - {{ $match->match_date->format('M d, Y') }}</p>
</div>

<form action="{{ route('clubadmin.stats.store', $match) }}" method="POST">
    @csrf

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Player Statistics for {{ $club->name }}</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Player</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Start Min</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">End Min</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Goals</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Assists</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Yellow</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Red</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Passes %</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ground Duels %</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aerial Duels %</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dribbles %</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Saves</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tackles</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Interceptions</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Clearances</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fouls</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($players as $player)
                    @php
                        $stat = $stats->get($player->id);
                    @endphp
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">#{{ $player->jersey_no }} {{ $player->name }}</div>
                            <div class="text-xs text-gray-500">{{ $player->position }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][start_minute]" 
                                value="{{ old("stats.{$player->id}.start_minute", $stat ? $stat->start_minute : '') }}" 
                                min="0" max="90" 
                                class="w-20 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][end_minute]" 
                                value="{{ old("stats.{$player->id}.end_minute", $stat ? $stat->end_minute : '') }}" 
                                min="0" max="120" 
                                class="w-20 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][goals]" 
                                value="{{ old("stats.{$player->id}.goals", $stat ? $stat->goals : '') }}" 
                                min="0" 
                                class="w-16 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][assists]" 
                                value="{{ old("stats.{$player->id}.assists", $stat ? $stat->assists : '') }}" 
                                min="0" 
                                class="w-16 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][yellow_cards]" 
                                value="{{ old("stats.{$player->id}.yellow_cards", $stat ? $stat->yellow_cards : '') }}" 
                                min="0" max="2" 
                                class="w-16 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][red_cards]" 
                                value="{{ old("stats.{$player->id}.red_cards", $stat ? $stat->red_cards : '') }}" 
                                min="0" max="1" 
                                class="w-16 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][succ_passes]" 
                                value="{{ old("stats.{$player->id}.succ_passes", $stat ? $stat->succ_passes : '') }}" 
                                min="0" max="100" step="0.01" 
                                class="w-20 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][succ_ground_duels]" 
                                value="{{ old("stats.{$player->id}.succ_ground_duels", $stat ? $stat->succ_ground_duels : '') }}" 
                                min="0" max="100" step="0.01" 
                                class="w-20 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][succ_aerial_duels]" 
                                value="{{ old("stats.{$player->id}.succ_aerial_duels", $stat ? $stat->succ_aerial_duels : '') }}" 
                                min="0" max="100" step="0.01" 
                                class="w-20 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][succ_dribbles]" 
                                value="{{ old("stats.{$player->id}.succ_dribbles", $stat ? $stat->succ_dribbles : '') }}" 
                                min="0" max="100" step="0.01" 
                                class="w-20 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][saves]" 
                                value="{{ old("stats.{$player->id}.saves", $stat ? $stat->saves : '') }}" 
                                min="0" 
                                class="w-16 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][tackles]" 
                                value="{{ old("stats.{$player->id}.tackles", $stat ? $stat->tackles : '') }}" 
                                min="0" 
                                class="w-16 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][interceptions]" 
                                value="{{ old("stats.{$player->id}.interceptions", $stat ? $stat->interceptions : '') }}" 
                                min="0" 
                                class="w-16 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][clearances]" 
                                value="{{ old("stats.{$player->id}.clearances", $stat ? $stat->clearances : '') }}" 
                                min="0" 
                                class="w-16 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="stats[{{ $player->id }}][fouls]" 
                                value="{{ old("stats.{$player->id}.fouls", $stat ? $stat->fouls : '') }}" 
                                min="0" 
                                class="w-16 border border-gray-300 rounded px-2 py-1 text-sm">
                        </td>
                    </tr>
                    <input type="hidden" name="stats[{{ $player->id }}][player_id]" value="{{ $player->id }}">
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex justify-end gap-4">
        <a href="{{ route('clubadmin.dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
            Cancel
        </a>
        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
            <i class="fas fa-save mr-2"></i>Save Statistics
        </button>
    </div>
</form>

@push('styles')
<style>
    @media (max-width: 768px) {
        .overflow-x-auto {
            overflow-x: scroll;
        }
    }
</style>
@endpush
@endsection

