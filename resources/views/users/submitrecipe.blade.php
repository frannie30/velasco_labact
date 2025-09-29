<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl text-pink-700 leading-tight text-center py-4">
            {{ __('Submit a New Recipe') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-pink-50 via-white to-pink-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-lg shadow-2xl sm:rounded-2xl p-10 border border-pink-200">
                <h2 class="text-3xl font-extrabold mb-8 text-center text-pink-700">Add Your Recipe</h2>
                <p class="text-pink-600 text-center mb-8">Fill out the form below. Fields marked with <span class="text-pink-700 font-bold">*</span> are required.</p>
                <form method="POST" action="{{ route('users.store') }}"
                      onsubmit="return confirm('Are you sure you want to submit this recipe?');">
                    @csrf

                    <!-- Province -->
                    <div class="mb-6">
                        <label for="province" class="block text-pink-800 font-semibold mb-2">
                            <span class="text-pink-700 font-bold">*</span> Province
                        </label>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l2 7h7l-5.5 4.5L17 21l-5-3.5L7 21l1.5-7.5L3 9h7z" />
                            </svg>
                            <input list="province-list" id="province" name="province" value="{{ old('province') }}"
                                   class="w-full border-2 border-pink-200 rounded-xl px-4 py-3 bg-pink-50 focus:ring-2 focus:ring-pink-400"
                                   placeholder="Type or select a province">
                        </div>
                        <datalist id="province-list">
                            @foreach($provinces as $province)
                                <option value="{{ $province['name'] }}">
                            @endforeach
                        </datalist>
                        @error('province')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dish Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-pink-800 font-semibold mb-2">
                            <span class="text-pink-700 font-bold">*</span> Dish Name
                        </label>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                   class="w-full border-2 border-pink-200 rounded-xl px-4 py-3 bg-pink-50 focus:ring-2 focus:ring-pink-400"
                                   placeholder="e.g. Kare-Kare">
                        </div>
                        @error('name')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dish Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-pink-800 font-semibold mb-2">
                            Dish Description
                        </label>
                        <textarea id="description" name="description" rows="3"
                                  class="w-full border-2 border-pink-200 rounded-xl px-4 py-3 bg-pink-50 focus:ring-2 focus:ring-pink-400"
                                  placeholder="Describe the dish...">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Ingredients -->
                    <div x-data="{
                        ingredients: {{ json_encode(old('ingredients', [])) }},
                        newIngredient: '{{ old('newIngredient') }}'
                    }" class="mb-8">
                        <label class="block text-pink-800 font-semibold mb-2">
                            <span class="text-pink-700 font-bold">*</span> Ingredients
                        </label>
                        <div class="flex gap-2 mb-2">
                            <input type="text"
                                   name="newIngredient"
                                   x-model="newIngredient"
                                   class="w-full border-2 border-pink-200 rounded-xl px-4 py-2 bg-pink-50 focus:ring-2 focus:ring-pink-400"
                                   placeholder="Type ingredient and click Add"
                                   value="{{ old('newIngredient') }}">
                            <button type="button"
                                    class="bg-pink-600 text-white px-4 py-2 rounded-xl font-bold hover:bg-pink-700"
                                    @click="if(newIngredient.trim() !== '') { ingredients.push(newIngredient.trim()); newIngredient=''; }">
                                Add
                            </button>
                        </div>
                        <template x-for="(ing, index) in ingredients" :key="index">
                            <div class="flex items-center gap-2 mb-1">
                                <input type="hidden" :name="'ingredients['+index+']'" :value="ing">
                                <span class="flex-1" x-text="ing"></span>
                                <button type="button" class="text-red-500 font-bold"
                                        @click="ingredients.splice(index,1)">
                                    Remove
                                </button>
                            </div>
                        </template>
                        @error('ingredients')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                        @foreach ($errors->get('ingredients.*') as $index => $messages)
                            @foreach ($messages as $message)
                                <div class="text-red-500 text-sm">Ingredient {{ $index+1 }}: {{ $message }}</div>
                            @endforeach
                        @endforeach
                    </div>

                    <!-- Recipe Steps -->
                    <div x-data="{
                        steps: {{ json_encode(old('recipe', [])) }},
                        newStep: '{{ old('newStep') }}'
                    }" class="mb-8">
                        <label class="block text-pink-800 font-semibold mb-2">
                            <span class="text-pink-700 font-bold">*</span> Recipe Steps
                        </label>
                        <div class="flex gap-2 mb-2">
                            <input type="text"
                                   name="newStep"
                                   x-model="newStep"
                                   value="{{ old('newStep') }}"
                                   class="w-full border-2 border-pink-200 rounded-xl px-4 py-2 bg-pink-50 focus:ring-2 focus:ring-pink-400"
                                   placeholder="Type a step and click Add">
                            <button type="button"
                                    class="bg-pink-600 text-white px-4 py-2 rounded-xl font-bold hover:bg-pink-700"
                                    @click="if(newStep.trim() !== '') { steps.push(newStep.trim()); newStep=''; }">
                                Add
                            </button>
                        </div>
                        <template x-for="(step, index) in steps" :key="index">
                            <div class="flex items-center gap-2 mb-1">
                                <input type="hidden" :name="'recipe['+index+']'" :value="step">
                                <span class="flex-1">Step <span x-text="index+1"></span>: <span x-text="step"></span></span>
                                <button type="button" class="text-red-500 font-bold"
                                        @click="steps.splice(index,1)">
                                    Remove
                                </button>
                            </div>
                        </template>
                        @error('recipe')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                        @foreach ($errors->get('recipe.*') as $index => $messages)
                            @foreach ($messages as $message)
                                <div class="text-red-500 text-sm">Step {{ $index+1 }}: {{ $message }}</div>
                            @endforeach
                        @endforeach
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-center gap-4 mt-8">
                        <button type="submit" class="bg-pink-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-pink-700 hover:scale-105 transition">
                            Submit
                        </button>
                        <a href="{{ route('index.index') }}"
                           class="bg-gray-300 text-pink-800 px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-gray-400 hover:scale-105 transition focus:outline-none focus:ring-2 focus:ring-pink-400 text-center"
                           onclick="return confirm('Are you sure you want to cancel? Any unsaved changes will be lost.');">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

