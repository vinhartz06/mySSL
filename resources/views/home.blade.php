@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        color: white;
        min-height: 100dvh;
        display: flex;
        align-items: center;
        padding-top: 0;
        padding-bottom: 0;
        margin-top: 0;
    }

    .content-offset {
        padding-top: 70px;
    }

    .feature-card {
        transition: transform 0.3s;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        cursor: pointer;
    }

    .stats-section {
        background-color: #f8f9fa;
        padding: 60px 0;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        color: #4A148C;
    }

    @media (min-width: 640px) {
        .stat-number {
            font-size: 3rem;
        }
    }

    .match-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .team-logo {
        width: 50px;
        height: 50px;
        background: #f0f0f0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .dashboard-card {
        background: linear-gradient(135deg, #4A148C 0%, #6B21A8 100%);
        color: white;
        border-radius: 15px;
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(74, 20, 140, 0.3);
    }

    .admin-dashboard-card {
        background: linear-gradient(135deg, #DC2626 0%, #EF4444 100%);
    }

    .club-dashboard-card {
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
    }

    @media (max-width: 640px) {
        .hero-section h1 {
            font-size: 2rem;
        }
        
        .hero-section p {
            font-size: 0.95rem;
        }

        .hero-section i {
            font-size: 120px !important;
        }

        .match-card {
            padding: 15px;
        }

        .team-logo {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }

        .match-card strong {
            font-size: 0.9rem;
        }

        .match-card small {
            font-size: 0.75rem;
        }
    }
</style>
@endpush

@section('content')

<section class="hero-section">
    <div class="max-w-6xl mx-auto w-full px-4">
        <div class="flex flex-col lg:flex-row items-center" style="padding-top: 80px; padding-bottom: 80px;">
            <div class="lg:w-1/2 mb-8 lg:mb-0">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4">My Soegija Super League</h1>
                <p class="text-base sm:text-lg mb-4">The most comprehensive platform for following the Soegija Super League. Get match schedules, updated standings, and detailed statistics of your favorite players.</p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="#features" class="bg-white text-purple-800 px-6 py-3 rounded hover:bg-gray-200 transition text-center">Key Features</a>
                    <a href="#matches" class="border border-white text-white px-6 py-3 rounded hover:bg-white hover:text-purple-800 transition text-center">Recent Matches</a>
                </div>
            </div>
            <div class="lg:w-1/2 text-center">
                <i class="fas fa-futbol" style="font-size: 200px; color: #a989cc; opacity: 0.5;"></i>
            </div>
        </div>
    </div>
</section>

<section class="stats-section py-10">
    <div class="max-w-6xl mx-auto w-full px-4 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
        <div class="stat-item bg-white shadow rounded-lg p-6">
            <div class="stat-number text-4xl font-bold">10</div>
            <p class="text-gray-500 text-sm sm:text-base mt-1">Clubs</p>
        </div>
        <div class="stat-item bg-white shadow rounded-lg p-6">
            <div class="stat-number text-4xl font-bold">200</div>
            <p class="text-gray-500 text-sm sm:text-base mt-1">Active Players</p>
        </div>
        <div class="stat-item bg-white shadow rounded-lg p-6">
            <div class="stat-number text-4xl font-bold">90</div>
            <p class="text-gray-500 text-sm sm:text-base mt-1">Matches</p>
        </div>
    </div>
</section>

<section id="features" class="py-12">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold mb-2">Key Features</h2>
            <p class="text-gray-500">Everything you need in <strong>ONE</strong> platform</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="feature-card h-full text-center p-6">
                <i class="fas fa-calendar-alt fa-3x sm:fa-4x text-blue-500 mb-3"></i>
                <h5 class="font-semibold mb-2 text-base sm:text-lg">Match Schedule</h5>
                <p class="text-sm sm:text-base">View the complete schedule of all league matches, including detailed time and venue information.</p>
            </div>
            <div class="feature-card h-full text-center p-6">
                <i class="fas fa-trophy fa-3x sm:fa-4x text-yellow-400 mb-3"></i>
                <h5 class="font-semibold mb-2 text-base sm:text-lg">Standings</h5>
                <p class="text-sm sm:text-base">Track your favorite team's position in the standings, updated in real time.</p>
            </div>
            <div class="feature-card h-full text-center p-6">
                <i class="fas fa-users fa-3x sm:fa-4x text-green-500 mb-3"></i>
                <h5 class="font-semibold mb-2 text-base sm:text-lg">Club Profile</h5>
                <p class="text-sm sm:text-base">Comprehensive information on clubs, player squads, and achievements.</p>
            </div>
            <div class="feature-card h-full text-center p-6">
                <i class="fas fa-chart-line fa-3x sm:fa-4x text-teal-500 mb-3"></i>
                <h5 class="font-semibold mb-2 text-base sm:text-lg">Statistics</h5>
                <p class="text-sm sm:text-base">Complete player performance statistics throughout the season.</p>
            </div>
        </div>
    </div>
</section>

{{--! edit this upcoming matches --}}
{{-- <section id="matches" class="py-12 bg-gray-100">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold mb-2">Upcoming Matches</h2>
            <p class="text-gray-500">Don't miss this week's exciting matches!</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="match-card">
                <div class="flex flex-col sm:flex-row justify-between mb-2 gap-2">
                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs sm:text-sm text-center sm:text-left">Soegija Super League</span>
                    <span class="text-gray-500 text-xs sm:text-sm text-center sm:text-right">Saturday, January 3 2026</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-center flex-1">
                        <div class="team-logo mx-auto mb-2">⚽</div>
                        <strong class="text-sm sm:text-base">FIKOM</strong>
                    </div>
                    <div class="text-center px-2 sm:px-3">
                        <div class="text-base sm:text-lg font-bold">VS</div>
                        <small class="text-gray-500 text-xs">17:00 WIB</small>
                    </div>
                    <div class="text-center flex-1">
                        <div class="team-logo mx-auto mb-2">⚽</div>
                        <strong class="text-sm sm:text-base">FPsi</strong>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <small class="text-gray-500 text-xs sm:text-sm"><i class="fas fa-map-marker-alt"></i> Stadion Utama GBK</small>
                </div>
            </div>

            <div class="match-card">
                <div class="flex flex-col sm:flex-row justify-between mb-2 gap-2">
                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs sm:text-sm text-center sm:text-left">Soegija Super League</span>
                    <span class="text-gray-500 text-xs sm:text-sm text-center sm:text-right">Sunday, January 4 2026</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-center flex-1">
                        <div class="team-logo mx-auto mb-2">⚽</div>
                        <strong class="text-sm sm:text-base">FHK</strong>
                    </div>
                    <div class="text-center px-2 sm:px-3">
                        <div class="text-base sm:text-lg font-bold">VS</div>
                        <small class="text-gray-500 text-xs">15:30 WIB</small>
                    </div>
                    <div class="text-center flex-1">
                        <div class="team-logo mx-auto mb-2">⚽</div>
                        <strong class="text-sm sm:text-base">FITL</strong>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <small class="text-gray-500 text-xs sm:text-sm"><i class="fas fa-map-marker-alt"></i> Stadion Kanjuruhan</small>
                </div>
            </div>
        </div>
    </div>
</section> --}}

{{--! edit this top goalscorers --}}
{{-- <section class="py-12">
    <div class="max-w-4xl mx-auto px-4"> 
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold mb-2">Top Goalscorers</h2>
            <p class="text-gray-500">Players with the most goals this season.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded shadow">
                <thead class="bg-purple-800 text-white">
                    <tr>
                        <th class="py-3 px-2 sm:px-4 text-center text-sm sm:text-base">#</th>
                        <th class="py-3 px-2 sm:px-4 text-left text-sm sm:text-base">Player</th>
                        <th class="py-3 px-2 sm:px-4 text-center text-sm sm:text-base">Team</th>
                        <th class="py-3 px-2 sm:px-4 text-center text-sm sm:text-base">Goals</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="py-3 px-2 sm:px-4 text-center">
                            <span class="bg-yellow-400 text-black px-2 py-1 rounded font-semibold text-xs sm:text-sm">1</span>
                        </td>
                        <td class="py-3 px-2 sm:px-4 text-sm sm:text-base">
                            <strong>Jonathan Vincent Hartono</strong>
                        </td>
                        <td class="py-3 px-2 sm:px-4 text-center text-gray-600 text-sm sm:text-base">FIKOM</td>
                        <td class="py-3 px-2 sm:px-4 text-center">
                            <span class="text-lg sm:text-xl font-bold text-blue-500">7 <i class="fas fa-futbol"></i></span>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="py-3 px-2 sm:px-4 text-center">
                            <span class="bg-gray-400 text-black px-2 py-1 rounded font-semibold text-xs sm:text-sm">2</span>
                        </td>
                        <td class="py-3 px-2 sm:px-4 text-sm sm:text-base">
                            <strong>Marko Simic</strong>
                        </td>
                        <td class="py-3 px-2 sm:px-4 text-center text-gray-600 text-sm sm:text-base">FLA</td>
                        <td class="py-3 px-2 sm:px-4 text-center">
                            <span class="text-lg sm:text-xl font-bold text-blue-500">5 <i class="fas fa-futbol"></i></span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-2 sm:px-4 text-center">
                            <span class="bg-gray-400 text-black px-2 py-1 rounded font-semibold text-xs sm:text-sm">3</span>
                        </td>
                        <td class="py-3 px-2 sm:px-4 text-sm sm:text-base">
                            <strong>Ilija Spasojevic</strong>
                        </td>
                        <td class="py-3 px-2 sm:px-4 text-center text-gray-600 text-sm sm:text-base">FPSI</td>
                        <td class="py-3 px-2 sm:px-4 text-center">
                            <span class="text-lg sm:text-xl font-bold text-blue-500">5 <i class="fas fa-futbol"></i></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section> --}}

<!-- dashboard access cards for admin and club manager -->
@auth
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'club')
    <section class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Management Dashboard</h2>
                <p class="text-gray-600 mt-2">Access your management panel</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if(auth()->user()->role === 'admin')
                <!-- Admin Dashboard Card -->
                <a href="{{ route('admin.dashboard') }}" class="dashboard-card admin-dashboard-card p-6 text-center block">
                    <div class="mb-4">
                        <i class="fas fa-crown text-4xl mb-3 text-white opacity-90"></i>
                        <h3 class="text-xl font-bold mb-2">Admin Dashboard</h3>
                        <p class="text-white opacity-90 text-sm mb-4">
                            Manage matches, clubs, players, and league standings
                        </p>
                    </div>
                    <div class="flex items-center justify-center">
                        <span class="bg-white text-red-600 px-4 py-2 rounded-lg font-semibold text-sm hover:bg-gray-100 transition">
                            Go to Admin Panel
                        </span>
                    </div>
                </a>
                @endif

                @if(auth()->user()->role === 'club')
                <!-- Club Dashboard Card -->
                <a href="{{ route('clubadmin.dashboard') }}" class="dashboard-card club-dashboard-card p-6 text-center block">
                    <div class="mb-4">
                        <i class="fas fa-users text-4xl mb-3 text-white opacity-90"></i>
                        <h3 class="text-xl font-bold mb-2">Club Dashboard</h3>
                        <p class="text-white opacity-90 text-sm mb-4">
                            Manage your club's players, lineups, and statistics
                        </p>
                    </div>
                    <div class="flex items-center justify-center">
                        <span class="bg-white text-green-600 px-4 py-2 rounded-lg font-semibold text-sm hover:bg-gray-100 transition">
                            Go to Club Panel
                        </span>
                    </div>
                </a>
                @endif

                <!-- quick stats -->
                <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Stats</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Your Role:</span>
                            <span class="font-semibold capitalize 
                                {{ auth()->user()->role === 'admin' ? 'text-red-600' : 'text-green-600' }}">
                                {{ auth()->user()->role }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Logged in as:</span>
                            <span class="font-semibold text-gray-800">{{ auth()->user()->name }}</span>
                        </div>
                        {{-- <div class="flex justify-between items-center">
                            <span class="text-gray-600">Last login:</span>
                            <span class="text-sm text-gray-500">{{ auth()->user()->updated_at->diffForHumans() }}</span>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endauth

@endsection