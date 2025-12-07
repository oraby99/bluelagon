<x-layout>
    <div class="bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="bg-blue-600 p-12 text-white">
                        <h2 class="text-3xl font-bold mb-6">Get in Touch</h2>
                        <p class="text-blue-100 mb-8">Have questions about our tours? Want to plan a custom trip? We're
                            here to help!</p>

                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <svg class="w-6 h-6 mt-1 text-blue-200" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <h3 class="font-bold mb-1">Visit Us</h3>
                                    <p class="text-blue-100">Sheraton Road, Hurghada<br>Red Sea, Egypt</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <svg class="w-6 h-6 mt-1 text-blue-200" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <div>
                                    <h3 class="font-bold mb-1">Call Us</h3>
                                    <p class="text-blue-100">+20 100 000 0000</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <svg class="w-6 h-6 mt-1 text-blue-200" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <div>
                                    <h3 class="font-bold mb-1">Email Us</h3>
                                    <p class="text-blue-100">info@bluelagon.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-12">
                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Name</label>
                                <input type="text" id="name" name="name"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                                    placeholder="Your Name">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" name="email"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                                    placeholder="your@email.com">
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-bold text-gray-700 mb-2">Message</label>
                                <textarea id="message" name="message" rows="4"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                                    placeholder="How can we help you?"></textarea>
                            </div>

                            <button type="button"
                                onclick="alert('Thank you for your message! We will contact you soon.')"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl transition shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>