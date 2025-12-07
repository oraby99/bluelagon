<x-layout>
    <div class="bg-white py-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="mb-8 text-center">
                <div class="text-blue-600 font-bold mb-4">{{ $post->published_at->format('F d, Y') }}</div>
                <h1 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900">{{ $post->title }}</h1>
            </div>

            <div class="rounded-3xl overflow-hidden shadow-lg mb-12 h-[400px] md:h-[500px]">
                <img src="{{ $post->getFirstMediaUrl('thumbnail') ?: 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=1200&q=80' }}"
                    alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>

            <div class="prose prose-lg max-w-none text-gray-700">
                {!! $post->content !!}
            </div>

            <div class="mt-12 pt-8 border-t border-gray-200">
                <a href="{{ route('blog.index') }}"
                    class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 font-bold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Blog
                </a>
            </div>
        </div>
    </div>
</x-layout>