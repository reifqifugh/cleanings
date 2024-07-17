@extends('layouts.app')

@section('style')
<style>
    .full-width-image {
        width: 100%;
        height: auto;
        display: block;
    }
    .image-container {
        position: relative;
        text-align: center;
        color: white;
    }
    .search-form {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%; /* Lebar form disesuaikan dengan kebutuhan */
        max-width: 600px; /* Maksimum lebar form */
        padding: 20px; /* Padding untuk memberi ruang di dalam form */
        border-radius: 30px; /* Sudut bulat pada form */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Efek bayangan untuk form, lebih tebal */
    }
    .search-form .form-control {
        border: none;
        border-radius: 30px;
        box-shadow: none;
        padding: 30px 20px; /* Padding untuk input teks */
    }
    .search-form .btn {
        border-radius: 30px;
        background-color: #007bff;
        border-color: #007bff;
        color: white;
        padding: 10px 20px; /* Padding untuk tombol */
    }
    .search-form .btn i {
        font-size: 18px;
    }
    .search-form .btn:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>
@endsection

@section('content')
<div class="image-container">
    <img src="{{ asset('img/userhome.jpeg') }}" alt="userhomeimage" class="img-fluid full-width-image mb-2">
    <form action="{{ route('bookings.search') }}" method="GET" class="search-form">
        <div class="input-group">
            <input type="text" class="form-control" name="booking_kode" placeholder="Cari kode Pemesanan" aria-label="Search" aria-describedby="button-addon2">
            <button class="btn" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
        </div>
    </form>
    @if (session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
</div>
@endsection
