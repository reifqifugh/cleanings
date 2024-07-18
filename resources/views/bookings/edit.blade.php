@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Edit Booking
                    </div>
                    <div class="card-body">
                        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('bookings.form', ['booking' => $booking])
                            <button type="submit" class="btn btn-primary">Update Booking</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
