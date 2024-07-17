@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">History Booking</div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        @foreach ($bookings as $booking)
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h2 class="card-title">{{ $booking->booking_code }}</h2>
                                        <h4 class="card-title">{{ $booking->user->name }}</h4>
                                        <p class="card-text">
                                            <strong>Address:</strong> {{ $booking->address }}<br>
                                            <strong>Phone:</strong> {{ $booking->phone }}<br>
                                            <strong>Booking Date:</strong> {{ $booking->booking_date }}<br>
                                            <strong>Size:</strong> {{ $booking->size ? $booking->size . ' m²' : '-' }}<br>
                                            <strong>Room Size:</strong> {{ $booking->roomSize ? $booking->roomSize->size_range : '-' }}<br>
                                            <strong>Payment Method:</strong> {{ $booking->paymentMethod->name }}<br>
                                            <strong>Status:</strong> {{ ucfirst($booking->status) }}
                                        </p>
                                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection