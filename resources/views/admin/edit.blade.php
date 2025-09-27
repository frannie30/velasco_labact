<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight">
            {{ __('Edit Recipe') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-md shadow-2xl sm:rounded-2xl p-10 border border-pink-200">
                <h2 class="text-3xl font-extrabold mb-8 text-center text-pink-700">Edit Recipe</h2>
<form method="POST" action="{{ route('recipes.update', $recipe->id) }}">
    @csrf
    @method('PUT')

    <div>
        <label class="block text-pink-800 font-semibold mb-2">Province</label>
        <span class="inline-block bg-pink-200 text-pink-800 px-4 py-2 rounded-full font-semibold">
            {{ $recipe->province->name ?? 'N/A' }}
        </span>
        <input type="hidden" name="province_id" value="{{ $recipe->province_id }}">
    </div>

    <div>
        <label class="block text-pink-800 font-semibold mb-2">Dish Name</label>
        <span class="inline-block bg-pink-100 text-pink-800 px-4 py-2 rounded-full font-semibold">
            {{ $recipe->name }}
        </span>
        <input type="hidden" name="name" value="{{ $recipe->name }}">
    </div>

    <div>
        <label for="description" class="block text-pink-800 font-semibold mb-2">Dish Description</label>
        <textarea id="description" name="description" rows="4" class="w-full border-2 border-pink-200 rounded-xl px-4 py-3 bg-pink-50 focus:border-pink-400 focus:ring-2 focus:ring-pink-200 transition">{{ old('description', $recipe->description) }}</textarea>
    </div>

    <div x-data="{ ingredients: {{ json_encode(old('ingredients', $recipe->ingredients ?? [])) }}, newIngredient: '' }" class="mb-4">
        <label class="block text-pink-800 font-semibold mb-2">Ingredients</label>

        <div class="flex gap-2 mb-2">
            <input type="text" x-model="newIngredient"
                   class="w-full border-2 border-pink-200 rounded-xl px-4 py-2 bg-pink-50"
                   placeholder="Type ingredient and click Add">
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
    </div>

    <div x-data="{ steps: {{ json_encode(old('recipe', $recipe->recipe ?? [])) }}, newStep: '' }" class="mb-4">
        <label class="block text-pink-800 font-semibold mb-2">Recipe Steps</label>

        <div class="flex gap-2 mb-2">
            <input type="text" x-model="newStep"
                   class="w-full border-2 border-pink-200 rounded-xl px-4 py-2 bg-pink-50"
                   placeholder="Type step and click Add">
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
    </div>


    <div class="flex justify-center gap-4">
        <button type="submit" class="bg-pink-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-pink-700 hover:scale-105 transition focus:outline-none focus:ring-2 focus:ring-pink-400">
            Update Recipe
        </button>
        <a href="{{ route('index.index') }}" class="bg-gray-300 text-pink-800 px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-gray-400 hover:scale-105 transition focus:outline-none focus:ring-2 focus:ring-pink-400 text-center">
            Cancel
        </a>
    </div>
</form>
            </div>
        </div>
    </div>
</x-app-layout>