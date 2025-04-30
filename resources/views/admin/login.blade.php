@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg p-6">
    <h2 class="text-2xl font-bold text-primary mb-6 text-center">Admin Login</h2>

    @if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-secondary text-sm font-bold mb-2">Email Address</label>
            <input type="email" name="email" id="email" 
                class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-primary" 
                value="{{ old('email') }}" required>
        </div>

        <div class="mb-6">
            <label for="password" class="block text-secondary text-sm font-bold mb-2">Password</label>
            <input type="password" name="password" id="password" 
                class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-primary" 
                required>
        </div>

        <div>
            <button type="submit" class="w-full bg-primary hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Login as Admin
            </button>
        </div>
    </form>
    
    <div class="mt-4 text-center">
        <a href="{{ route('login') }}" class="text-primary hover:underline">Back to user login</a>
    </div>
</div>
@endsection
