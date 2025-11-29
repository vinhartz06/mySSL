@extends('layouts.app')

@section('title', 'Standings')

@push('styles')
<style>
    .standings-container {
        padding-top: 80px;
        padding-bottom: 60px;
    }
    
    .table-header {
        background: linear-gradient(135deg, #4A148C 0%, #6A1B9A 100%);
    }
    
    .position-1 {
        background-color: #FFD700 !important;
        color: #000;
        font-weight: bold;
    }
    
    .position-2 {
        background-color: #C0C0C0 !important;
        color: #000;
        font-weight: bold;
    }
    
    .position-3 {
        background-color: #CD7F32 !important;
        color: #000;
        font-weight: bold;
    }
    
    .club-logo {
        width: 30px;
        height: 30px;
        background: #f0f0f0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        margin-right: 10px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        color: #4A148C;
        margin-bottom: 5px;
    }
    
    .no-data {
        text-align: center;
        padding: 40px;
        color: #6B7280;
    }
</style>
@endpush

@section('content')
<div class="standings-container">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold mb-2">Soegija Super League Standings</h1>
            <p class="text-gray-600">2025/2026 Season</p>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $totalClubs ?? 0 }}</div>
                <div class="text-gray-500">Total Clubs</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $totalMatches ?? 0 }}</div>
                <div class="text-gray-500">Matches Played</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $totalGoals ?? 0 }}</div>
                <div class="text-gray-500">Total Goals</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $totalMatches > 0 ? number_format($totalGoals / $totalMatches, 2) : '0.00' }}</div>
                <div class="text-gray-500">Avg Goals/Match</div>
            </div>
        </div>

        <!-- Standings Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($standings->count() > 0)
            <table class="w-full">
                <thead class="table-header text-white">
                    <tr>
                        <th class="py-4 px-4 text-center w-16">#</th>
                        <th class="py-4 px-4 text-left">Club</th>
                        <th class="py-4 px-4 text-center w-16">MP</th>
                        <th class="py-4 px-4 text-center w-16">W</th>
                        <th class="py-4 px-4 text-center w-16">D</th>
                        <th class="py-4 px-4 text-center w-16">L</th>
                        <th class="py-4 px-4 text-center w-16">GF</th>
                        <th class="py-4 px-4 text-center w-16">GA</th>
                        <th class="py-4 px-4 text-center w-16">GD</th>
                        <th class="py-4 px-4 text-center w-16">PTS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($standings as $index => $standing)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition 
                        {{ $index + 1 == 1 ? 'position-1' : '' }}
                        {{ $index + 1 == 2 ? 'position-2' : '' }}
                        {{ $index + 1 == 3 ? 'position-3' : '' }}">
                        <td class="py-4 px-4 text-center font-semibold">
                            {{ $index + 1 }}
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex items-center">
                                <div class="club-logo">
                                    ⚽
                                </div>
                                <span class="font-semibold">{{ $standing->club->name ?? 'Unknown Club' }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-center">{{ $standing->played ?? 0 }}</td>
                        <td class="py-4 px-4 text-center text-green-600 font-semibold">{{ $standing->won ?? 0 }}</td>
                        <td class="py-4 px-4 text-center text-gray-600 font-semibold">{{ $standing->draw ?? 0 }}</td>
                        <td class="py-4 px-4 text-center text-red-600 font-semibold">{{ $standing->lost ?? 0 }}</td>
                        <td class="py-4 px-4 text-center font-semibold">{{ $standing->goals_for ?? 0 }}</td>
                        <td class="py-4 px-4 text-center">{{ $standing->goals_against ?? 0 }}</td>
                        <td class="py-4 px-4 text-center font-semibold 
                            {{ ($standing->goal_diff ?? 0) > 0 ? 'text-green-600' : (($standing->goal_diff ?? 0) < 0 ? 'text-red-600' : 'text-gray-600') }}">
                            {{ ($standing->goal_diff ?? 0) > 0 ? '+' : '' }}{{ $standing->goal_diff ?? 0 }}
                        </td>
                        <td class="py-4 px-4 text-center font-bold text-purple-800">{{ $standing->points ?? 0 }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="no-data">
                <i class="fas fa-table text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">No Standings Data Available</h3>
                <p class="text-gray-600">Standings will appear here once matches are played.</p>
            </div>
            @endif
        </div>

        <!-- Legend -->
        <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
            <div class="flex flex-wrap gap-6 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-yellow-400 rounded"></div>
                    <span>Champion</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-gray-400 rounded"></div>
                    <span>Runner-up</span>
                </div>
            </div>
        </div>

        <!-- Key Statistics -->
        <div class="mt-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold mb-4">League Statistics</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-800 mb-2">Most Wins</div>
                        <div class="text-lg font-semibold">{{ $mostWinsClub ?? 'N/A' }}</div>
                        <div class="text-gray-600">{{ $mostWins ?? 0 }} wins</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-800 mb-2">Most Goals</div>
                        <div class="text-lg font-semibold">{{ $mostGoalsClub ?? 'N/A' }}</div>
                        <div class="text-gray-600">{{ $mostGoals ?? 0 }} goals</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-800 mb-2">Best Defense</div>
                        <div class="text-lg font-semibold">{{ $bestDefenseClub ?? 'N/A' }}</div>
                        <div class="text-gray-600">{{ $bestDefense ?? 0 }} goals conceded</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection