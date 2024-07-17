@extends('layouts.admin')
@section('title', 'Pending Request')
@section('content')
<div class="container">
    <h1>Pending Request</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Category</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Booking Date</th>
                <th>Payment Method</th>
                <th>Payment Proof</th>
                <th>Actions</th>
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
                    <td>{{ $booking->paymentMethod->name }}</td>
                    <td>
                        @if ($booking->payment_proof)
                        <a href="{{ Storage::url($booking->payment_proof) }}" target="_blank">
                            <img src="{{ Storage::url($booking->payment_proof) }}" alt="Payment Proof" style="width: 100px; height: auto;">
                        </a>
                        @else
                        No Proof
                        @endif
                    </td>
                                                           
                    <td>
                        @if ($booking->status === \App\Models\Booking::STATUS_PENDING)
                            <form action="{{ route('bookings.verify', $booking->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Verify</button>
                            </form>
                        @endif
                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info">View</a>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    
</div>
@endsection
