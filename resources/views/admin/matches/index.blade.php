@extends('layouts.admin')

@section('title', 'Manage Matches')

@push('scripts')
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            })
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.show_confirm').forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    let form = this.closest('form');

                    Swal.fire({
                        title: "Are you sure?",
                        text: "This match will be permanently deleted!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it",
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manage Matches</h1>
    <a href="{{ route('admin.matches.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
        <i class="fas fa-plus mr-2"></i>Add Match
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Match</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matchday</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($matches as $match)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ $match->homeClub->name }} vs {{ $match->awayClub->name }}</div>
                    <div class="text-sm text-gray-500">{{ $match->venue }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $match->match_date->format('M d, Y') }}</div>
                    <div class="text-sm text-gray-500">{{ $match->match_date->format('H:i') }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                        {{ $match->status === 'fulltime' ? 'bg-green-100 text-green-800' : 
                           ($match->status === 'scheduled' ? 'bg-blue-100 text-blue-800' : 
                           'bg-yellow-100 text-yellow-800') }}">
                        {{ ucfirst($match->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $match->matchday }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('admin.matches.edit', $match) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                    <form action="{{ route('admin.matches.destroy', $match) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 show_confirm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $matches->links() }}
    </div>
</div>
@endsection