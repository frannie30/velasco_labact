<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight">
            {{ __('Recipe Details') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-md shadow-2xl sm:rounded-2xl p-10 border border-pink-200">
                <div class="mb-8">
                    <a href="{{ route('province', ['province' => $province ?? null]) }}"
                       class="inline-flex items-center justify-center w-10 h-10 text-pink-600 hover:text-pink-800 font-bold rounded-full mb-2 text-2xl bg-pink-100 hover:bg-pink-200 shadow"
                       title="Back to Province">
                        &larr;
                    </a>
                    <h2 class="text-3xl font-extrabold mb-4 text-center text-pink-700">{{ $recipe->name }}</h2>
                    @if(!empty($recipe->description))
                        <p class="text-pink-800 text-center mb-6">{{ $recipe->description }}</p>
                    @endif
                    <div class="bg-pink-50 rounded-xl p-6 mb-6 border border-pink-100 shadow">
                        <h3 class="text-xl font-semibold mb-2 text-pink-800">Ingredients</h3>
                        <ul class="list-disc list-inside text-pink-900 mb-4 space-y-1">
                            @foreach($recipe->ingredients as $ingredient)
                                <li>{{ $ingredient }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="bg-pink-50 rounded-xl p-6 border border-pink-100 shadow">
                        <h3 class="text-xl font-semibold mb-2 text-pink-800">Steps</h3>
                        <ol class="list-decimal list-inside text-pink-900 space-y-1">
                            @foreach($recipe->recipe as $step)
                                <li>{{ $step }}</li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
