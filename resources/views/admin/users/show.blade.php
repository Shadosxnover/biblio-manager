@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 bg-secondary text-white min-h-screen p-4">
        <h2 class="text-xl font-bold mb-6">Admin Panel</h2>
        <nav>
            <ul class="space-y-2">
                <li><a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 rounded hover:bg-primary">Dashboard</a></li>
                <li><a href="{{ route('admin.books.index') }}" class="block py-2 px-3 rounded hover:bg-primary">Books</a></li>
                <li><a href="{{ route('admin.categories.index') }}" class="block py-2 px-3 rounded hover:bg-primary">Categories</a></li>
                <li><a href="{{ route('admin.users.index') }}" class="block py-2 px-3 rounded hover:bg-primary">Users</a></li>
                <li><a href="{{ route('admin.borrowings.index') }}" class="block py-2 px-3 rounded hover:bg-primary">Borrowings</a></li>
                <li><a href="{{ route('admin.profile') }}" class="block py-2 px-3 rounded hover:bg-primary">My Profile</a></li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-primary">User Details</h2>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">Back to List</a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="text-lg font-semibold">User Information</h3>
                    <div class="mt-4">
                        <p><strong>ID:</strong> {{ $user->id }}</p>
                        <p class="mt-2"><strong>Name:</strong> {{ $user->name }}</p>
                        <p class="mt-2"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="mt-2"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                        <p class="mt-2"><strong>Registered On:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold">Borrowing History</h3>
                    @if($user->borrowings->count() > 0)
                        <div class="mt-4 overflow-auto max-h-96">
                            <table class="min-w-full">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b">Book</th>
                                        <th class="py-2 px-4 border-b">Borrowed</th>
                                        <th class="py-2 px-4 border-b">Return Due</th>
                                        <th class="py-2 px-4 border-b">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->borrowings as $borrowing)
                                        <tr>
                                            <td class="py-2 px-4 border-b">{{ $borrowing->book->title }}</td>
                                            <td class="py-2 px-4 border-b">{{ $borrowing->borrow_date->format('M d, Y') }}</td>
                                            <td class="py-2 px-4 border-b">{{ $borrowing->return_date->format('M d, Y') }}</td>
                                            <td class="py-2 px-4 border-b">
                                                @if($borrowing->returned_at)
                                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                                        Returned {{ $borrowing->returned_at->format('M d, Y') }}
                                                    </span>
                                                @elseif($borrowing->isOverdue())
                                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Overdue</span>
                                                @else
                                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Borrowed</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="mt-4 text-gray-500">This user has not borrowed any books yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
