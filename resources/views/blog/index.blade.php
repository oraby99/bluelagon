<x-layout>
    <div class="bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold mb-4">Our Blog</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">Latest news, travel tips, and stories from the Red Sea.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                    <article class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-xl transition duration-300">
                        <a href="{{ route('blog.show', $post->slug) }}" class="block relative h-64 overflow-hidden">
                            <img src="{{ $post->getFirstMediaUrl('thumbnail') ?: 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&q=80' }}"
                                alt="{{ $post->title }}"
                                class="w-full h-full object-cover hover:scale-110 transition duration-700">
                        </a>
                        <div class="p-6">
                            <div class="text-sm text-blue-600 font-bold mb-2">
                                {{ $post->published_at->format('M d, Y') }}
                            </div>
                            <h2 class="text-xl font-bold mb-3 hover:text-blue-600 transition">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h2>
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($post->content), 150) }}
                            </p>
                            <a href="{{ route('blog.show', $post->slug) }}"
                                class="text-blue-600 font-bold hover:text-blue-700 inline-flex items-center gap-1">
                                Read More <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-layout>