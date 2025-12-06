@extends('layouts.admin')

@section('title', 'Add Match')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Add New Match</h1>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.matches.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="home_club_id" class="block text-sm font-medium text-gray-700">Home Club</label>
                <select name="home_club_id" id="home_club_id" required class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                    <option value="">Select Home Club</option>
                    @foreach($clubs as $club)
                        <option value="{{ $club->id }}" {{ old('home_club_id') == $club->id ? 'selected' : '' }}>{{ $club->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="away_club_id" class="block text-sm font-medium text-gray-700">Away Club</label>
                <select name="away_club_id" id="away_club_id" required class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                    <option value="">Select Away Club</option>
                    @foreach($clubs as $club)
                        <option value="{{ $club->id }}" {{ old('away_club_id') == $club->id ? 'selected' : '' }}>{{ $club->name }}</option>
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
                        <option value="{{ $day }}" {{ old('matchday') == $day ? 'selected' : '' }}>Matchday {{ $day }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="match_date" class="block text-sm font-medium text-gray-700">Match Date & Time</label>
                <input type="datetime-local" name="match_date" id="match_date" value="{{ old('match_date') }}" required class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
            </div>
        </div>

        <div class="mb-6">
            <label for="venue" class="block text-sm font-medium text-gray-700">Venue</label>
            <input type="text" name="venue" id="venue" value="{{ old('venue') }}" required class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
        </div>

        <div class="mb-6">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" required class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.matches.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Cancel</a>
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Create Match</button>
        </div>
    </form>
</div>
@endsection