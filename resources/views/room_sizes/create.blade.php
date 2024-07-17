@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Add Room Size
                    </div>
                    <div class="card-body">
                            <form action="{{ route('room_sizes.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Room Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price per Meter</label>
                                    <input type="number" step="0.01" name="price" id="price" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
