@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Edit Payment Method
                    </div>
                    <div class="card-body">
                        <form action="{{ route('payment_methods.update', $paymentMethod->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('payment_methods.form')
                            <button type="submit" class="btn btn-primary">Update Payment Method</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
