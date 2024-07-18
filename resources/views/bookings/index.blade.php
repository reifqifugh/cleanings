<!-- resources/views/admin/bookings/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Pending Bookings') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Category</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Booking Date</th>
                                <th>Size</th>
                                <th>Room Size</th>
                                <th>Payment Method</th>
                                <th>Payment Proof</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->category->name }}</td>
                                    <td>{{ $booking->address }}</td>
                                    <td>{{ $booking->phone }}</td>
                                    <td>{{ $booking->booking_date }}</td>
                                    <td>{{ $booking->size ? $booking->size . ' m²' : '-' }}</td>
                                    <td>{{ $booking->roomSize ? $booking->roomSize->size_range : '-' }}</td>
                                    <td>{{ $booking->paymentMethod->name }}</td>
                                    <td>
                                        @if ($booking->payment_proof)
                                            <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank">View Proof</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ ucfirst($booking->status) }}</td>
                                    <td>
                                        <form action="{{ route('bookings.verify', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">Verify</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
