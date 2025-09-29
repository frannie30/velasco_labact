<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 py-6 px-4 bg-gradient-to-r from-pink-100 via-white to-pink-200 rounded-b-3xl shadow-lg">
            <a href="{{ route('province', ['province' => $province ?? null]) }}"
               class="inline-flex items-center justify-center w-10 h-10 text-pink-700 font-bold rounded-full text-xl bg-pink-100 hover:bg-pink-200 shadow transition"
               title="Back to Province">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <span class="ml-2 text-pink-700 font-semibold text-lg">Back to Province</span>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-pink-50 via-white to-pink-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-lg shadow-2xl sm:rounded-3xl p-10 border border-pink-200">
                <div class="mb-8 flex flex-col items-center">
                    <span class="inline-flex items-center justify-center w-32 h-32 bg-pink-200 shadow-lg mb-4 rounded-2xl">
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=400&q=80"
                             alt="{{ $recipe->name }} image"
                             class="w-full h-full object-cover rounded-2xl" />
                    </span>
                    <h2 class="text-4xl font-extrabold mb-2 text-center text-pink-700">{{ $recipe->name }}</h2>
                    @if(!empty($recipe->description))
                        <p class="text-pink-800 text-center mb-6 text-lg">{{ $recipe->description }}</p>
                    @endif
                    <p class="text-base text-pink-600 text-center mb-2 max-w-xl">
                        Follow the steps below to cook <span class="font-semibold text-pink-800">{{ $recipe->name }}</span>.  
                        All ingredients and instructions are listed for you!
                    </p>
                </div>
                <div class="flex flex-col gap-8">
                    <!-- Collapsible Ingredients -->
                    <div x-data="{ open: true }" class="bg-pink-50 rounded-2xl p-6 border border-pink-100 shadow flex flex-col">
                        <button @click="open = !open" class="flex items-center gap-2 mb-3 text-2xl font-semibold text-pink-800 focus:outline-none w-full justify-between">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h8" />
                                </svg>
                                Ingredients
                            </span>
                            <svg :class="{'rotate-180': open}" class="h-5 w-5 text-pink-500 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <ul x-show="open" x-transition class="list-disc list-inside text-pink-900 space-y-2 text-base pl-2">
                            @foreach($recipe->ingredients as $ingredient)
                                <li>{{ $ingredient }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Collapsible Steps -->
                    <div x-data="{ open: true }" class="bg-pink-50 rounded-2xl p-6 border border-pink-100 shadow flex flex-col">
                        <button @click="open = !open" class="flex items-center gap-2 mb-3 text-2xl font-semibold text-pink-800 focus:outline-none w-full justify-between">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <rect x="4" y="4" width="16" height="16" rx="2" stroke="currentColor" stroke-width="2" fill="none"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 8h8M8 12h8M8 16h8" />
                                </svg>
                                Step-by-Step Instructions
                            </span>
                            <svg :class="{'rotate-180': open}" class="h-5 w-5 text-pink-500 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <ol x-show="open" x-transition class="list-decimal list-inside text-pink-900 space-y-3 text-base pl-2">
                            @foreach($recipe->recipe as $step)
                                <li>
                                    <span class="font-semibold text-pink-700">Step {{ $loop->iteration }}:</span>
                                    <span>{{ $step }}</span>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
