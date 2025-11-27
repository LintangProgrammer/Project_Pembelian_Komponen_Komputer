<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|instrument-sans:400,500,600,700"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --gradient-start: #FF3B00;
            --gradient-end: #FF8A00;
            --accent: #FF3B00;
        }

        .dark {
            --gradient-start: #FF6B00;
            --gradient-end: #FFB700;
            --accent: #FF8A00;
        }

        .bg-gradient-hero {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
        }

        .logo-glow {
            filter: drop-shadow(0 0 40px rgba(255, 59, 0, 0.6));
        }

        .dark .logo-glow {
            filter: drop-shadow(0 0 60px rgba(255, 107, 0, 0.8));
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-black text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">

    <!-- Hero Section -->
    <div class="flex-1 flex items-center justify-center relative overflow-hidden">
        <!-- Background Gradient Blob -->
        <div class="absolute inset-0 opacity-20 dark:opacity-30">
            <div
                class="absolute -top-40 -left-40 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob">
            </div>
            <div
                class="absolute -bottom-40 -right-40 w-96 h-96 bg-red-600 rounded-full mix-blend-multiply filter blur-3xl animation-delay-2000 animate-blob">
            </div>
            <div
                class="absolute top-40 right-20 w-96 h-96 bg-amber-500 rounded-full mix-blend-multiply filter blur-3xl animation-delay-4000 animate-blob">
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 py-24">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Left: Text + CTA -->
                <div class="order-2 lg:order-1 space-y-10">
                    <div class="space-y-6">
                        <h1 class="text-6xl lg:text-8xl font-bold tracking-tighter">
                            <span
                                class="bg-clip-text text-transparent bg-gradient-to-r from-orange-600 to-red-600 dark:from-orange-400 dark:to-amber-400">
                                Laravel
                            </span>
                            <br>
                            <span class="text-gray-800 dark:text-gray-200">12</span>
                        </h1>
                        <p class="text-xl lg:text-2xl text-gray-600 dark:text-gray-300 leading-relaxed max-w-xl">
                            The PHP framework for web artisans — kini lebih cepat, lebih elegan, dan lebih powerful dari
                            sebelumnya.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <a href="https://laravel.com/docs" target="_blank"
                            class="group inline-flex items-center gap-3 bg-black dark:bg-white text-white dark:text-black px-8 py-4 rounded-full font-semibold text-lg hover:shadow-2xl hover:scale-105 transition-all duration-300">
                            Baca Dokumentasi
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="https://laracasts.com" target="_blank"
                            class="inline-flex items-center gap-3 border-2 border-gray-800 dark:border-gray-200 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-900 hover:text-white dark:hover:bg-gray-100 dark:hover:text-black transition-all">
                            Laracasts
                        </a>
                    </div>

                    <div class="flex items-center gap-8 pt-8">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-orange-600">10+</div>
                            <div class="text-sm text-gray-500">Tahun</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-orange-600">50M+</div>
                            <div class="text-sm text-gray-500">Downloads</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-orange-600">#1</div>
                            <div class="text-sm text-gray-500">PHP Framework</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Laravel 12 Logo (Super Glow Edition) -->
                <div class="order-1 lg:order-2 flex justify-center">
                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-orange-600 to-red-600 rounded-full blur-3xl opacity-50 animate-pulse">
                        </div>
                        <svg class="w-96 h-96 lg:w-[520px] lg:h-[520px] logo-glow relative z-10" viewBox="0 0 438 376"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <!-- Logo Laravel 12 yang sama, tapi pakai currentColor biar ikut tema -->
                            <use href="#laravel-logo-12" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation (tetap ada kalau login/register) -->
    @if (Route::has('login'))
        <header class="absolute top-8 right-8 z-20">
            <nav class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-6 py-3 bg-white dark:bg-gray-900 rounded-full shadow-lg font-medium hover:shadow-xl transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-3 border-2 border-gray-300 dark:border-gray-700 rounded-full font-medium hover:bg-gray-100 dark:hover:bg-gray-900 transition">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-6 py-3 bg-black dark:bg-white text-white dark:text-black rounded-full font-medium hover:shadow-xl transition">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        </header>
    @endif

    <!-- Footer kecil -->
    <footer class="py-8 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} Laravel. Crafted with <span class="text-red-600">♥</span> by artisans.</p>
    </footer>

    <!-- Animasi Blob -->
    <style>
        @keyframes blob {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 40px) scale(0.9);
            }
        }

        .animate-blob {
            animation: blob 20s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

    <!-- SVG Logo Definition (biar bisa reuse) -->
    <svg width="0" height="0" class="hidden">
        <defs>
            <g id="laravel-logo-12">
                <!-- Paste semua path logo Laravel 12 di sini (yang panjang itu) -->
                <!-- Aku singkat biar nggak terlalu panjang, tapi kamu copy dari yang lama -->
                <path d="M17.2036 -3H0V102.197H49.5189V86.7187H17.2036V-3Z" fill="currentColor" />
                <!-- ... semua path logo yang lama ... -->
                <path d="M464.198 304.708L435.375 254.789L377.307 355.366L406.13 405.285L464.198 304.708Z"
                    fill="currentColor" />
            </g>
        </defs>
    </svg>
</body>

</html>