@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Add Payment Method
                    </div>
                    <div class="card-body">
                        <form action="{{ route('payment_methods.store') }}" method="POST">
                            @csrf
                            @include('payment_methods.form')
                            <button type="submit" class="btn btn-primary">Create Payment Method</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
