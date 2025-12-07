@extends('layouts.admin')

@section('title', 'Edit Match')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Match</h1>
    <p class="text-gray-600">Update match details and statistics</p>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.matches.update', $match) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="home_club_id" class="block text-sm font-medium text-gray-700">Home Club</label>
                <select name="home_club_id" id="home_club_id" required class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                    <option value="">Select Home Club</option>
                    @foreach($clubs as $club)
                        <option value="{{ $club->id }}" {{ $match->home_club_id == $club->id ? 'selected' : '' }}>{{ $club->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="away_club_id" class="block text-sm font-medium text-gray-700">Away Club</label>
                <select name="away_club_id" id="away_club_id" required class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                    <option value="">Select Away Club</option>
                    @foreach($clubs as $club)
                        <option value="{{ $club->id }}" {{ $match->away_club_id == $club->id ? 'selected' : '' }}>{{ $club->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="matchday" class="block text-sm font-medium text-gray-700">Matchday</label>
                <select name="matchday" id="matchday" required class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                    <option value="">Select Matchday</option>
                    @foreach($matchdays as $day)
                        <option value="{{ $day }}" {{ $match->matchday == $day ? 'selected' : '' }}>Matchday {{ $day }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="match_date" class="block text-sm font-medium text-gray-700">Match Date & Time</label>
                <input type="datetime-local" name="match_date" id="match_date" value="{{ $match->match_date->format('Y-m-d\TH:i') }}" required class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
            </div>
        </div>

        <div class="mb-6">
            <label for="venue" class="block text-sm font-medium text-gray-700">Venue</label>
            <input type="text" name="venue" id="venue" value="{{ $match->venue }}" required class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
        </div>

        <div class="mb-6">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" required class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ $match->status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>

        <!-- Match Statistics -->
        <div class="border-t pt-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Match Statistics</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-4">
                    <h4 class="font-medium text-gray-700">Home Team</h4>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="home_score" class="block text-sm font-medium text-gray-700">Score</label>
                            <input type="number" name="home_score" id="home_score" value="{{ $match->home_score ?? 0 }}" min="0" class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                        
                        <div>
                            <label for="home_shots" class="block text-sm font-medium text-gray-700">Shots</label>
                            <input type="number" name="home_shots" id="home_shots" value="{{ $match->home_shots ?? 0 }}" min="0" class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="home_shots_on_target" class="block text-sm font-medium text-gray-700">Shots on Target</label>
                            <input type="number" name="home_shots_on_target" id="home_shots_on_target" value="{{ $match->home_shots_on_target ?? 0 }}" min="0" class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                        
                        <div>
                            <label for="home_possession" class="block text-sm font-medium text-gray-700">Possession %</label>
                            <input type="number" name="home_possession" id="home_possession" value="{{ $match->home_possession ?? 50 }}" min="0" max="100" step="0.1" class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="home_corners" class="block text-sm font-medium text-gray-700">Corners</label>
                            <input type="number" name="home_corners" id="home_corners" value="{{ $match->home_corners ?? 0 }}" min="0" class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                        
                        <div>
                            <label for="home_offsides" class="block text-sm font-medium text-gray-700">Offsides</label>
                            <input type="number" name="home_offsides" id="home_offsides" value="{{ $match->home_offsides ?? 0 }}" min="0" class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <h4 class="font-medium text-gray-700">Away Team</h4>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="away_score" class="block text-sm font-medium text-gray-700">Score</label>
                            <input type="number" name="away_score" id="away_score" value="{{ $match->away_score ?? 0 }}" min="0" class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                        
                        <div>
                            <label for="away_shots" class="block text-sm font-medium text-gray-700">Shots</label>
                            <input type="number" name="away_shots" id="away_shots" value="{{ $match->away_shots ?? 0 }}" min="0" class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="away_shots_on_target" class="block text-sm font-medium text-gray-700">Shots on Target</label>
                            <input type="number" name="away_shots_on_target" id="away_shots_on_target" value="{{ $match->away_shots_on_target ?? 0 }}" min="0" class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                        
                        <div>
                            <label for="away_possession" class="block text-sm font-medium text-gray-700">Possession %</label>
                            <input type="number" name="away_possession" id="away_possession" value="{{ $match->away_possession ?? 50 }}" min="0" max="100" step="0.1" class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="away_corners" class="block text-sm font-medium text-gray-700">Corners</label>
                            <input type="number" name="away_corners" id="away_corners" value="{{ $match->away_corners ?? 0 }}" min="0" class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                        
                        <div>
                            <label for="away_offsides" class="block text-sm font-medium text-gray-700">Offsides</label>
                            <input type="number" name="away_offsides" id="away_offsides" value="{{ $match->away_offsides ?? 0 }}" min="0" class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3 pt-6 border-t">
            <a href="{{ route('admin.matches.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Cancel</a>
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Update Match</button>
        </div>
    </form>
</div>
@endsection