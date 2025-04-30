@extends('layouts.app')

@section('content')
<div class="flex w-full">
    <div class="w-64 bg-secondary text-white min-h-screen p-4">
        <h2 class="text-xl font-bold mb-6">User Panel</h2>
        <nav>
            <ul class="space-y-2">
                <li><a href="{{ route('user.dashboard') }}" class="block py-2 px-3 rounded hover:bg-primary">Dashboard</a></li>
                <li><a href="{{ route('books.index') }}" class="block py-2 px-3 rounded hover:bg-primary">Browse Books</a></li>
                <li><a href="{{ route('user.profile') }}" class="block py-2 px-3 rounded hover:bg-primary">My Profile</a></li>
            </ul>
        </nav>
    </div>

    <div class="flex-1 p-8">
        <h2 class="text-2xl font-bold text-primary mb-6">Library Books</h2>
        
        <div class="bg-white p-4 rounded shadow mb-6">
            <form action="{{ route('books.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-gray-700 font-bold mb-2">Search by Title or Author</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" 
                           class="border rounded w-full py-2 px-3" placeholder="Enter title or author...">
                </div>
                
                <div class="w-full sm:w-auto">
                    <label for="category" class="block text-gray-700 font-bold mb-2">Category</label>
                    <select id="category" name="category" class="border rounded w-full py-2 px-3">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="w-full sm:w-auto">
                    <label class="flex items-center">
                        <input type="checkbox" name="available" value="1" class="mr-2" {{ request('available') ? 'checked' : '' }}>
                        <span class="text-gray-700 font-bold">Available Books Only</span>
                    </label>
                </div>
                
                <div class="w-full sm:w-auto flex items-center">
                    <button type="submit" class="bg-primary hover:bg-red-700 text-white py-2 px-4 rounded mr-2">Filter</button>
                    <a href="{{ route('books.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">Reset</a>
                </div>
            </form>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($books as $book)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2 text-gray-800">{{ $book->title }}</h3>
                        <p class="text-gray-600 mb-2">By {{ $book->author }}</p>
                        <p class="text-gray-500 mb-1 text-sm">Year: {{ $book->publication_year }}</p>
                        <p class="text-gray-500 mb-3 text-sm">Category: {{ $book->category->name }}</p>
                        
                        <div class="flex justify-between items-center">
                            <span class="{{ $book->is_available ? 'text-green-600' : 'text-red-600' }} font-semibold text-sm">
                                {{ $book->is_available ? 'Available' : 'Not Available' }}
                            </span>
                            <a href="{{ route('books.show', $book) }}" class="bg-primary hover:bg-red-700 text-white text-sm py-1 px-3 rounded">
                                Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white p-6 rounded-lg shadow text-center">
                    <p class="text-gray-500">No books found matching your criteria.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-6">
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection
