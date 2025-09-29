<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 py-6 px-4 bg-gradient-to-r from-pink-100 via-white to-pink-200 rounded-b-3xl shadow-lg">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center justify-center w-12 h-12 text-pink-700 font-bold rounded-full text-2xl bg-pink-100 hover:bg-pink-200 shadow transition"
               title="Back to Dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-extrabold text-5xl text-pink-700 tracking-tight drop-shadow-lg ml-2">
                {{ $province }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-pink-50 via-white to-pink-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Province Hero -->
            <div class="bg-white/90 backdrop-blur-lg shadow-2xl sm:rounded-3xl p-8 border border-pink-200 mb-8 flex flex-col items-center">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=600&q=80"
                     alt="{{ $province }} image"
                     class="w-full max-w-xl h-64 object-cover shadow-lg mb-4 bg-pink-200 rounded-2xl" />
                <h2 class="text-5xl font-extrabold mb-2 text-center text-pink-700">{{ $province }}</h2>
                <p class="text-base text-pink-600 text-center mb-4 max-w-xl">
                    Here are the most popular dishes from <span class="font-semibold text-pink-800">{{ $province }}</span>.  
                    Click on a dish to see its recipe!
                </p>
                <h3 class="text-xl font-semibold mb-4 mt-2 text-pink-800">Famous Dishes</h3>
            </div>
            <!-- Dishes Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 w-full">
                @forelse($recipes as $recipe)
                    <form method="GET" action="{{ route('recipe') }}" class="group bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center hover:bg-pink-100 hover:scale-105 hover:shadow-xl cursor-pointer w-full border border-pink-200 transition">
                        <input type="hidden" name="province" value="{{ $province }}">
                        <input type="hidden" name="recipe" value="{{ $recipe->name }}">
                        <button type="submit" class="flex flex-col items-center w-full bg-transparent border-0 p-0 m-0 cursor-pointer">
                            <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-pink-100 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <span class="text-lg font-bold mb-1 text-pink-800">{{ $recipe->name }}</span>
                            <span class="text-sm text-pink-700 text-center mb-2">{{ $recipe->description }}</span>
                            <span class="mt-2 text-xs text-pink-500 group-hover:opacity-100 opacity-80 transition">View Recipe</span>
                        </button>
                    </form>
                @empty
                    <div class="col-span-2 text-center text-pink-600 bg-white rounded-xl shadow p-6 border border-pink-200">
                        No approved recipes found for this province.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
