@extends('admin.layouts.admin')

@section('admin-content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">Add New Category</h2>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Category Name:</label>
                <input type="text" name="name" id="name" class="border rounded w-full py-2 px-3" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('admin.categories.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                <button type="submit" class="bg-primary hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Add Category</button>
            </div>
        </form>
    </div>
@endsection
