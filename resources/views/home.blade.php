<x-layout>
    <!-- Hero Section -->
    <div class="relative h-[600px] overflow-hidden" x-data="{ activeSlide: 0, slides: {{ $sliders->count() }} }"
        x-init="setInterval(() => { activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1 }, 5000)">
        @foreach($sliders as $index => $slider)
            <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out" x-show="activeSlide === {{ $index }}"
                x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div class="absolute inset-0 bg-black/40 z-10"></div>
                <img src="{{ $slider->image_path }}" alt="{{ $slider->title }}"
                    class="absolute inset-0 w-full h-full object-cover">
                <div class="relative z-20 h-full flex items-center justify-center text-center px-4">
                    <div class="max-w-4xl mx-auto">
                        <h1
                            class="text-5xl md:text-7xl font-bold text-white mb-6 drop-shadow-lg tracking-tight leading-tight">
                            {{ $slider->title }}
                        </h1>
                        @if($slider->link)
                            <a href="{{ $slider->link }}"
                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-full text-lg font-bold transition shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                Explore Now
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Slider Indicators -->
        <div class="absolute bottom-8 left-0 right-0 z-30 flex justify-center gap-3">
            @foreach($sliders as $index => $slider)
                <button @click="activeSlide = {{ $index }}" class="w-3 h-3 rounded-full transition-all duration-300"
                    :class="activeSlide === {{ $index }} ? 'bg-white w-8' : 'bg-white/50 hover:bg-white/80'">
                </button>
            @endforeach
        </div>
    </div>

    <!-- Categories Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-gray-900">Our Adventures</h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full mb-4"></div>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Choose your perfect getaway from our diverse range of
                    activities.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($categories as $category)
                    <a href="{{ route('tours.index', ['category' => $category->slug]) }}"
                        class="group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer h-80 block">
                        <!-- Use a default image based on type since categories don't have images in DB yet -->
                        @php
                            $bgImage = match ($category->type) {
                                'island' => 'https://images.unsplash.com/photo-1590523277543-a94d2e4eb00b?w=800&q=80',
                                'safari' => 'https://images.unsplash.com/photo-1533090161767-e6ffed986c88?w=800&q=80',
                                'activity' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&q=80',
                                'city' => 'https://images.unsplash.com/photo-1590523277543-a94d2e4eb00b?w=800&q=80',
                                default => 'https://via.placeholder.com/800x600'
                            };
                        @endphp
                        <img src="{{ $bgImage }}" alt="{{ $category->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent flex flex-col justify-end p-8">
                            <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-blue-400 transition">
                                {{ $category->name }}
                            </h3>
                            <span
                                class="text-white/80 text-sm opacity-0 group-hover:opacity-100 transition transform translate-y-4 group-hover:translate-y-0 duration-300">View
                                Tours &rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Tours Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div class="max-w-2xl">
                    <h2 class="text-4xl font-bold mb-4 text-gray-900">Popular Tours</h2>
                    <div class="w-20 h-1 bg-blue-600 rounded-full mb-4"></div>
                    <p class="text-gray-600 text-lg">Don't miss out on our most booked experiences.</p>
                </div>
                <a href="{{ route('tours.index') }}"
                    class="hidden md:flex items-center gap-2 text-blue-600 font-bold hover:text-blue-700 transition mt-4 md:mt-0">
                    View All Tours <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredTours as $tour)
                    <div
                        class="bg-white rounded-2xl shadow-sm overflow-hidden group hover:shadow-xl transition duration-300 border border-gray-100">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ $tour->getFirstMediaUrl('gallery') ?: 'https://images.unsplash.com/photo-1540206395-688085723adb?w=800&q=80' }}"
                                alt="{{ $tour->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            <div
                                class="absolute top-4 right-4 bg-white/95 backdrop-blur px-4 py-1.5 rounded-full text-sm font-bold text-blue-600 shadow-sm">
                                ${{ $tour->price }}
                            </div>
                            <div
                                class="absolute top-4 left-4 bg-blue-600/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-white uppercase tracking-wider">
                                {{ $tour->category->name }}
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                                <span class="flex items-center gap-1.5 bg-gray-50 px-2 py-1 rounded-lg">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $tour->duration }}
                                </span>
                                <span class="flex items-center gap-1.5 bg-gray-50 px-2 py-1 rounded-lg">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $tour->location }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold mb-3 line-clamp-1 group-hover:text-blue-600 transition">
                                {{ $tour->name }}
                            </h3>
                            <p class="text-gray-600 mb-6 line-clamp-2 text-sm leading-relaxed">
                                {{ Str::limit(strip_tags($tour->description), 100) }}
                            </p>
                            <a href="{{ route('tours.show', $tour->slug) }}"
                                class="block w-full bg-gray-50 hover:bg-blue-600 text-gray-900 hover:text-white text-center py-3 rounded-xl font-bold transition duration-300 border border-gray-200 hover:border-blue-600">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center md:hidden">
                <a href="{{ route('tours.index') }}"
                    class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-full font-bold hover:bg-blue-700 transition">
                    View All Tours <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12">What Our Guests Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                    <div class="bg-gray-50 p-8 rounded-2xl relative">
                        <svg class="w-12 h-12 text-blue-100 absolute top-4 left-4" fill="currentColor" viewBox="0 0 32 32"
                            aria-hidden="true">
                            <path
                                d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                        </svg>
                        <div class="relative z-10 pt-6">
                            <div class="flex text-yellow-400 mb-4">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-gray-600 mb-6 italic">"{{ $testimonial->content }}"</p>
                            <h4 class="font-bold text-gray-900">{{ $testimonial->client_name }}</h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>