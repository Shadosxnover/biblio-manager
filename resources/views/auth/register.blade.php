@extends('layouts.app')

@section('styles')
<style>
    .auth-container {
        min-height: calc(100vh - 64px - 76px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }
    
    .register-form {
        min-width: 400px;
        width: 100%;
        max-width: 480px;
    }
    
    .max-w-md {
        max-width: 32rem !important;
    }
    
    @media (max-width: 640px) {
        .register-form {
            min-width: 320px;
        }
    }
</style>
@endsection

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
    <div class="register-form bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-primary mb-6 text-center">Register</h2>

        <form method="POST" action="{{ route('register') }}" class="w-full">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-secondary text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" 
                    class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-primary" 
                    value="{{ old('name') }}" required autofocus>
                @error('name')
                    <p class="text-primary text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-secondary text-sm font-bold mb-2">Email Address</label>
                <input type="email" name="email" id="email" 
                    class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-primary" 
                    value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-primary text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-secondary text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" id="password" 
                    class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-primary" 
                    required>
                @error('password')
                    <p class="text-primary text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-secondary text-sm font-bold mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                    class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-primary" 
                    required>
            </div>

            <div>
                <button type="submit" class="w-full bg-primary hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Register
                </button>
            </div>
        </form>
        
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-primary hover:underline">Already have an account? Login</a>
        </div>
    </div>
</div>
@endsection
