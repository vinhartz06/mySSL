@extends('layouts.clubadmin')

@section('title', 'Add Player')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Add New Player</h1>
    <p class="text-gray-600">Create a new player profile for {{ $club->name }}</p>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('clubadmin.players.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Player Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                <select name="position" id="position" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                    <option value="">Select Position</option>
                    <option value="GK" {{ old('position') == 'GK' ? 'selected' : '' }}>GK - Goalkeeper</option>
                    <option value="DF" {{ old('position') == 'DF' ? 'selected' : '' }}>DF - Defender</option>
                    <option value="MF" {{ old('position') == 'MF' ? 'selected' : '' }}>MF - Midfielder</option>
                    <option value="FW" {{ old('position') == 'FW' ? 'selected' : '' }}>FW - Forward</option>
                </select>
                @error('position')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="jersey_no" class="block text-sm font-medium text-gray-700">Jersey Number</label>
            <input type="number" name="jersey_no" id="jersey_no" value="{{ old('jersey_no') }}" min="1" max="99" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
            @error('jersey_no')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3 pt-6 border-t">
            <a href="{{ route('clubadmin.players.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Cancel</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Create Player</button>
        </div>
    </form>
</div>

<script>
    // simple validation to ensure jersey number is between 1-99
    document.getElementById('jersey_no').addEventListener('change', function() {
        const value = parseInt(this.value);

        if (value < 1 || value > 99) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Number',
                text: 'Jersey number must be between 1 and 99',
            });

            this.value = '';
        }
    });
</script>
@endsection

