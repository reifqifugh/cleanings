@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Category</h1>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
        </div>
        <div class="form-group">
            <label for="price_per_meter">Price per Meter</label>
            <input type="number" class="form-control" id="price_per_meter" name="price_per_meter" value="{{ $category->price_per_meter }}" step="0.01">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
