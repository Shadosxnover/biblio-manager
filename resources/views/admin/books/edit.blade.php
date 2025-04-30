@extends('admin.layouts.admin')

@section('admin-content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Edit Book</h2>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('admin.books.update', $book) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
                <input type="text" name="title" id="title" class="border rounded w-full py-2 px-3" value="{{ $book->title }}" required>
            </div>
            
            <div class="mb-4">
                <label for="author" class="block text-gray-700 font-bold mb-2">Author:</label>
                <input type="text" name="author" id="author" class="border rounded w-full py-2 px-3" value="{{ $book->author }}" required>
            </div>
            
            <div class="mb-4">
                <label for="publication_year" class="block text-gray-700 font-bold mb-2">Publication Year:</label>
                <input type="number" name="publication_year" id="publication_year" class="border rounded w-full py-2 px-3" value="{{ $book->publication_year }}" required>
            </div>
            
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-bold mb-2">Category:</label>
                <select name="category_id" id="category_id" class="border rounded w-full py-2 px-3" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Availability:</label>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="is_available" value="1" class="form-radio" {{ $book->is_available ? 'checked' : '' }}>
                        <span class="ml-2">Available</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" name="is_available" value="0" class="form-radio" {{ !$book->is_available ? 'checked' : '' }}>
                        <span class="ml-2">Not Available</span>
                    </label>
                </div>
            </div>
            
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('admin.books.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                <button type="submit" class="bg-primary hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Update Book</button>
            </div>
        </form>
    </div>
@endsection
