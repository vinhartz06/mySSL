@extends('layouts.app')

@section('title', $club->name . ' - Club Details')

@push('styles')
<style>
    .club-hero {
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        color: white;
        height: 100dvh;
        display: flex;
        align-items: center;
        padding-top: 0;
        margin-top: 0;
    }

    .detail-card {
        background: white;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 20px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    }

    .club-logo-large {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: white;
        margin: 0 auto 20px;
    }

    .back-btn {
        background: #6B7280;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .back-btn:hover {
        background: #4B5563;
        transform: translateY(-2px);
        color: white;
    }

    .hero-content {
        padding-top: 60px;
        padding-bottom: 80px;
    }

    .player-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .player-table thead {
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
    }

    .player-table th {
        color: white;
        padding: 16px 12px;
        text-align: left;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border: none;
    }

    .player-table th:first-child {
        border-top-left-radius: 10px;
    }

    .player-table th:last-child {
        border-top-right-radius: 10px;
    }

    .player-table td {
        padding: 14px 12px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
        color: #374151;
    }

    .player-table tbody tr {
        transition: all 0.2s ease;
        background: white;
    }

    .player-table tbody tr:hover {
        background-color: #f8fafc;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .player-table tbody tr:last-child td {
        border-bottom: none;
    }

    .player-table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 10px;
    }

    .player-table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 10px;
    }

    .position-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .position-gk {
        background-color: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .position-df {
        background-color: #dbeafe;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }

    .position-mf {
        background-color: #d1fae5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }

    .position-fw {
        background-color: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        padding: 2rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        text-align: center;
        border: 1px solid #e2e8f0;
        transition: transform 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: #4A148C;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #64748b;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-weight: 600;
    }

    .jersey-number {
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
        margin-right: 8px;
    }

    .player-name-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .stats-cell {
        text-align: center;
        font-weight: 600;
    }

    .goals-cell {
        color: #dc2626;
        font-weight: 700;
    }

    .assists-cell {
        color: #2563eb;
        font-weight: 700;
    }

    .cards-cell {
        font-weight: 600;
    }

    .yellow-card {
        color: #d97706;
    }

    .red-card {
        color: #dc2626;
    }

    .section-title {
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .percentage-cell {
        color: #059669;
        font-weight: 700;
    }

    .table-container {
        overflow-x: auto;
        border-radius: 10px;
        margin-bottom: 2rem;
    }
</style>
@endpush

@section('content')
    <!-- Club Hero Section -->
    <section class="club-hero">
        <div class="max-w-6xl mx-auto w-full px-4 text-center">
            <div class="hero-content">
                <div class="club-logo-large">
                    <i class="fas fa-futbol"></i>
                </div>
                <h1 class="text-5xl font-bold mb-4">{{ $club->name }}</h1>
                <p class="text-xl opacity-90 mb-6">Soegija Super League Club</p>
                <p class="text-lg opacity-80 mb-8">Coach: {{ $club->coach }}</p>
                <a href="#club-details" class="bg-white text-purple-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                    View Club Details
                </a>
            </div>
        </div>
    </section>

    <!-- Club Details -->
    <section id="club-details" class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Club Information -->
            <div class="detail-card mb-8">
                <h2 class="text-3xl font-bold mb-8 text-center section-title">Club Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl border border-purple-100">
                        <h3 class="font-semibold text-purple-800 mb-3 text-lg">Club Name</h3>
                        <p class="text-xl font-bold text-gray-800">{{ $club->name }}</p>
                    </div>
                    <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl border border-purple-100">
                        <h3 class="font-semibold text-purple-800 mb-3 text-lg">Head Coach</h3>
                        <p class="text-xl font-bold text-gray-800">{{ $club->coach }}</p>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="mt-8">
                    <h3 class="text-2xl font-semibold mb-6 text-gray-800">About the Club</h3>
                    <p class="text-gray-600 mb-4 text-lg leading-relaxed">
                        {{ $club->name }} is one of the clubs in the Soegija Super League, known for their hard work and strong spirit in every game.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Led by Coach {{ $club->coach }}, the team keeps working hard and aims to achieve great results this season.
                    </p>
                </div>
            </div>

            <!-- Team Statistics -->
            <div class="detail-card mb-8">
                <h2 class="text-3xl font-bold mb-8 text-center section-title">Team Statistics</h2>
                
                {{-- @php
                    $totalPlayers = $club->players->count();
                    $totalGoals = $club->players->sum('total_goals');
                    $totalAssists = $club->players->sum('total_assists');
                    $totalMatches = $club->players->sum('matches_played');
                @endphp --}}

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ $club->players->count() }}</div>
                    <div class="stat-label">Total Players</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $totalGoals }}</div>
                    <div class="stat-label">Total Goals</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $totalAssists }}</div>
                    <div class="stat-label">Total Assists</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $totalMatches }}</div>
                    <div class="stat-label">Matches Played</div>
                </div>
            </div>

            <!-- Players List -->
            <div class="detail-card">
                <h2 class="text-3xl font-bold mb-8 text-center section-title">Squad Players</h2>
                
                <div class="table-container">
                    <table class="player-table">
                        <thead>
                            <tr>
                                <th>Jersey</th>
                                <th>Player Name</th>
                                <th>Position</th>
                                <th>Matches</th>
                                <th>Goals</th>
                                <th>Assists</th>
                                <th>Yellow</th>
                                <th>Red</th>
                                <th>Pass Success</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($club->players as $player)
                            <tr>
                                <td class="stats-cell">
                                    <div class="jersey-number">
                                        {{ $player->jersey_no }}
                                    </div>
                                </td>
                                <td>
                                    <div class="player-name-cell">
                                        <span class="font-semibold text-gray-800">{{ $player->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $positionClass = match($player->position) {
                                            'GK' => 'position-gk',
                                            'DF' => 'position-df',
                                            'MF' => 'position-mf',
                                            'FW' => 'position-fw',
                                            default => 'position-df'
                                        };
                                    @endphp
                                    <span class="position-badge {{ $positionClass }}">
                                        {{ $player->position }}
                                    </span>
                                </td>
                                <td class="stats-cell">{{ $player->matches_played }}</td>
                                <td class="stats-cell goals-cell">{{ $player->total_goals }}</td>
                                <td class="stats-cell assists-cell">{{ $player->total_assists }}</td>
                                <td class="stats-cell cards-cell yellow-card">{{ $player->total_yellow_cards }}</td>
                                <td class="stats-cell cards-cell red-card">{{ $player->total_red_cards }}</td>
                                <td class="stats-cell percentage-cell">{{ $player->avg_succ_passes }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center mt-8">
                <a href="{{ route('clubs.index') }}" class="back-btn inline-flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Back to All Clubs
                </a>
            </div>
        </div>
    </section>
@endsection