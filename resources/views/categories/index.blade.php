@extends('layouts.admin')
@section('title', 'kategori')
@section('content')
<div class="container">
    <h1>Kategori</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Kategori</a>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Harga</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>Rp.{{ number_format($category->price, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $category->id }}')">Delete</button>
                            </form>                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>
@endsection

@section('scripts')
<script>

    function confirmDelete(categoryId) {
        if (confirm('Are you sure you want to delete this category?')) {
            document.getElementById('delete-form-' + categoryId).submit();
        }
    }
</script>

