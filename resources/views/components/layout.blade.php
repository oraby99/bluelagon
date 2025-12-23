<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Blue Lagoon Tours - Safari & Adventure Experiences' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --safari-sand: #E8D5B5;
            --safari-terracotta: #D4744F;
            --safari-orange: #E89B3C;
            --safari-forest: #2a3a45;
            --safari-deep-green: #151b23;
            --safari-olive: #8B9556;
            --safari-sunset: #F4A261;
            --safari-gold: #C7A968;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Outfit', sans-serif;
        }

        .safari-gradient {
            background: linear-gradient(135deg, var(--safari-orange) 0%, var(--safari-terracotta) 100%);
        }

        .safari-gradient-green {
            background: linear-gradient(135deg, #2a3a45 0%, #151b23 100%);
        }

        .safari-text-gradient {
            background: linear-gradient(135deg, var(--safari-orange) 0%, var(--safari-terracotta) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .tropical-pattern {
            background-image:
                radial-gradient(circle at 20% 50%, rgba(232, 155, 60, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(44, 95, 78, 0.1) 0%, transparent 50%);
        }

        .leaf-decoration::before {
            content: '🌴';
            position: absolute;
            opacity: 0.05;
            font-size: 15rem;
            transform: rotate(-15deg);
            pointer-events: none;
        }
    </style>
</head>

<body class="antialiased text-gray-900 bg-gradient-to-br from-orange-50 via-amber-50 to-gray-50">
    <header class="backdrop-blur-md bg-white/90 shadow-lg sticky top-0 z-50 border-b-2 border-safari-gold/30">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-3xl font-black tracking-tight safari-text-gradient flex items-center gap-2">
                <img src="{{ asset('logo.jpeg') }}" alt="Blue Lagoon Logo" class="h-12 w-12 object-contain">
                Blue Lagoon
            </a>
            <div class="hidden md:flex space-x-8">
                <a href="/"
                    class="hover:text-safari-orange font-semibold transition-all hover:scale-105 relative group">
                    Home
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-safari-orange transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('tours.index') }}"
                    class="hover:text-safari-orange font-semibold transition-all hover:scale-105 relative group">
                    Tours
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-safari-orange transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('blog.index') }}"
                    class="hover:text-safari-orange font-semibold transition-all hover:scale-105 relative group">
                    Blog
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-safari-orange transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('contact') }}"
                    class="hover:text-safari-orange font-semibold transition-all hover:scale-105 relative group">
                    Contact
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-safari-orange transition-all group-hover:w-full"></span>
                </a>
            </div>
            <a href="https://wa.me/201000000000" target="_blank"
                class="safari-gradient text-white px-8 py-3 rounded-full hover:shadow-2xl transition-all font-bold shadow-lg flex items-center gap-2 transform hover:scale-105 hover:rotate-1">
                <span>Book Now</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                </svg>
            </a>
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="safari-gradient-green text-white py-16 mt-20 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 text-9xl">🦁</div>
            <div class="absolute bottom-10 right-10 text-9xl">🐘</div>
            <div class="absolute top-1/2 left-1/3 text-7xl">🌿</div>
        </div>

        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-12 relative z-10">
            <div>
                <h3 class="text-2xl font-black mb-4 text-safari-gold flex items-center gap-2">
                    <img src="{{ asset('logo.jpeg') }}" alt="Blue Lagoon Logo" class="h-8 w-8 object-contain">
                    Blue Lagoon
                </h3>
                <p class="text-gray-100 leading-relaxed">Discover the untamed beauty of Hurghada with our premium
                    safari tours, island adventures, and unforgettable experiences.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4 text-safari-gold text-lg">Quick Links</h4>
                <ul class="space-y-3 text-gray-100">
                    <li><a href="/"
                            class="hover:text-safari-sunset transition-colors hover:translate-x-1 inline-block">→
                            Home</a></li>
                    <li><a href="{{ route('tours.index') }}"
                            class="hover:text-safari-sunset transition-colors hover:translate-x-1 inline-block">→
                            Tours</a></li>
                    <li><a href="{{ route('blog.index') }}"
                            class="hover:text-safari-sunset transition-colors hover:translate-x-1 inline-block">→
                            Blog</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="hover:text-safari-sunset transition-colors hover:translate-x-1 inline-block">→
                            Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4 text-safari-gold text-lg">Contact Us</h4>
                <ul class="space-y-3 text-gray-100">
                    <li class="flex items-center gap-2">
                        <span>📍</span>
                        <span>Hurghada, Red Sea, Egypt</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span>📞</span>
                        <span>+20 100 000 0000</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span>✉️</span>
                        <span>info@bluelagon.com</span>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4 text-safari-gold text-lg">Follow Our Adventures</h4>
                <div class="flex space-x-4">
                    <a href="#"
                        class="bg-white/20 hover:bg-safari-sunset p-3 rounded-full transition-all hover:scale-110">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="bg-white/20 hover:bg-safari-sunset p-3 rounded-full transition-all hover:scale-110">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div
            class="container mx-auto px-4 mt-12 pt-8 border-t border-gray-400/30 text-center text-gray-200 relative z-10">
            <p class="flex items-center justify-center gap-2">
                &copy; {{ date('Y') }} Blue Lagoon Tours. All rights reserved.
                <span class="text-safari-gold">•</span>
                Crafted with ❤️ for Adventure Seekers
            </p>
        </div>
    </footer>
</body>

</html>