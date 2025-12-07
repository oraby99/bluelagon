<x-layout>
    <div class="bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-8 text-center">Explore Our Tours</h1>
            
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Sidebar -->
                <div class="w-full md:w-1/4">
                    <div class="bg-white p-6 rounded-xl shadow-sm sticky top-24">
                        <h3 class="font-bold text-xl mb-4">Categories</h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('tours.index') }}" class="block px-4 py-2 rounded-lg hover:bg-blue-50 {{ !request('category') ? 'bg-blue-50 text-blue-600 font-bold' : 'text-gray-600' }}">
                                    All Tours
                                </a>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('tours.index', ['category' => $category->slug]) }}" class="block px-4 py-2 rounded-lg hover:bg-blue-50 {{ request('category') == $category->slug ? 'bg-blue-50 text-blue-600 font-bold' : 'text-gray-600' }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Grid -->
                <div class="w-full md:w-3/4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($tours as $tour)
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden group hover:shadow-md transition">
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ $tour->getFirstMediaUrl('gallery') ?: 'https://via.placeholder.com/800x600' }}" alt="{{ $tour->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-sm font-bold text-blue-600">
                                        ${{ $tour->price }}
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ $tour->duration }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ $tour->location }}
                                        </span>
                                    </div>
                                    <h3 class="text-xl font-bold mb-2 line-clamp-1">{{ $tour->name }}</h3>
                                    <div class="text-gray-600 mb-4 line-clamp-2 text-sm">
                                        {!! strip_tags($tour->description) !!}
                                    </div>
                                    <a href="{{ route('tours.show', $tour->slug) }}" class="block w-full bg-blue-600 text-white text-center py-2 rounded-lg font-bold hover:bg-blue-700 transition">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-8">
                        {{ $tours->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>