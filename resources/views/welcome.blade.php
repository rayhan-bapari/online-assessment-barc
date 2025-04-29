<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BARC Online Assessment</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .hero-pattern {
            background-color: #ffffff;
            background-image: radial-gradient(#3b82f6 0.5px, transparent 0.5px), radial-gradient(#3b82f6 0.5px, #ffffff 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.1;
        }

        .gradient-text {
            background: linear-gradient(45deg, #ef4444, #1e3a8a);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-shape {
            position: absolute;
            right: -150px;
            top: -100px;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(30, 58, 138, 0.15));
            border-radius: 50%;
            z-index: 0;
        }
    </style>
</head>

<body class="font-sans antialiased min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <x-application-logo />
                </div>

                @if (Route::has('login'))
                    <nav class="flex space-x-4">
                        @auth
                            <a href="{{ url('/exams') }}"
                                class="rounded-md px-4 py-2 text-sm font-medium bg-blue-900 text-white hover:bg-blue-800 transition duration-150 ease-in-out">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="rounded-md px-4 py-2 text-sm font-medium bg-white text-blue-900 border border-blue-900 hover:bg-blue-50 transition duration-150 ease-in-out">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="rounded-md px-4 py-2 text-sm font-medium bg-red-600 text-white hover:bg-red-500 transition duration-150 ease-in-out ml-2">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <div class="relative bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="flex flex-col md:flex-row items-center justify-between py-16 md:py-28 gap-8">
                    <div class="md:w-1/2 text-center md:text-left">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight mb-4">
                            <span class="gradient-text">Online Assessment</span>
                            <span class="block mt-2">Platform</span>
                        </h1>
                        <p class="text-lg md:text-xl text-gray-600 max-w-xl mt-4">
                            Streamlined assessment solutions for educational institutions and organizations
                        </p>

                        <div class="mt-3 bg-red-600 text-white rounded-lg p-4 shadow-lg">
                            <span class="font-semibold">Trusted by 500+ institutions</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
