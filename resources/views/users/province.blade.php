<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight">
            {{ __('Province') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-2xl sm:rounded-2xl p-10 border border-pink-200 flex flex-col items-center">
                <a href="{{ route('dashboard') }}"
                   class="self-start inline-flex items-center justify-center w-10 h-10 text-pink-600 hover:text-pink-800 font-bold rounded-full mb-2 text-2xl bg-pink-100 hover:bg-pink-200 shadow"
                   title="Back to Dashboard">
                    &larr;
                </a>
                <h2 class="text-3xl font-extrabold mb-6 text-center text-pink-700">{{ $province }}</h2>
                <h3 class="text-xl font-semibold mb-4 mt-2 text-pink-800">Famous Dishes</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 w-full">
                    @forelse($recipes as $recipe)
                        <form method="GET" action="{{ route('recipe') }}" class="bg-pink-100 rounded-xl shadow p-6 flex flex-col items-center hover:bg-pink-200 hover:scale-105 hover:shadow-lg cursor-pointer w-full border border-pink-200">
                            <input type="hidden" name="province" value="{{ $province }}">
                            <input type="hidden" name="dish" value="{{ $recipe->name }}">
                            <button type="submit" class="flex flex-col items-center w-full bg-transparent border-0 p-0 m-0 cursor-pointer">
                                <span class="text-lg font-bold mb-2 text-pink-800">{{ $recipe->name }}</span>
                                <span class="text-pink-700">{{ $recipe->description }}</span>
                            </button>
                        </form>
                    @empty
                        <div class="col-span-2 text-center text-pink-600">No approved recipes found for this province.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
