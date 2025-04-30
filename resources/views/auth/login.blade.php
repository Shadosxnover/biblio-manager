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
    
    .login-form {
        min-width: 400px;
        width: 100%;
        max-width: 480px;
    }
    
    .max-w-md {
        max-width: 32rem !important;
    }
    
    @media (max-width: 640px) {
        .login-form {
            min-width: 320px;
        }
    }
</style>
@endsection

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
    <div class="login-form bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-primary mb-6 text-center">Login</h2>

        <form method="POST" action="{{ route('login') }}" class="w-full">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-secondary text-sm font-bold mb-2">Email Address</label>
                <input type="email" name="email" id="email" 
                    class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-primary" 
                    value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="text-primary text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-secondary text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" id="password" 
                    class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-primary" 
                    required>
                @error('password')
                    <p class="text-primary text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="w-full bg-primary hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Login
                </button>
            </div>
        </form>
        
        <div class="mt-4 text-center">
            <a href="/admin/login" class="text-primary hover:underline">Log in as administrator</a>
        </div>
    </div>
</div>
@endsection
