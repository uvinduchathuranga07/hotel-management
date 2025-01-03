@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-gray-800 text-white rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold mb-6">Rooms</h2>
        <a href="{{ route('rooms.create') }}" class="btn bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md mb-4 inline-block border border-white">
    Book A Room
</a>
        <!-- Success and Error Alerts -->
        @if (session('success'))
            <div class="alert alert-success bg-green-600 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger bg-red-600 text-white p-4 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto bg-gray-700 rounded-lg shadow-lg">
            <table class="min-w-full table-auto text-gray-200">
                <thead class="bg-gray-600">
                    <tr>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Description</th>
                        <th class="px-4 py-2 text-left">Price</th>
                        <th class="px-4 py-2 text-left">Hotel</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                        <tr class="bg-gray-800 hover:bg-gray-700">
                            <td class="px-4 py-2">{{ $room->name }}</td>
                            <td class="px-4 py-2">{{ $room->description }}</td>
                            <td class="px-4 py-2">{{ $room->price }}</td>
                            <td class="px-4 py-2">{{ $room->hotel->name }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('rooms.edit', $room->id) }}" class="btn bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-1 px-3 rounded-md inline-block">Edit</a>

                                <!-- Delete Form -->
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded-md inline-block">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
