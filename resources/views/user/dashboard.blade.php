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
        <h2 class="text-2xl font-bold text-primary mb-6">My Borrowed Books</h2>
        
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($borrowings->count() > 0)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed On</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Return Due</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($borrowings as $borrowing)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $borrowing->book->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $borrowing->book->author }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $borrowing->borrow_date->format('M d, Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $borrowing->return_date->format('M d, Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($borrowing->returned_at)
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                            Returned on {{ $borrowing->returned_at->format('M d, Y') }}
                                        </span>
                                    @elseif($borrowing->isOverdue())
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">
                                            Overdue by {{ now()->diffInDays($borrowing->return_date) }} days
                                        </span>
                                    @else
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">
                                            {{ $borrowing->return_date->diffInDays(now()) }} days remaining
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-500">You have not borrowed any books yet.</p>
                <a href="{{ route('books.index') }}" class="mt-4 inline-block bg-primary hover:bg-red-700 text-white py-2 px-4 rounded">Browse Books</a>
            </div>
        @endif
    </div>
</div>
@endsection
