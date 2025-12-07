<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Blue Lagoon Tours' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-50">
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-600">Blue Lagoon</a>
            <div class="hidden md:flex space-x-6">
                <a href="/" class="hover:text-blue-600 font-medium">Home</a>
                <a href="{{ route('tours.index') }}" class="hover:text-blue-600 font-medium">Tours</a>
                <a href="{{ route('blog.index') }}" class="hover:text-blue-600 font-medium">Blog</a>
                <a href="{{ route('contact') }}" class="hover:text-blue-600 font-medium">Contact</a>
            </div>
            <a href="https://wa.me/201000000000" target="_blank"
                class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition font-bold shadow-lg flex items-center gap-2">
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

    <footer class="bg-gray-900 text-white py-12 mt-12">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4 text-blue-400">Blue Lagoon</h3>
                <p class="text-gray-400">Discover the beauty of Hurghada with our premium tours and activities.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="/" class="hover:text-white">Home</a></li>
                    <li><a href="{{ route('tours.index') }}" class="hover:text-white">Tours</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-white">Blog</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Contact Us</h4>
                <ul class="space-y-2 text-gray-400">
                    <li>Hurghada, Red Sea, Egypt</li>
                    <li>+20 100 000 0000</li>
                    <li>info@bluelagon.com</li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Follow Us</h4>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white">Facebook</a>
                    <a href="#" class="text-gray-400 hover:text-white">Instagram</a>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-4 mt-8 pt-8 border-t border-gray-800 text-center text-gray-500">
            &copy; {{ date('Y') }} Blue Lagoon Tours. All rights reserved.
        </div>
    </footer>
</body>

</html>