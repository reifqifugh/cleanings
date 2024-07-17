@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Edit Room Size
                    </div>
                    <div class="card-body">
                        <form action="{{ route('room_sizes.update', $roomSize->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $roomSize->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $roomSize->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ $roomSize->price }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Room Size</button>
                            <a href="{{ route('room_sizes.index') }}" class="btn btn-secondary">kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
