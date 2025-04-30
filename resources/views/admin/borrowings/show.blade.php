@extends('layouts.app')

@section('styles')
<style>
    .admin-layout {
        display: flex;
        width: 100%;
        min-height: calc(100vh - 64px - 76px);
    }
    
    .admin-sidebar {
        position: sticky;
        top: 64px;
        height: calc(100vh - 64px);
        width: 16rem;
        flex-shrink: 0;
        overflow-y: auto;
    }
    
    .admin-content {
        flex: 1;
        max-width: 100%;
    }
    
    @media (max-width: 768px) {
        .admin-layout {
            flex-direction: column;
        }
        .admin-sidebar {
            position: fixed;
            z-index: 40;
            height: 100vh;
            width: 100%;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        .admin-sidebar.open {
            transform: translateX(0);
        }
    }
</style>
@endsection

@section('content')
<div class="md:hidden bg-gray-100 p-4 sticky top-16 z-30 border-b flex justify-between items-center">
    <h1 class="font-bold text-xl text-primary">Admin Panel</h1>
    <button id="mobile-menu-toggle" class="text-gray-600 hover:text-primary focus:outline-none p-2 rounded-full hover:bg-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<div class="admin-layout">
    <div id="mobile-menu" class="admin-sidebar bg-secondary text-white p-4 hidden md:block">
        <div class="pb-4 border-b border-gray-700">
            <h2 class="text-xl font-bold">Admin Panel</h2>
            <p class="text-sm text-gray-300 mt-1">Manage your library</p>
        </div>
        <nav class="mt-6">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center space-x-3 py-2 px-3 rounded-lg hover:bg-primary transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.books.index') }}" 
                       class="flex items-center space-x-3 py-2 px-3 rounded-lg hover:bg-primary transition-colors {{ request()->routeIs('admin.books.*') ? 'bg-primary' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>Books</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}" 
                       class="flex items-center space-x-3 py-2 px-3 rounded-lg hover:bg-primary transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-primary' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" 
                       class="flex items-center space-x-3 py-2 px-3 rounded-lg hover:bg-primary transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-primary' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.borrowings.index') }}" 
                       class="flex items-center space-x-3 py-2 px-3 rounded-lg hover:bg-primary transition-colors {{ request()->routeIs('admin.borrowings.*') ? 'bg-primary' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Borrowings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.profile') }}" 
                       class="flex items-center space-x-3 py-2 px-3 rounded-lg hover:bg-primary transition-colors {{ request()->routeIs('admin.profile') ? 'bg-primary' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>My Profile</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="mt-8 pt-4 border-t border-gray-700">
            <div class="flex items-center px-3 py-2">
                <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                    <span class="font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400">Administrator</p>
                </div>
            </div>
        </div>
    </div>

    <div class="admin-content p-4 md:p-6 lg:p-8">
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 mb-1">Borrowing Details</h1>
                <p class="text-gray-600">View details and manage this borrowing record</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.borrowings.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-md inline-flex items-center text-sm transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Borrowing Information</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Borrowing Details</h3>
                        <div class="bg-gray-50 rounded-md p-4">
                            <ul class="space-y-3">
                                <li class="flex justify-between">
                                    <span class="text-gray-600">ID:</span>
                                    <span class="font-medium">{{ $borrowing->id }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Borrow Date:</span>
                                    <span class="font-medium">{{ $borrowing->borrow_date ? date('M d, Y', strtotime($borrowing->borrow_date)) : 'N/A' }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Expected Return:</span>
                                    <span class="font-medium">{{ $borrowing->return_date ? date('M d, Y', strtotime($borrowing->return_date)) : 'N/A' }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="font-medium">
                                        @if($borrowing->returned_at)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Returned
                                            </span>
                                        @elseif(date('Y-m-d', strtotime($borrowing->return_date)) < date('Y-m-d'))
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500 text-white">
                                                Overdue
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Active
                                            </span>
                                        @endif
                                    </span>
                                </li>
                                @if($borrowing->returned_at)
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Returned On:</span>
                                    <span class="font-medium">{{ $borrowing->returned_at ? date('M d, Y', strtotime($borrowing->returned_at)) : 'N/A' }}</span>
                                </li>
                                @endif
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Created On:</span>
                                    <span class="font-medium">{{ $borrowing->created_at ? $borrowing->created_at->format('M d, Y') : 'N/A' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-md font-medium text-gray-700 mb-3">Book Information</h3>
                        <div class="bg-gray-50 rounded-md p-4">
                            <ul class="space-y-3">
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Book ID:</span>
                                    <span class="font-medium">{{ $borrowing->book->id }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Title:</span>
                                    <span class="font-medium">{{ $borrowing->book->title }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Author:</span>
                                    <span class="font-medium">{{ $borrowing->book->author }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Category:</span>
                                    <span class="font-medium">{{ $borrowing->book->category->name }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Publication Year:</span>
                                    <span class="font-medium">{{ $borrowing->book->publication_year }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6">
                    <h3 class="text-md font-medium text-gray-700 mb-3">Borrower Information</h3>
                    <a href="{{ route('admin.users.show', $borrowing->user->id) }}" class="bg-gray-50 rounded-md p-4 block hover:bg-gray-100 transition-colors">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                    <span class="text-gray-600">{{ substr($borrowing->user->name, 0, 1) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $borrowing->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $borrowing->user->email }}</div>
                                </div>
                            </div>
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <div>
                @if(!$borrowing->returned_at)
                <form action="{{ route('admin.borrowings.return', $borrowing->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition-colors shadow-sm">
                        Mark as Returned
                    </button>
                </form>
                @endif
            </div>
            
            <div class="flex space-x-2">
                <form action="{{ route('admin.borrowings.destroy', $borrowing->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this borrowing record?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md transition-colors shadow-sm">
                        Delete Record
                    </button>
                </form>
                
                <a href="{{ route('admin.borrowings.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-md transition-colors shadow-sm">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        
        if (mobileMenu && mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    mobileMenu.classList.toggle('open');
                    mobileMenu.classList.toggle('hidden');
                }
            });
            
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 768 && 
                    !mobileMenu.contains(event.target) && 
                    !mobileMenuToggle.contains(event.target) &&
                    !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.remove('open');
                    mobileMenu.classList.add('hidden');
                }
            });
            
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    mobileMenu.classList.remove('hidden');
                    mobileMenu.classList.remove('open');
                } else if (!mobileMenu.classList.contains('open')) {
                    mobileMenu.classList.add('hidden');
                }
            });
        }
    });
</script>
@endsection
