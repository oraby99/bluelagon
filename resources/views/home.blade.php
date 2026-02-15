<x-layout>
    <!-- Hero Section -->
    <div class="relative h-screen min-h-[600px] overflow-hidden"
        x-data="{ activeSlide: 0, slides: {{ $sliders->count() }} }"
        x-init="setInterval(() => { activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1 }, 5000)">
        @foreach($sliders as $index => $slider)
            <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out" x-show="activeSlide === {{ $index }}"
                x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div class="absolute inset-0 bg-gradient-to-br from-black/60 via-[#151b23]/40 to-black/70 z-10">
                </div>
                <img src="{{ Storage::url($slider->image_path) }}" alt="{{ $slider->title }}"
                    class="absolute inset-0 w-full h-full object-cover scale-110 animate-slow-zoom">
                <div class="relative z-20 h-full flex items-center justify-center text-center px-4">
                    <div class="max-w-5xl mx-auto">
                        <div
                            class="inline-block mb-4 px-6 py-2 bg-safari-orange/20 backdrop-blur-sm border-2 border-safari-gold rounded-full">
                            <span class="text-safari-gold font-bold tracking-wider text-sm uppercase">✨ Premium Adventure
                                Experience</span>
                        </div>
                        <h1 class="text-4xl sm:text-5xl md:text-7xl lg:text-8xl font-black text-white mb-4 md:mb-6 drop-shadow-2xl tracking-tight leading-none break-words"
                            style="text-shadow: 0 4px 20px rgba(0,0,0,0.5), 0 0 40px rgba(232,155,60,0.3);">
                            {{ $slider->title }}
                        </h1>
                        @if($slider->link)
                            <a href="{{ $slider->link }}"
                                class="inline-block safari-gradient text-white px-12 py-5 rounded-full text-xl font-black transition-all shadow-2xl hover:shadow-safari-orange/50 transform hover:scale-110 hover:-translate-y-2 border-2 border-white/30">
                                <span class="flex items-center gap-3">
                                    🏝️ Explore Now
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Slider Indicators -->
        <div class="absolute bottom-12 left-0 right-0 z-30 flex justify-center gap-4">
            @foreach($sliders as $index => $slider)
                <button @click="activeSlide = {{ $index }}"
                    class="transition-all duration-300 border-2 border-white rounded-full"
                    :class="activeSlide === {{ $index }} ? 'bg-safari-orange w-16 h-4' : 'bg-white/50 hover:bg-white/80 w-4 h-4'">
                </button>
            @endforeach
        </div>
    </div>

    <!-- Categories Section -->
    <section
        class="py-24 bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 relative overflow-hidden tropical-pattern">
        <div class="absolute top-20 right-10 text-9xl opacity-5 bg-scrub">🦒</div>
        <div class="absolute bottom-20 left-10 text-9xl opacity-5 bg-scrub">🌺</div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-20">
                <div class="inline-block mb-4">
                    <span class="text-safari-orange text-6xl">🌍</span>
                </div>
                <h2 class="text-3xl md:text-5xl lg:text-6xl font-black mb-6 text-gray-900 break-words">Choose Your
                    Adventure</h2>
                <div class="w-32 h-2 safari-gradient mx-auto rounded-full mb-6 shadow-lg"></div>
                <p class="text-gray-700 max-w-3xl mx-auto text-xl font-medium leading-relaxed">
                    From pristine islands to thrilling safaris, discover experiences that will ignite your wanderlust.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 modern-card-grid">
                @foreach($categories as $category)
                    <a href="{{ route('tours.index', ['category' => $category->slug]) }}"
                        class="group relative overflow-hidden rounded-3xl shadow-2xl cursor-pointer h-96 block transform transition-all duration-500 hover:scale-105 hover:rotate-1 hover:shadow-safari-orange/30">
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
                            class="w-full h-full object-cover group-hover:scale-125 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black via-[#2a3a45]/50 to-transparent flex flex-col justify-end p-8 group-hover:from-[#151b23] transition-all duration-500">
                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                <div class="mb-3">
                                    <span
                                        class="inline-block px-4 py-1 bg-safari-orange rounded-full text-white text-xs font-bold tracking-wider">EXPLORE</span>
                                </div>
                                <h3
                                    class="text-3xl font-black text-white mb-3 group-hover:text-safari-gold transition-colors">
                                    {{ $category->name }}
                                </h3>
                                <div
                                    class="flex items-center gap-2 text-white/90 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-x-4 group-hover:translate-x-0">
                                    <span class="font-semibold">Discover Tours</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Tours Section -->
    <section class="py-24 bg-gradient-to-br from-stone-100 via-amber-50 to-orange-100 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-5">
            <div class="absolute top-10 left-20 text-8xl">🐘</div>
            <div class="absolute top-40 right-10 text-7xl">🦁</div>
            <div class="absolute bottom-20 left-1/3 text-9xl">🌴</div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                <div class="max-w-2xl">
                    <div class="inline-block mb-4">
                        <span
                            class="px-5 py-2 bg-safari-orange/20 border-2 border-safari-orange rounded-full text-safari-terracotta font-bold tracking-wider text-sm uppercase">⭐
                            Most Popular</span>
                    </div>
                    <h2
                        class="text-3xl sm:text-4xl md:text-6xl font-black mb-6 text-gray-900 leading-tight break-words">
                        Unforgettable Journeys</h2>
                    <div class="w-28 h-2 safari-gradient rounded-full mb-6"></div>
                    <p class="text-gray-700 text-xl font-medium leading-relaxed">Handpicked adventures that our
                        travelers can't stop raving about.</p>
                </div>
                <a href="{{ route('tours.index') }}"
                    class="hidden md:flex items-center gap-3 safari-gradient text-white px-8 py-4 rounded-full font-black hover:shadow-2xl transition-all transform hover:scale-105 mt-6 md:mt-0">
                    View All Tours
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 modern-card-grid">
                @foreach($featuredTours as $tour)
                    <a href="{{ route('tours.show', $tour->slug) }}" class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 h-full flex flex-col">
                        <!-- Image Container -->
                        <div class="relative aspect-[4/3] overflow-hidden">
                            <img src="{{ $tour->getFirstMediaUrl('gallery') ?: 'https://images.unsplash.com/photo-1540206395-688085723adb?w=800&q=80' }}"
                                alt="{{ $tour->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-60"></div>
                            
                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-full text-xs font-bold text-[#2a3a45] uppercase tracking-wider shadow-sm">
                                {{ $tour->category->name }}
                            </div>
                            
                            <!-- Price Badge -->
                            <div class="absolute top-4 right-4 bg-gray-900/90 backdrop-blur-sm text-white px-4 py-2 rounded-full font-bold shadow-lg border border-white/20 text-sm z-10">
                                ${{ $tour->price }}
                            </div>

                            <!-- Location Badge (Bottom Right) -->
                            <div class="absolute bottom-4 right-4 bg-black/60 backdrop-blur-md text-white px-3 py-1.5 rounded-lg flex items-center gap-1.5 text-xs font-medium border border-white/10 z-10">
                                <svg class="w-3.5 h-3.5 text-safari-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $tour->location }}
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex flex-col flex-grow">
                            <!-- Title -->
                            <h3 class="text-xl font-bold text-gray-900 mb-2 leading-tight group-hover:text-safari-orange transition-colors line-clamp-2">
                                {{ $tour->name }}
                            </h3>

                            <!-- Meta Row -->
                            <div class="flex items-center gap-3 text-sm text-gray-600 mb-3">
                                <div class="flex items-center gap-2 text-gray-500">
                                    <svg class="w-4 h-4 text-safari-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg> 
                                    <span class="font-medium">{{ $tour->duration }}</span>
                                </div>
                            </div>

                            <!-- Description -->
                            <p class="text-gray-500 text-sm line-clamp-2 mb-4 flex-grow">
                                {{ Str::limit(strip_tags($tour->description), 80) }}
                            </p>

                            <!-- Footer -->
                            <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                                <span class="text-[#2a3a45] font-bold text-sm group-hover:text-safari-orange transition-colors">View Details</span>
                                <div class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center group-hover:bg-safari-orange group-hover:text-white transition-all duration-300 transform group-hover:translate-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
        </div>

        <div class="mt-16 text-center md:hidden">
            <a href="{{ route('tours.index') }}"
                class="inline-flex items-center gap-3 safari-gradient text-white px-10 py-5 rounded-full font-black hover:shadow-2xl transition-all transform hover:scale-105">
                View All Tours
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                </svg>
            </a>
        </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-24 bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-20 left-10 text-9xl">⭐</div>
            <div class="absolute bottom-20 right-20 text-9xl">💬</div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-20">
                <div class="inline-block mb-4">
                    <span
                        class="px-5 py-2 bg-safari-orange/20 border-2 border-safari-orange rounded-full text-safari-terracotta font-bold tracking-wider text-sm uppercase">💬
                        Traveler Stories</span>
                </div>
                <h2 class="text-5xl md:text-6xl font-black mb-6 text-gray-900">What Adventurers Say</h2>
                <div class="w-32 h-2 safari-gradient mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($testimonials as $testimonial)
                    <div
                        class="bg-white p-10 rounded-3xl relative shadow-xl border-2 border-safari-gold/20 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div
                            class="absolute -top-6 left-10 safari-gradient w-16 h-16 rounded-2xl flex items-center justify-center text-3xl shadow-xl rotate-12 transform group-hover:rotate-0 transition-transform">
                            💭
                        </div>

                        <div class="pt-8">
                            <div class="flex text-safari-orange mb-6 gap-1">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-gray-700 mb-8 italic text-lg leading-relaxed font-medium">
                                "{{ $testimonial->content }}"</p>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 safari-gradient rounded-full flex items-center justify-center text-white text-2xl font-black shadow-lg">
                                    {{ substr($testimonial->client_name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-black text-gray-900 text-lg">{{ $testimonial->client_name }}</h4>
                                    <p class="text-safari-orange font-semibold text-sm">Verified Traveler</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>