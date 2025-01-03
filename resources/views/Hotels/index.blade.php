@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-gray-800 text-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold mb-6">Hotel List</h1>
        @if (session('success'))
            <script>
                alert('{{ session('success') }}');
            </script>
        @elseif (session('error'))
            <script>
                alert('{{ session('error') }}');
            </script>
        @endif
        
        <div class="mb-4">
    <a href="{{ route('hotels.create') }}" class="px-6 py-3 bg-green-600 text-white rounded-md hover:bg-green-700">
        Create Hotel
    </a>
</div>

        <table class="table-auto w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b text-lg">Name</th>
                    <th class="px-4 py-2 border-b text-lg">Description</th>
                    <th class="px-4 py-2 border-b text-lg">Status</th>
                    <th class="px-4 py-2 border-b text-lg">Image</th>
                    <th class="px-4 py-2 border-b text-lg">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hotels as $hotel)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $hotel->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $hotel->description }}</td>
                        <td class="px-4 py-2 border-b">{{ $hotel->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td class="px-4 py-2 border-b">
    <img src="{{ asset('storage/' . $hotel->image) }}" alt="{{ $hotel->name }}" class="w-16 h-16 object-cover rounded-md">
</td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('hotels.edit', $hotel->id) }}" class="text-blue-500 hover:text-blue-700 mr-4">Edit</a>
                            <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
