@extends('layouts.app')

@section('styles')
<style>
    /* Admin sidebar and content layout */
    .admin-layout {
        display: flex;
        width: 100%;
        min-height: calc(100vh - 64px - 76px); /* Adjust for navbar and footer */
    }
    
    .admin-sidebar {
        position: sticky;
        top: 64px; /* Height of navbar */
        height: calc(100vh - 64px); /* Full height minus navbar */
        width: 16rem;
        flex-shrink: 0;
        overflow-y: auto;
    }
    
    .admin-content {
        flex: 1;
        max-width: 100%;
    }
    
    /* Responsive adjustments */
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
<!-- Mobile sidebar toggle button (visible on small screens) -->
<div class="md:hidden bg-gray-100 p-4 sticky top-16 z-30 border-b flex justify-between items-center">
    <h1 class="font-bold text-xl text-primary">Admin Panel</h1>
    <button id="mobile-menu-toggle" class="text-gray-600 hover:text-primary focus:outline-none p-2 rounded-full hover:bg-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<div class="admin-layout">
    <!-- Sidebar -->
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

    <!-- Main Content -->
    <div class="admin-content p-4 md:p-6 lg:p-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-primary mb-3 md:mb-0">Books Management</h2>
            <a href="{{ route('admin.books.create') }}" class="bg-primary hover:bg-primary-dark text-white py-2 px-4 rounded-md inline-flex items-center transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Book
            </a>
        </div>
        
        <!-- Search and Filter -->
        <div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
            <form action="{{ route('admin.books.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" class="pl-10 pr-4 py-2 border rounded-md w-full focus:ring-primary focus:border-primary" placeholder="Search books..." value="{{ request()->search }}">
                    </div>
                </div>
                <div class="w-full md:w-48">
                    <label for="category" class="sr-only">Category</label>
                    <select name="category" id="category" class="border rounded-md py-2 px-4 w-full focus:ring-primary focus:border-primary">
                        <option value="">All Categories</option>
                        @foreach(App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" {{ request()->category == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-secondary hover:bg-secondary-dark text-white py-2 px-4 rounded-md">
                        Filter
                    </button>
                    <a href="{{ route('admin.books.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md">
                        Clear
                    </a>
                </div>
            </form>
        </div>
        
        <!-- Books List -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Author
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($books as $book)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($book->cover_image)
                                            <div class="flex-shrink-0 h-10 w-10 mr-3">
                                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="h-10 w-10 rounded object-cover">
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $book->title }}</div>
                                            <div class="text-xs text-gray-500">ISBN: {{ $book->isbn }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $book->author }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $book->category->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($book->is_available)
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Available
                                        </span>
                                    @else
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Borrowed
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.books.show', $book) }}" class="text-blue-600 hover:text-blue-900">
                                            View
                                        </a>
                                        <a href="{{ route('admin.books.edit', $book) }}" class="text-indigo-600 hover:text-indigo-900">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No books found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-3">
                {{ $books->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Mobile menu toggle
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
            
            // Close menu when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 768 && 
                    !mobileMenu.contains(event.target) && 
                    !mobileMenuToggle.contains(event.target) &&
                    !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.remove('open');
                    mobileMenu.classList.add('hidden');
                }
            });
            
            // Update visibility on window resize
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
