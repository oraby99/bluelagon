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
                <div class="w-full md:w-1/4">
                    <div class="bg-white p-8 rounded-3xl shadow-2xl sticky top-28 border-2 border-safari-gold/30">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="text-3xl">🧭</span>
                            <h3 class="font-black text-2xl text-gray-900">Categories</h3>
                        </div>
                        <div class="w-20 h-1 safari-gradient rounded-full mb-6"></div>
                        <ul class="space-y-3">
                            <li>
                                <a href="{{ route('tours.index') }}" class="block px-5 py-3.5 rounded-2xl transition-all font-bold {{ !request('category') ? 'safari-gradient text-white shadow-lg transform scale-105' : 'text-gray-700 hover:bg-orange-50 hover:text-safari-orange hover:translate-x-1' }}">
                                    <span class="flex items-center gap-3">
                                        <span class="text-xl">🌍</span>
                                        All Tours
                                    </span>
                                </a>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('tours.index', ['category' => $category->slug]) }}" 
                                       class="block px-5 py-3.5 rounded-2xl transition-all font-bold {{ request('category') == $category->slug ? 'safari-gradient text-white shadow-lg transform scale-105' : 'text-gray-700 hover:bg-orange-50 hover:text-safari-orange hover:translate-x-1' }}">
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
                <div class="w-full md:w-3/4">
                    @if($tours->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($tours as $tour)
                                <div class="bg-white rounded-3xl shadow-xl overflow-hidden group hover:shadow-2xl transition-all duration-500 border-2 border-safari-gold/20 transform hover:-translate-y-3">
                                    <div class="relative h-56 overflow-hidden">
                                        <img src="{{ $tour->getFirstMediaUrl('gallery') ?: 'https://via.placeholder.com/800x600' }}" 
                                             alt="{{ $tour->name }}" 
                                             class="w-full h-full object-cover group-hover:scale-125 transition-transform duration-700">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                        <div class="absolute top-4 right-4 safari-gradient backdrop-blur-sm px-4 py-2 rounded-full text-base font-black text-white shadow-lg border-2 border-white/50">
                                            ${{ $tour->price }}
                                        </div>
                                        <div class="absolute top-4 left-4 bg-safari-forest/90 px-3 py-1.5 rounded-full text-xs font-black text-white uppercase tracking-wider">
                                            {{ $tour->category->name }}
                                        </div>
                                    </div>
                                    <div class="p-7">
                                        <div class="flex items-center gap-5 text-sm text-gray-600 mb-4">
                                            <span class="flex items-center gap-2 bg-orange-50 px-3 py-1.5 rounded-xl font-semibold">
                                                <svg class="w-4 h-4 text-safari-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                {{ $tour->duration }}
                                            </span>
                                            <span class="flex items-center gap-2 bg-emerald-50 px-3 py-1.5 rounded-xl font-semibold">
                                                <svg class="w-4 h-4 text-safari-forest" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                {{ $tour->location }}
                                            </span>
                                        </div>
                                        <h3 class="text-xl font-black mb-3 line-clamp-1 group-hover:text-safari-orange transition-colors">{{ $tour->name }}</h3>
                                        <div class="text-gray-600 mb-6 line-clamp-2 text-sm leading-relaxed">
                                            {!! strip_tags($tour->description) !!}
                                        </div>
                                        <a href="{{ route('tours.show', $tour->slug) }}" 
                                           class="block w-full safari-gradient text-white text-center py-3.5 rounded-2xl font-black transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:scale-105">
                                            View Details →
                                        </a>
                                    </div>
                                </div>
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