@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        color: white;
        padding-top: 0;
        padding-bottom: 0;
        height: 100dvh;
        display: flex;
        align-items: center;
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
    <div class="container">
        <div class="row align-items-center" style="padding-top: 80px; padding-bottom: 80px;"> 
            <div class="col-lg-6">
                <h1 class="display-3 fw-bold mb-4">Soegija Super League</h1>
                <p class="lead mb-4">The most comprehensive platform for following the Soegija Super League. Get match schedules, updated standings, and detailed statistics of your favorite players.</p>
                <div class="d-flex gap-3">
                    <a href="#features" class="btn btn-light btn-lg">Key Features</a>
                    <a href="#matches" class="btn btn-outline-light btn-lg">Schedule</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-futbol" style="font-size: 200px; color: #a989cc; opacity: 0.5;"></i>
            </div>
        </div>
    </div>
</section>

<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 stat-item">
                <div class="stat-number">10</div>
                <p class="text-muted">Faculties</p>
            </div>
            <div class="col-md-3 stat-item">
                <div class="stat-number">200+</div>
                <p class="text-muted">Active Platers</p>
            </div>
            <div class="col-md-3 stat-item">
                <div class="stat-number">18</div>
                <p class="text-muted">Matches</p>
            </div>
            <div class="col-md-3 stat-item">
                <div class="stat-number">1000+</div>
                <p class="text-muted">Users</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Key Features</h2>
            <p class="text-muted">Everything you need in ONE platform</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card feature-card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-alt fa-4x text-primary mb-3"></i>
                        <h5 class="card-title">Match Schedule</h5>
                        <p class="card-text">View the complete schedule of all league matches, including detailed time and venue information.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card feature-card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-trophy fa-4x text-warning mb-3"></i>
                        <h5 class="card-title">Standings</h5>
                        <p class="card-text">Track your favorite team’s position in the standings, updated in real time.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card feature-card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-4x text-success mb-3"></i>
                        <h5 class="card-title">Club Profile</h5>
                        <p class="card-text">Comprehensive information on clubs, player squads, and achievements.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card feature-card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-line fa-4x text-info mb-3"></i>
                        <h5 class="card-title">Statistics</h5>
                        <p class="card-text">Complete player performance statistics throughout the season.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Upcoming Matches Section -->
<section id="matches" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Upcoming Matches</h2>
            <p class="text-muted">Jangan lewatkan pertandingan seru minggu ini</p>
        </div>
        
        <div class="row">
            <div class="col-lg-6">
                <div class="match-card">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-primary">Soegija Super League</span>
                        <span class="text-muted">Saturday, Janaury 3 2026</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center" style="flex: 1;">
                            <div class="team-logo mb-2">⚽</div>
                            <strong>FIKOM</strong>
                        </div>
                        <div class="text-center px-3">
                            <div class="fs-4 fw-bold">VS</div>
                            <small class="text-muted">17:00 WIB</small>
                        </div>
                        <div class="text-center" style="flex: 1;">
                            <div class="team-logo mb-2">⚽</div>
                            <strong>FPsi</strong>
                        </div>
                    </div>
                    <div class="mt-3 text-center">
                        <small class="text-muted"><i class="fas fa-map-marker-alt"></i> Stadion Utama GBK</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="match-card">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-primary">Soegija Super League</span>
                        <span class="text-muted">Sunday, January 4 2026</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center" style="flex: 1;">
                            <div class="team-logo mb-2">⚽</div>
                            <strong>FHK</strong>
                        </div>
                        <div class="text-center px-3">
                            <div class="fs-4 fw-bold">VS</div>
                            <small class="text-muted">15:30 WIB</small>
                        </div>
                        <div class="text-center" style="flex: 1;">
                            <div class="team-logo mb-2">⚽</div>
                            <strong>FITL</strong>
                        </div>
                    </div>
                    <div class="mt-3 text-center">
                        <small class="text-muted"><i class="fas fa-map-marker-alt"></i> Stadion Kanjuruhan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Top Scorers Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Top Goalscorers</h2>
            <p class="text-muted">Players with the most goals this season.</p>
        </div>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                            <div class="me-3">
                                <span class="badge bg-warning text-dark fs-5">1</span>
                            </div>
                            <div class="flex-grow-1">
                                <strong>Jonathan Vincent Hartono</strong>
                                <div class="text-muted small">FIKOM</div>
                            </div>
                            <div class="text-end">
                                <div class="fs-4 fw-bold text-primary">7 <i class="fas fa-futbol"></i></div>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                            <div class="me-3">
                                <span class="badge bg-secondary fs-5">2</span>
                            </div>
                            <div class="flex-grow-1">
                                <strong>Marko Simic</strong>
                                <div class="text-muted small">FLA</div>
                            </div>
                            <div class="text-end">
                                <div class="fs-4 fw-bold text-primary">5 <i class="fas fa-futbol"></i></div>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <span class="badge bg-secondary fs-5">3</span>
                            </div>
                            <div class="flex-grow-1">
                                <strong>Ilija Spasojevic</strong>
                                <div class="text-muted small">FPSI</div>
                            </div>
                            <div class="text-end">
                                <div class="fs-4 fw-bold text-primary">5 <i class="fas fa-futbol"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
{{-- <section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="display-5 fw-bold mb-4">Siap Bergabung?</h2>
        <p class="lead mb-4">Daftar sekarang dan dapatkan akses penuh ke semua fitur LigaKu</p>
        @guest
        <a href="{{ route('register') }}" class="btn btn-light btn-lg">Daftar Sekarang</a>
        @else
        <a href="{{ route('matches.index') }}" class="btn btn-light btn-lg">Mulai Jelajahi</a>
        @endguest
    </div>
</section> --}}
@endsection