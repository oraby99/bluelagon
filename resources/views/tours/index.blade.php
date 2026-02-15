<x-layout>
    <div class="bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 py-16 relative overflow-hidden">
        <div class="absolute top-10 right-20 text-9xl opacity-5">🦒</div>
        <div class="absolute bottom-10 left-20 text-9xl opacity-5">🌺</div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12">
                <div class="inline-block mb-4">
                    <span class="px-5 py-2 bg-safari-orange/20 border-2 border-safari-orange rounded-full text-safari-terracotta font-bold tracking-wider text-sm uppercase">🗺️ Discover Adventures</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-black mb-6 text-gray-900">Explore Our Tours</h1>
                <div class="w-32 h-2 safari-gradient mx-auto rounded-full"></div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-10">
                <!-- Sidebar -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white p-8 rounded-3xl shadow-2xl sticky top-28 border-2 border-safari-gold/30">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="text-3xl">🧭</span>
                            <h3 class="font-black text-2xl text-gray-900">Categories</h3>
                        </div>
                        <div class="w-20 h-1 safari-gradient rounded-full mb-6"></div>
                        <ul class="space-y-3">
                            <li>
                                <a href="{{ route('tours.index') }}" class="block px-5 py-3.5 rounded-2xl transition-all font-bold {{ !request('category') ? 'bg-[#E89B3C] text-white shadow-lg transform scale-105' : 'text-gray-700 hover:bg-orange-50 hover:text-[#E89B3C] hover:translate-x-1' }}">
                                    <span class="flex items-center gap-3">
                                        <span class="text-xl">🌍</span>
                                        All Tours
                                    </span>
                                </a>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('tours.index', ['category' => $category->slug]) }}" 
                                       class="block px-5 py-3.5 rounded-2xl transition-all font-bold {{ request('category') == $category->slug ? 'bg-[#E89B3C] text-white shadow-lg transform scale-105' : 'text-gray-700 hover:bg-orange-50 hover:text-[#E89B3C] hover:translate-x-1' }}">
                                        <span class="flex items-center gap-3">
                                            <span class="text-xl">
                                                @switch($category->type)
                                                    @case('island') 🏝️ @break
                                                    @case('safari') 🦁 @break
                                                    @case('activity') 🎯 @break
                                                    @case('city') 🏛️ @break
                                                    @default 🌴
                                                @endswitch
                                            </span>
                                            {{ $category->name }}
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Grid -->
                <div class="w-full lg:w-3/4">
                    @if($tours->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 modern-card-grid">
                            @foreach($tours as $tour)
                                <a href="{{ route('tours.show', $tour->slug) }}" class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 h-full flex flex-col">
                                    <!-- Image Container -->
                                    <div class="relative aspect-[4/3] overflow-hidden">
                                        <img src="{{ $tour->getFirstMediaUrl('gallery') ?: 'https://via.placeholder.com/800x600' }}" 
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
                                        <div class="text-gray-500 text-sm line-clamp-2 mb-4 flex-grow">
                                            {!! strip_tags($tour->description) !!}
                                        </div>

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
                        
                        <div class="mt-12">
                            {{ $tours->links() }}
                        </div>
                    @else
                        <div class="bg-white rounded-3xl shadow-xl p-16 text-center border-2 border-safari-gold/20">
                            <span class="text-8xl mb-6 block">🔍</span>
                            <h3 class="text-3xl font-black text-gray-900 mb-4">No Tours Found</h3>
                            <p class="text-gray-600 text-lg mb-8">We couldn't find any adventures in this category yet.</p>
                            <a href="{{ route('tours.index') }}" class="inline-block safari-gradient text-white px-8 py-4 rounded-full font-black hover:shadow-2xl transition-all transform hover:scale-105">
                                View All Tours
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>