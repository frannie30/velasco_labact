<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight">
            {{ __('Dashboard') }}
        </h2>
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


    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-2xl sm:rounded-2xl p-10 border border-pink-200">
                <h3 class="text-2xl font-extrabold mb-8 mt-2 text-pink-700 text-center">
                    Choose a Province of the Philippines and see its dishes
                </h3>
                <div class="mb-8 flex justify-center">
                    <form method="GET" action="{{ route('dashboard') }}" class="w-full max-w-md">
                        <input 
                            type="text" 
                            name="search"
                            value="{{ $search ?? '' }}"
                            class="w-full border-2 border-pink-300 rounded-xl px-4 py-3 bg-pink-50 text-pink-800 font-semibold" 
                            placeholder="Search province..."
                            oninput="this.form.submit()"
                        >
                    </form>
                </div>
                <div id="province-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($provinces as $province)
                        <form method="POST" action="{{ route('province') }}">
                            @csrf
                            <input type="hidden" name="province" value="{{ $province['name'] }}">
                            <button type="submit" class="w-full border-2 border-pink-300 rounded-xl shadow-lg p-6 bg-pink-100 flex items-center 
                            justify-center transition hover:bg-pink-200 hover:scale-105 hover:shadow-2xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-pink-400">
                                <span class="text-pink-800 font-semibold text-lg">{{ $province['name'] }}</span>
                            </button>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
