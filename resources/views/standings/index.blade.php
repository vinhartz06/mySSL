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
    
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
    }
    
    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    @media (max-width: 768px) {
        .stat-card {
            padding: 15px;
        }
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        color: #4A148C;
        margin-bottom: 5px;
    }
    
    @media (max-width: 768px) {
        .stat-number {
            font-size: 1.5rem;
        }
    }
    
    .no-data {
        text-align: center;
        padding: 40px;
        color: #6B7280;
    }
    
    /* Responsive table */
    @media (max-width: 1024px) {
        .standings-container {
            padding-top: 70px;
        }
        
        table {
            font-size: 0.875rem;
        }
        
        th, td {
            padding: 0.5rem !important;
        }
        
        .club-logo {
            width: 24px;
            height: 24px;
            font-size: 12px;
            margin-right: 6px;
        }
    }
    
    @media (max-width: 768px) {
        .standings-container {
            padding-top: 60px;
            padding-bottom: 40px;
        }
        
        table {
            font-size: 0.75rem;
        }
        
        th, td {
            padding: 0.375rem !important;
        }
        
        th.py-4, td.py-4 {
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
        }
        
        .club-logo {
            width: 20px;
            height: 20px;
            font-size: 10px;
            margin-right: 4px;
        }
        
        /* Hide less important columns on mobile */
        .hide-mobile {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<div class="standings-container">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <!-- Header -->
        <div class="text-center mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-2">Soegija Super League Standings</h1>
            <p class="text-sm sm:text-base text-gray-600">2025/2026 Season</p>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $totalClubs ?? 0 }}</div>
                <div class="text-xs sm:text-sm text-gray-500">Total Clubs</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $totalMatches ?? 0 }}</div>
                <div class="text-xs sm:text-sm text-gray-500">Matches Played</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $totalGoals ?? 0 }}</div>
                <div class="text-xs sm:text-sm text-gray-500">Total Goals</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $totalMatches > 0 ? number_format($totalGoals / $totalMatches, 2) : '0.00' }}</div>
                <div class="text-xs sm:text-sm text-gray-500">Avg Goals/Match</div>
            </div>
        </div>

        <!-- Standings Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($standings->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px]">
                    <thead class="table-header text-white">
                        <tr>
                            <th class="py-4 px-4 text-center w-16">#</th>
                            <th class="py-4 px-4 text-left">Club</th>
                            <th class="py-4 px-4 text-center w-16">MP</th>
                            <th class="py-4 px-4 text-center w-16">W</th>
                            <th class="py-4 px-4 text-center w-16 hide-mobile">D</th>
                            <th class="py-4 px-4 text-center w-16 hide-mobile">L</th>
                            <th class="py-4 px-4 text-center w-16">GF</th>
                            <th class="py-4 px-4 text-center w-16">GA</th>
                            <th class="py-4 px-4 text-center w-16 hide-mobile">GD</th>
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
                                    <span class="font-semibold text-xs sm:text-sm md:text-base">{{ $standing->club->name ?? 'Unknown Club' }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-center">{{ $standing->played ?? 0 }}</td>
                            <td class="py-4 px-4 text-center text-green-600 font-semibold">{{ $standing->won ?? 0 }}</td>
                            <td class="py-4 px-4 text-center text-gray-600 font-semibold hide-mobile">{{ $standing->draw ?? 0 }}</td>
                            <td class="py-4 px-4 text-center text-red-600 font-semibold hide-mobile">{{ $standing->lost ?? 0 }}</td>
                            <td class="py-4 px-4 text-center font-semibold">{{ $standing->goals_for ?? 0 }}</td>
                            <td class="py-4 px-4 text-center">{{ $standing->goals_against ?? 0 }}</td>
                            <td class="py-4 px-4 text-center font-semibold hide-mobile
                                {{ ($standing->goal_diff ?? 0) > 0 ? 'text-green-600' : (($standing->goal_diff ?? 0) < 0 ? 'text-red-600' : 'text-gray-600') }}">
                                {{ ($standing->goal_diff ?? 0) > 0 ? '+' : '' }}{{ $standing->goal_diff ?? 0 }}
                            </td>
                            <td class="py-4 px-4 text-center font-bold text-purple-800">{{ $standing->points ?? 0 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="no-data">
                <i class="fas fa-table text-3xl sm:text-4xl mb-4"></i>
                <h3 class="text-lg sm:text-xl font-semibold mb-2">No Standings Data Available</h3>
                <p class="text-sm sm:text-base text-gray-600">Standings will appear here once matches are played.</p>
            </div>
            @endif
        </div>

        <!-- Legend -->
        <div class="mt-4 sm:mt-6 bg-gray-50 border border-gray-200 rounded-lg p-3 sm:p-4">
            <div class="flex flex-wrap gap-3 sm:gap-6 text-xs sm:text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 sm:w-4 sm:h-4 bg-yellow-400 rounded"></div>
                    <span>Champion</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 sm:w-4 sm:h-4 bg-gray-400 rounded"></div>
                    <span>Runner-up</span>
                </div>
            </div>
        </div>

        <!-- Key Statistics -->
        <div class="mt-6 sm:mt-8">
            <div class="bg-white p-4 sm:p-6 rounded-lg shadow">
                <h3 class="text-lg sm:text-xl font-bold mb-4">League Statistics</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                    <div class="text-center">
                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-purple-800 mb-2">Most Wins</div>
                        <div class="text-base sm:text-lg font-semibold">{{ $mostWinsClub ?? 'N/A' }}</div>
                        <div class="text-sm sm:text-base text-gray-600">{{ $mostWins ?? 0 }} wins</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-purple-800 mb-2">Most Goals</div>
                        <div class="text-base sm:text-lg font-semibold">{{ $mostGoalsClub ?? 'N/A' }}</div>
                        <div class="text-sm sm:text-base text-gray-600">{{ $mostGoals ?? 0 }} goals</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-purple-800 mb-2">Best Defense</div>
                        <div class="text-base sm:text-lg font-semibold">{{ $bestDefenseClub ?? 'N/A' }}</div>
                        <div class="text-sm sm:text-base text-gray-600">{{ $bestDefense ?? 0 }} goals conceded</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection