<x-layout>
    <!-- Hero Gallery -->
    <div class="relative h-[500px] bg-gray-900">
        <img src="{{ $tour->getFirstMediaUrl('gallery') ?: 'https://via.placeholder.com/1920x600' }}" alt="{{ $tour->name }}" class="w-full h-full object-cover opacity-70">
        <div class="absolute inset-0 flex items-end pb-12">
            <div class="container mx-auto px-4">
                <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-bold mb-4 inline-block">{{ $tour->category->name }}</span>
                <h1 class="text-5xl font-bold text-white mb-4">{{ $tour->name }}</h1>
                <div class="flex items-center gap-6 text-white/90">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $tour->duration }}
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $tour->location }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Content -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-2xl p-8 shadow-sm mb-8">
                    <h2 class="text-2xl font-bold mb-6">Overview</h2>
                    <div class="prose max-w-none text-gray-600">
                        {!! $tour->description !!}
                    </div>
                </div>

                @if($tour->includes || $tour->excludes)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    @if($tour->includes)
                    <div class="bg-white rounded-2xl p-8 shadow-sm">
                        <h3 class="font-bold text-lg mb-4 text-green-600">Included</h3>
                        <ul class="space-y-2">
                            @foreach($tour->includes as $item)
                                <li class="flex items-start gap-2 text-gray-600">
                                    <svg class="w-5 h-5 text-green-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if($tour->excludes)
                    <div class="bg-white rounded-2xl p-8 shadow-sm">
                        <h3 class="font-bold text-lg mb-4 text-red-600">Excluded</h3>
                        <ul class="space-y-2">
                            @foreach($tour->excludes as $item)
                                <li class="flex items-start gap-2 text-gray-600">
                                    <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                @endif

                @if($tour->schedule)
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <h2 class="text-2xl font-bold mb-6">Tour Schedule</h2>
                    <div class="space-y-6">
                        @foreach($tour->schedule as $time => $activity)
                            <div class="flex gap-4">
                                <div class="w-24 font-bold text-blue-600 shrink-0">{{ $time }}</div>
                                <div class="text-gray-600">{{ $activity }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Booking Sidebar -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-2xl p-6 shadow-lg sticky top-24 border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-gray-500">Price per person</span>
                        <span class="text-3xl font-bold text-blue-600">${{ $tour->price }}</span>
                    </div>

                    <form x-data="{ 
                        phone: '', 
                        name: '', 
                        date: '', 
                        persons: 1,
                        pickup: '',
                        loading: false,
                        submit() {
                            this.loading = true;
                            fetch('{{ route('bookings.store') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    tour_id: {{ $tour->id }},
                                    user_name: this.name,
                                    user_phone: this.phone,
                                    booking_date: this.date,
                                    persons_count: this.persons,
                                    pickup_location: this.pickup
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    window.open(data.whatsapp_url, '_blank');
                                } else {
                                    alert('Something went wrong. Please check your input.');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Something went wrong. Please try again.');
                            })
                            .finally(() => {
                                this.loading = false;
                            });
                        }
                    }" @submit.prevent="submit" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input type="date" x-model="date" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Number of Persons</label>
                            <input type="number" x-model="persons" min="1" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                            <input type="text" x-model="name" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="tel" x-model="phone" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pickup Location</label>
                            <input type="text" x-model="pickup" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Hotel name or address">
                        </div>
                        
                        <button type="submit" :disabled="loading" class="w-full bg-green-500 text-white py-3 rounded-xl font-bold hover:bg-green-600 transition flex items-center justify-center gap-2 disabled:opacity-50">
                            <svg x-show="!loading" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <span x-text="loading ? 'Processing...' : 'Book via WhatsApp'"></span>
                        </button>
                        <p class="text-xs text-center text-gray-500 mt-2">No payment required now. Pay on arrival.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>