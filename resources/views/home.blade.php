@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        color: white;
        height: 100dvh;
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
        font-size: 3rem;
        font-weight: bold;
        color: #4A148C;
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
</style>
@endpush

@section('content')

<section class="hero-section">
    <div class="max-w-6xl mx-auto w-full px-4">
        <div class="flex flex-col lg:flex-row items-center" style="padding-top: 80px; padding-bottom: 80px;">
            <div class="lg:w-1/2 mb-8 lg:mb-0">
                <h1 class="text-5xl font-bold mb-4">Soegija Super League</h1>
                <p class="text-lg mb-4">The most comprehensive platform for following the Soegija Super League. Get match schedules, updated standings, and detailed statistics of your favorite players.</p>
                <div class="flex gap-3">
                    <a href="#features" class="bg-white text-purple-800 px-6 py-3 rounded hover:bg-gray-200 transition">Key Features</a>
                    <a href="#matches" class="border border-white text-white px-6 py-3 rounded hover:bg-white hover:text-purple-800 transition">Schedule</a>
                </div>
            </div>
            <div class="lg:w-1/2 text-center">
                <i class="fas fa-futbol" style="font-size: 200px; color: #a989cc; opacity: 0.5;"></i>
            </div>
        </div>
    </div>
</section>

<section class="stats-section">
    <div class="max-w-6xl mx-auto w-full px-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <div class="stat-item">
            <div class="stat-number">10</div>
            <p class="text-gray-500">Clubs</p>
        </div>
        <div class="stat-item">
            <div class="stat-number">200</div>
            <p class="text-gray-500">Active Players</p>
        </div>
        <div class="stat-item">
            <div class="stat-number">18</div>
            <p class="text-gray-500">Matches</p>
        </div>
        <div class="stat-item">
            <div class="stat-number">200+</div>
            <p class="text-gray-500">Users</p>
        </div>
    </div>
</section>

<section id="features" class="py-12">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-2">Key Features</h2>
            <p class="text-gray-500">Everything you need in ONE platform</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <div class="feature-card h-full text-center p-6">
                <i class="fas fa-calendar-alt fa-4x text-blue-500 mb-3"></i>
                <h5 class="font-semibold mb-2">Match Schedule</h5>
                <p>View the complete schedule of all league matches, including detailed time and venue information.</p>
            </div>
            <div class="feature-card h-full text-center p-6">
                <i class="fas fa-trophy fa-4x text-yellow-400 mb-3"></i>
                <h5 class="font-semibold mb-2">Standings</h5>
                <p>Track your favorite team's position in the standings, updated in real time.</p>
            </div>
            <div class="feature-card h-full text-center p-6">
                <i class="fas fa-users fa-4x text-green-500 mb-3"></i>
                <h5 class="font-semibold mb-2">Club Profile</h5>
                <p>Comprehensive information on clubs, player squads, and achievements.</p>
            </div>
            <div class="feature-card h-full text-center p-6">
                <i class="fas fa-chart-line fa-4x text-teal-500 mb-3"></i>
                <h5 class="font-semibold mb-2">Statistics</h5>
                <p>Complete player performance statistics throughout the season.</p>
            </div>
        </div>
    </div>
</section>

<section id="matches" class="py-12 bg-gray-100">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-2">Upcoming Matches</h2>
            <p class="text-gray-500">Don't miss this week's exciting matches!</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="match-card">
                <div class="flex justify-between mb-2">
                    <span class="bg-blue-500 text-white px-2 py-1 rounded">Soegija Super League</span>
                    <span class="text-gray-500">Saturday, January 3 2026</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-center flex-1">
                        <div class="team-logo mb-2">⚽</div>
                        <strong>FIKOM</strong>
                    </div>
                    <div class="text-center px-3">
                        <div class="text-lg font-bold">VS</div>
                        <small class="text-gray-500">17:00 WIB</small>
                    </div>
                    <div class="text-center flex-1">
                        <div class="team-logo mb-2">⚽</div>
                        <strong>FPsi</strong>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <small class="text-gray-500"><i class="fas fa-map-marker-alt"></i> Stadion Utama GBK</small>
                </div>
            </div>

            <div class="match-card">
                <div class="flex justify-between mb-2">
                    <span class="bg-blue-500 text-white px-2 py-1 rounded">Soegija Super League</span>
                    <span class="text-gray-500">Sunday, January 4 2026</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-center flex-1">
                        <div class="team-logo mb-2">⚽</div>
                        <strong>FHK</strong>
                    </div>
                    <div class="text-center px-3">
                        <div class="text-lg font-bold">VS</div>
                        <small class="text-gray-500">15:30 WIB</small>
                    </div>
                    <div class="text-center flex-1">
                        <div class="team-logo mb-2">⚽</div>
                        <strong>FITL</strong>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <small class="text-gray-500"><i class="fas fa-map-marker-alt"></i> Stadion Kanjuruhan</small>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-12">
    <div class="max-w-4xl mx-auto px-4"> 
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-2">Top Goalscorers</h2>
            <p class="text-gray-500">Players with the most goals this season.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded shadow">
                <thead class="bg-purple-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-center">#</th>
                        <th class="py-3 px-4 text-left">Player</th>
                        <th class="py-3 px-4 text-center">Team</th>
                        <th class="py-3 px-4 text-center">Goals</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-center">
                            <span class="bg-yellow-400 text-black px-2 py-1 rounded font-semibold">1</span>
                        </td>
                        <td class="py-3 px-4">
                            <strong>Jonathan Vincent Hartono</strong>
                        </td>
                        <td class="py-3 px-4 text-center text-gray-600">FIKOM</td>
                        <td class="py-3 px-4 text-center">
                            <span class="text-xl font-bold text-blue-500">7 <i class="fas fa-futbol"></i></span>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-center">
                            <span class="bg-gray-400 text-black px-2 py-1 rounded font-semibold">2</span>
                        </td>
                        <td class="py-3 px-4">
                            <strong>Marko Simic</strong>
                        </td>
                        <td class="py-3 px-4 text-center text-gray-600">FLA</td>
                        <td class="py-3 px-4 text-center">
                            <span class="text-xl font-bold text-blue-500">5 <i class="fas fa-futbol"></i></span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-center">
                            <span class="bg-gray-400 text-black px-2 py-1 rounded font-semibold">3</span>
                        </td>
                        <td class="py-3 px-4">
                            <strong>Ilija Spasojevic</strong>
                        </td>
                        <td class="py-3 px-4 text-center text-gray-600">FPSI</td>
                        <td class="py-3 px-4 text-center">
                            <span class="text-xl font-bold text-blue-500">5 <i class="fas fa-futbol"></i></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection