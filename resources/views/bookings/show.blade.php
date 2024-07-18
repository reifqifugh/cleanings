@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Booking Details') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <th>{{ __('Booking Code') }}</th>
                            <td>{{ $booking->booking_code }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Category') }}</th>
                            <td>{{ $booking->category->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Room Size') }}</th>
                            <td>{{ $booking->roomSize->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Size') }}</th>
                            <td>{{ $booking->size }} m²</td>
                        </tr>
                        <tr>
                            <th>{{ __('Address') }}</th>
                            <td>{{ $booking->address }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Phone') }}</th>
                            <td>{{ $booking->phone }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Booking Date') }}</th>
                            <td>{{ $booking->booking_date }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Total Price') }}</th>
                            <td>{{ $booking->total_price }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Payment Method') }}</th>
                            <td>{{ $booking->paymentMethod->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Payment Proof') }}</th>
                            <td>
                                @if ($booking->payment_proof)
                                    <a href="{{ Storage::url($booking->payment_proof) }}" target="_blank">View Proof</a>
                                @else
                                    {{ __('No proof uploaded') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('Status') }}</th>
                            <td>{{ $booking->status }}</td>
                        </tr>
                    </table>
                    @if (auth()->user()->role_id == 1)
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary">{{ __('Back to List') }}</a>
                    @else
                    <a href="{{ route('client.home') }}" class="btn btn-secondary">Back</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
