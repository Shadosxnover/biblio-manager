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
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-primary">Book Details</h2>
            <a href="{{ route('books.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                Back to Books
            </a>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-100 rounded-lg flex items-center justify-center h-64">
                    <span class="text-gray-400 text-lg">Book Cover</span>
                </div>
                
                <div class="md:col-span-2">
                    <h1 class="text-2xl font-bold mb-2">{{ $book->title }}</h1>
                    <p class="text-xl text-gray-600 mb-4">By {{ $book->author }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="mb-2"><strong>Publication Year:</strong> {{ $book->publication_year }}</p>
                            <p class="mb-2"><strong>Category:</strong> {{ $book->category->name }}</p>
                        </div>
                        <div>
                            <p class="mb-2"><strong>Status:</strong> 
                                <span class="{{ $book->is_available ? 'text-green-600' : 'text-red-600' }} font-semibold">
                                    {{ $book->is_available ? 'Available' : 'Currently Borrowed' }}
                                </span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-6 border-t pt-4">
                        <p class="text-gray-500 italic">
                            Note: To borrow this book, please visit the library desk or contact a librarian.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
