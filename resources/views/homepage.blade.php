<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblio - Library Management System</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
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
                    }
                }
            }
        }
    </script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }
        
        .feature-icon {
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover .feature-icon {
            transform: scale(1.1);
        }
        
        .stats-section {
            background-image: linear-gradient(rgba(208, 0, 0, 0.9), rgba(208, 0, 0, 0.9)), url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
        }
        
        .btn {
            @apply rounded-xl py-2.5 px-5 font-medium transition-all duration-300 shadow-md transform hover:-translate-y-1 hover:shadow-lg focus:outline-none;
        }
    </style>
</head>
<body class="antialiased bg-gray-50">
    <nav class="bg-primary text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span class="font-bold text-2xl">Biblio</span>
            </a>
            
            <div class="space-x-2">
                @if (Route::has('login'))
                    <div class="space-x-2">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-xl hover:bg-primary-light transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl hover:bg-primary-light transition-colors">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-white text-primary px-5 py-2 rounded-xl hover:bg-gray-100 transition-colors shadow-sm font-medium">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 text-white">Welcome to Biblio</h1>
                <p class="text-xl md:text-2xl mb-8 text-gray-200">A modern library management system designed to simplify book cataloging, borrowing, and returning.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="bg-secondary hover:bg-secondary-dark text-white font-bold px-8 py-3 rounded-xl shadow-md transition-all">Create Account</a>
                    <a href="{{ route('login') }}" class="border-2 border-white text-white font-bold px-8 py-3 rounded-xl hover:bg-white hover:text-black transition-all">Login</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center">Library Management Made Simple</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="feature-card bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-all">
                    <div class="mb-4 bg-gray-100 rounded-full w-16 h-16 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary feature-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-primary">Expansive Catalog</h3>
                    <p class="text-gray-600">Browse through thousands of books categorized by genre, author, and publication date. Find what you need easily with our powerful search.</p>
                </div>
                
                <div class="feature-card bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-all">
                    <div class="mb-4 bg-gray-100 rounded-full w-16 h-16 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary feature-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-primary">Efficient Borrowing</h3>
                    <p class="text-gray-600">Check out books with ease, view due dates, and manage extensions. Get reminders when your books are due to avoid late fees.</p>
                </div>
                
                <div class="feature-card bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-all">
                    <div class="mb-4 bg-gray-100 rounded-full w-16 h-16 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary feature-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-primary">Personalized Experience</h3>
                    <p class="text-gray-600">Keep track of your reading history, favorite genres, and receive personalized book recommendations based on your interests.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-6">
                    <div class="text-5xl font-bold mb-2">20,000+</div>
                    <div class="text-xl">Books Available</div>
                </div>
                <div class="p-6">
                    <div class="text-5xl font-bold mb-2">5,000+</div>
                    <div class="text-xl">Active Members</div>
                </div>
                <div class="p-6">
                    <div class="text-5xl font-bold mb-2">250+</div>
                    <div class="text-xl">New Additions Monthly</div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center">How Biblio Works</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-secondary rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-white font-bold text-xl">1</div>
                    <h3 class="text-xl font-bold mb-2">Create an Account</h3>
                    <p class="text-gray-600">Sign up to access our complete library catalog and services.</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-secondary rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-white font-bold text-xl">2</div>
                    <h3 class="text-xl font-bold mb-2">Browse Books</h3>
                    <p class="text-gray-600">Explore our extensive collection categorized for easy navigation.</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-secondary rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-white font-bold text-xl">3</div>
                    <h3 class="text-xl font-bold mb-2">Borrow Books</h3>
                    <p class="text-gray-600">Check out your selected books with just a few clicks.</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-secondary rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-white font-bold text-xl">4</div>
                    <h3 class="text-xl font-bold mb-2">Return & Review</h3>
                    <p class="text-gray-600">Return books and share your thoughts to help other readers.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-primary text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Start Reading?</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">Join our library today and discover a world of knowledge at your fingertips.</p>
            <div class="flex justify-center">
                <a href="{{ route('register') }}" class="bg-white text-primary hover:bg-gray-100 px-8 py-3 text-lg font-medium rounded-xl shadow-md transition-all">Join Now</a>
            </div>
        </div>
    </section>

    <footer class="bg-secondary text-white p-6">
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
</body>
</html>
