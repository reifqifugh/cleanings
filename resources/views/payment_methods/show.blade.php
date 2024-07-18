@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Payment Method Details
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $paymentMethod->name }}</p>
                        <p><strong>Details:</strong> {{ $paymentMethod->details }}</p>
                        <a href="{{ route('payment_methods.edit', $paymentMethod->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('payment_methods.destroy', $paymentMethod->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
