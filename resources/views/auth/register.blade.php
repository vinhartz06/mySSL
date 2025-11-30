@extends('layouts.app')

@section('title', 'Register')

@push('styles')
<style>
    .auth-section {
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        color: white;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 80px 1rem 1rem 1rem;
        margin: 0;
    }

    .auth-container {
        width: 100%;
        max-width: 440px;
        margin: 0 auto;
    }

    .auth-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        transition: all 0.3s ease;
        animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .auth-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 70px rgba(0, 0, 0, 0.4);
    }

    .auth-header {
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        padding: 2.5rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .auth-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .auth-header-content {
        position: relative;
        z-index: 1;
    }

    .auth-icon {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .auth-body {
        padding: 2.5rem 2rem;
        color: #333;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        color: #374151;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 0.5rem;
        letter-spacing: 0.3px;
    }

    .form-input-wrapper {
        position: relative;
    }

    .form-input {
        width: 100%;
        padding: 14px 16px 14px 45px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        background-color: #f9fafb;
        color: #1f2937;
    }

    .form-input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        transition: color 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #4A148C;
        background-color: white;
        box-shadow: 0 0 0 4px rgba(74, 20, 140, 0.08);
    }

    .form-input:focus + .form-input-icon {
        color: #4A148C;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        color: white;
        padding: 14px 24px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(74, 20, 140, 0.4);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .auth-link {
        color: #4A148C;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s ease;
        position: relative;
    }

    .auth-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: #4A148C;
        transition: width 0.3s ease;
    }

    .auth-link:hover::after {
        width: 100%;
    }

    .auth-link:hover {
        color: #764ba2;
    }

    .divider {
        text-align: center;
        margin: 1.5rem 0;
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        background: #e5e7eb;
    }

    .divider-text {
        background: white;
        padding: 0 1rem;
        position: relative;
        color: #6b7280;
        font-size: 13px;
        font-weight: 500;
    }

    .error-message {
        color: #dc2626;
        font-size: 13px;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .password-strength {
        margin-top: 0.5rem;
        font-size: 12px;
        color: #6b7280;
    }

    @media (max-width: 640px) {
        .auth-section {
            padding: 70px 0.75rem 1rem 0.75rem;
            min-height: 100vh;
        }
        
        .auth-body {
            padding: 2rem 1.5rem;
        }

        .auth-header {
            padding: 2rem 1.5rem;
        }

        .auth-icon {
            width: 60px;
            height: 60px;
        }

        .form-input {
            font-size: 16px; /* Prevents zoom on iOS */
        }
    }

    @media (max-width: 380px) {
        .auth-body {
            padding: 1.5rem 1.25rem;
        }

        .btn-primary {
            padding: 12px 20px;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }
    }
</style>
@endpush

@section('content')

<section class="auth-section">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-header-content">
                    <div class="auth-icon">
                        <i class="fas fa-user-plus text-3xl text-white"></i>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white">Join mySSL</h1>
                    <p class="text-purple-200 mt-2 text-sm sm:text-base">Create your account to get started</p>
                </div>
            </div>

            <div class="auth-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="fas fa-user text-sm mr-1"></i> Username
                        </label>
                        <div class="form-input-wrapper">
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="form-input"
                                placeholder="Choose a username"
                                value="{{ old('name') }}"
                                required
                            >
                            <i class="fas fa-user form-input-icon"></i>
                        </div>
                        @error('name')
                            <p class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope text-sm mr-1"></i> Email Address
                        </label>
                        <div class="form-input-wrapper">
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-input"
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                                required
                            >
                            <i class="fas fa-envelope form-input-icon"></i>
                        </div>
                        @error('email')
                            <p class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock text-sm mr-1"></i> Password
                        </label>
                        <div class="form-input-wrapper">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-input"
                                placeholder="Create a password"
                                required
                            >
                            <i class="fas fa-lock form-input-icon"></i>
                        </div>
                        <p class="password-strength">
                            <i class="fas fa-info-circle"></i> Min. 8 characters
                        </p>
                        @error('password')
                            <p class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">
                            <i class="fas fa-lock text-sm mr-1"></i> Confirm Password
                        </label>
                        <div class="form-input-wrapper">
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                class="form-input"
                                placeholder="Confirm your password"
                                required
                            >
                            <i class="fas fa-lock form-input-icon"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary">
                        <i class="fas fa-user-plus mr-2"></i> Create Account
                    </button>

                    <div class="divider">
                        <span class="divider-text">Already a member?</span>
                    </div>

                    <div class="text-center">
                        <p class="text-gray-600 text-sm">
                            Already have an account? 
                            <a href="{{ route('show.login') }}" class="auth-link">Sign in here</a>
                        </p>
                    </div>

                    {{-- @if($errors->any())
                        <ul class="px-4 py-2 bg-red-100">
                            @foreach ($errors->all() as $error)
                                <li class="my-2 text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif --}}
                </form>
            </div>
        </div>
    </div>
</section>

@endsection