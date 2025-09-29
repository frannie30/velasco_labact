<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between py-6 px-4 bg-gradient-to-r from-pink-100 via-white to-pink-200 rounded-b-3xl shadow-lg">
            <h2 class="font-extrabold text-4xl text-pink-700 tracking-tight drop-shadow-lg">
                {{ __('Dashboard') }}
            </h2>
            <span class="text-pink-500 font-semibold text-lg hidden md:block">Discover Filipino Provinces & Dishes</span>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 border border-green-300 text-green-800 font-semibold shadow">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 border border-red-300 text-red-800 font-semibold shadow">
            {{ session('error') }}
        </div>
    @endif

    <div class="py-12 bg-gradient-to-br from-pink-50 via-white to-pink-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-white/90 backdrop-blur-lg shadow-2xl sm:rounded-3xl p-12 border border-pink-200 mb-8 flex flex-col items-center">
                <div class="w-full mb-6">
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80"
                         alt="Philippines"
                         class="w-full h-64 md:h-80 object-cover rounded-2xl shadow-lg border-4 border-pink-300" />
                </div>
                </br>
                <h3 class="text-6xl font-extrabold mb-4 text-pink-700 text-center drop-shadow-lg">
                    Explore Philippine Provinces & Their Dishes
                </h3>
                <p class="text-lg text-pink-600 text-center mb-6 max-w-2xl">
                    Search for a province or filter by region to discover unique Filipino dishes and culinary traditions.
                </p>
            </div>
            <!-- Search & Filter (now above Province Grid) -->
            <div class="mb-10 flex flex-col md:flex-row items-center justify-center gap-4 md:gap-8">
                <form method="GET" action="{{ route('dashboard') }}" class="flex flex-1 items-center bg-white rounded-2xl shadow-lg px-4 py-3 max-w-xl w-full">
                    <div class="relative flex-grow">
                        <input 
                            type="text" 
                            name="search"
                            value="{{ $search ?? '' }}"
                            class="w-full border-2 border-pink-300 rounded-xl px-5 py-4 text-lg bg-pink-50 text-pink-800 font-semibold focus:ring-2 focus:ring-pink-400 transition"
                            placeholder="Search province..."
                            aria-label="Search province"
                        >
                        <span class="absolute left-2 top-1/2 transform -translate-y-1/2 text-pink-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                            </svg>
                        </span>
                    </div>
                    <button type="submit" class="ml-3 bg-pink-600 text-white px-6 py-4 rounded-xl font-semibold shadow hover:bg-pink-700 transition focus:outline-none focus:ring-2 focus:ring-pink-400 text-lg flex items-center gap-2">
                        Search
                    </button>
                </form>
                <form method="GET" action="{{ route('region.filter') }}" class="flex items-center bg-white rounded-2xl shadow-lg px-4 py-3 max-w-xs w-full">
                    <span class="mr-2 text-pink-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 6a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" />
                        </svg>
                    </span>
                    <select name="region" class="border-2 border-pink-400 rounded-xl px-4 py-2 bg-pink-50 text-pink-800 font-semibold focus:ring-2 focus:ring-pink-400 transition text-base w-full" aria-label="Filter by Region">
                        <option value="">Filter by Region</option>
                        @foreach($regions as $regionOption)
                            @if($regionOption)
                                <option value="{{ $regionOption }}" {{ (isset($selectedRegion) && $selectedRegion == $regionOption) ? 'selected' : '' }}>
                                    {{ $regionOption }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <button type="submit" class="ml-2 bg-pink-600 text-white px-4 py-2 rounded-xl font-semibold shadow hover:bg-pink-700 transition focus:outline-none focus:ring-2 focus:ring-pink-400 flex items-center gap-1">
                        Filter
                    </button>
                </form>
            </div>
            <!-- Province Grid -->
            <div id="province-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
                @foreach($provinces as $province)
                    <form method="POST" action="{{ route('province') }}" class="h-full">
                        @csrf
                        <input type="hidden" name="province" value="{{ $province['name'] }}">
                        <button type="submit"
                            class="w-full h-full flex flex-col items-center justify-center border-2 border-pink-300 rounded-2xl shadow-lg p-8 bg-gradient-to-br from-pink-100 to-pink-200 transition hover:bg-pink-300 hover:shadow-2xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-pink-400 group"
                            style="min-height: 160px;">
                            <span class="text-pink-800 font-bold text-xl mb-2 group-hover:text-pink-900 transition text-center">{{ $province['name'] }}</span>
                            <span class="text-sm text-pink-600 font-medium group-hover:text-pink-800 transition text-center">View Dishes</span>
                            <span class="mt-4 opacity-0 group-hover:opacity-100 transition text-xs text-pink-500 text-center">Click to see local cuisine</span>
                        </button>
                    </form>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="mt-10 flex justify-center">
                {{ $provinces->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
