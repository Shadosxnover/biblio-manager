<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Biblio') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <style>
        .auth-form-container {
            width: 100%;
            max-width: 480px !important;
            margin: 0 auto;
        }
        
        .max-w-md {
            max-width: 32rem !important;
        }
        
        @media (min-width: 640px) {
            .container {
                width: 100%;
                padding-right: 2rem;
                padding-left: 2rem;
            }
        }
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#000000',
                        'primary-dark': '#333333',
                        'primary-light': '#666666',
                        secondary: '#D00000',
                        'secondary-light': '#FF3333',
                        'secondary-dark': '#990000',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-in': 'slideIn 0.5s ease-out',
                        'pulse-slow': 'pulse 3s infinite',
                        'bounce-slow': 'bounce 3s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideIn: {
                            '0%': { transform: 'translateY(10px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
                    },
                    boxShadow: {
                        'soft': '0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1)',
                        'hover': '0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05)',
                        'button': '0 2px 4px rgba(0, 0, 0, 0.1), 0 4px 8px rgba(0, 0, 0, 0.1)',
                        'card': '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                    },
                    borderRadius: {
                        'xl': '1rem',
                        '2xl': '1.5rem',
                        '3xl': '2rem',
                    },
                    transitionProperty: {
                        'height': 'height',
                        'spacing': 'margin, padding',
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #D00000;
        }
        
        .btn {
            @apply rounded-xl py-2.5 px-5 font-medium transition-all duration-300 shadow-button transform hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2;
        }
        .btn-primary {
            @apply bg-primary text-white hover:bg-primary-dark focus:ring-primary-dark;
        }
        .btn-secondary {
            @apply bg-secondary text-white hover:bg-secondary-dark focus:ring-secondary;
        }
        .btn-outline {
            @apply border-2 bg-transparent hover:bg-gray-50;
        }
        
        .card {
            @apply bg-white rounded-xl shadow-card overflow-hidden transition-all duration-300 hover:shadow-lg;
        }
        
        input, select, textarea {
            @apply rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary-light focus:ring-opacity-30 transition-all duration-200;
        }
        
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
        
        .toast {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 50;
            border-radius: 0.75rem;
            transform: translateX(150%);
            transition: transform 0.5s ease;
        }
        .toast.show {
            transform: translateX(0);
        }
        
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .text-red-500 { color: #000000 !important; }
        .text-red-600 { color: #000000 !important; }
        .text-red-700 { color: #000000 !important; }
        .text-red-800 { color: #000000 !important; }
        
        .bg-red-100 { background-color: #f0f0f0 !important; }
        .bg-red-500 { background-color: #000000 !important; }
        .bg-red-600 { background-color: #000000 !important; }
        
        .border-red-500 { border-color: #000000 !important; }
        .border-red-600 { border-color: #000000 !important; }
        
        .hover\:bg-red-600:hover { background-color: #000000 !important; }
        .hover\:bg-red-700:hover { background-color: #000000 !important; }
        .hover\:text-red-500:hover { color: #000000 !important; }
        .hover\:text-red-600:hover { color: #000000 !important; }

        @media (min-width: 640px) {
            .max-w-md {
                max-width: 32rem !important;
            }
        }
        
        .auth-form-container {
            width: 100%;
            max-width: 480px !important; /* Force wider forms */
            margin: 0 auto;
        }
    </style>
    
    @yield('styles')
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col">
    <nav class="bg-primary text-white p-4 shadow-md sticky top-0 z-10">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center space-x-2 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 transform transition group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span class="font-bold text-2xl">Biblio</span>
            </a>
            
            <div x-data="{ open: false }" class="relative">
                @auth
                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none bg-primary-light hover:bg-primary-dark rounded-full px-3 py-1.5 transition-colors">
                        <div class="h-8 w-8 rounded-full bg-white text-primary flex items-center justify-center font-bold shadow-sm">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <span class="hidden md:inline">{{ auth()->user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200" 
                         x-transition:enter-start="opacity-0 scale-95" 
                         x-transition:enter-end="opacity-100 scale-100" 
                         x-transition:leave="transition ease-in duration-150" 
                         x-transition:leave-start="opacity-100 scale-100" 
                         x-transition:leave-end="opacity-0 scale-95"
                         @click.away="open = false"
                         class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg py-2 border border-gray-100">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">Signed in as</p>
                            <p class="text-sm text-gray-600 truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" 
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                           </svg>
                           Dashboard
                        </a>
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.profile') : route('user.profile') }}" 
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                           </svg>
                           My Profile
                        </a>
                        <div class="border-t border-gray-100 mt-2 pt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="space-x-2">
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl hover:bg-primary-light transition-colors text-white">Login</a>
                        <a href="{{ route('register') }}" class="bg-white text-primary px-5 py-2 rounded-xl hover:bg-gray-100 transition-colors shadow-sm font-medium">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <div id="toast" class="toast bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span id="toast-message"></span>
    </div>

    <div class="flex-grow flex justify-center flex-col sm:flex-row">
        @yield('content')
    </div>

    <footer class="bg-secondary text-white p-6 mt-auto">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="font-semibold">Biblio Library</span>
                </div>
                <p>© {{ date('Y') }} Biblio - Library Management System</p>
            </div>
        </div>
    </footer>

    <script>
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            
            toast.className = 'toast shadow-lg flex items-center px-6 py-4 rounded-xl';
            if (type === 'success') {
                toast.classList.add('bg-green-600', 'text-white');
            } else if (type === 'error') {
                toast.classList.add('bg-secondary', 'text-white');
            } else if (type === 'warning') {
                toast.classList.add('bg-amber-500', 'text-white');
            }
            
            toastMessage.textContent = message;
            toast.classList.add('show');
            
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
        
        document.addEventListener('DOMContentLoaded', () => {
            @if(session('success'))
                showToast("{{ session('success') }}", 'success');
            @endif
            
            @if(session('error'))
                showToast("{{ session('error') }}", 'error');
            @endif
            
            @if(session('warning'))
                showToast("{{ session('warning') }}", 'warning');
            @endif
            
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            
            if (mobileMenu && mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>

    @yield('scripts')
</body>
</html>
