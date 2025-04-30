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
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-primary mb-3 md:mb-0">Admin Profile</h2>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex flex-col md:flex-row items-start gap-6">
                <div class="w-32 h-32 rounded-full bg-primary flex items-center justify-center text-white text-4xl font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                
                <div class="flex-1">
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('admin.profile.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                <input type="text" name="name" id="name" class="border rounded-md py-2 px-4 w-full focus:ring-primary focus:border-primary" value="{{ auth()->user()->name }}">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="email" class="border rounded-md py-2 px-4 w-full focus:ring-primary focus:border-primary" value="{{ auth()->user()->email }}">
                            </div>
                        </div>
                        
                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium mb-4">Change Password</h3>
                            <p class="text-gray-500 text-sm mb-4">Leave the password fields blank if you don't want to change it.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                    <input type="password" name="current_password" id="current_password" class="border rounded-md py-2 px-4 w-full focus:ring-primary focus:border-primary">
                                </div>
                                
                                <div></div>
                                
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                    <input type="password" name="password" id="password" class="border rounded-md py-2 px-4 w-full focus:ring-primary focus:border-primary">
                                </div>
                                
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="border rounded-md py-2 px-4 w-full focus:ring-primary focus:border-primary">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="bg-primary hover:bg-primary-dark text-white py-2 px-6 rounded-md shadow-sm">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
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
