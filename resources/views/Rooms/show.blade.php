@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Room Details</h2>
        <p><strong>Name:</strong> {{ $room->name }}</p>
        <p><strong>Description:</strong> {{ $room->description }}</p>
        <p><strong>Price:</strong> ${{ $room->price }}</p>
        <p><strong>Hotel:</strong> {{ $room->hotel->name }}</p>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Back to Rooms</a>
    </div>
@endsection
