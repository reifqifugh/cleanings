@extends('layouts.admin')
@section('title', 'room')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Room Sizes
                        <a href="{{ route('room_sizes.create') }}" class="btn btn-success float-right">Add Room Size</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Harga Permeter (Rp)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roomSizes as $roomSize)
                                    <tr>
                                        <td>{{ $roomSize->id }}</td>
                                        <td>{{ $roomSize->category->name }}</td>
                                        <td>{{ $roomSize->name }}</td>
                                        <td>Rp {{ number_format($roomSize->price, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('room_sizes.edit', $roomSize->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('room_sizes.destroy', $roomSize->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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
