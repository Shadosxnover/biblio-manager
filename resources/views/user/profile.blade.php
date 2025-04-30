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
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-primary">My Profile</h2>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Profile Information</h3>
                    
                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                            <input type="text" name="name" id="name" class="border rounded w-full py-2 px-3" 
                                value="{{ auth()->user()->name }}" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                            <input type="email" id="email" class="border rounded w-full py-2 px-3 bg-gray-100" 
                                value="{{ auth()->user()->email }}" disabled>
                            <p class="text-sm text-gray-500 mt-1">Email cannot be changed</p>
                        </div>
                        
                        <div>
                            <button type="submit" class="bg-primary hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Change Password</h3>
                    <form action="{{ route('user.profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="current_password" class="block text-gray-700 font-bold mb-2">Current Password:</label>
                            <input type="password" name="current_password" id="current_password" 
                                   class="border rounded w-full py-2 px-3" required>
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-bold mb-2">New Password:</label>
                            <input type="password" name="password" id="password" 
                                   class="border rounded w-full py-2 px-3" required>
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm New Password:</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="border rounded w-full py-2 px-3" required>
                        </div>
                        
                        <div>
                            <button type="submit" class="bg-primary hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
