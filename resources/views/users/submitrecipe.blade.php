<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight">
            {{ __('Submit Recipe') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-md shadow-2xl sm:rounded-2xl p-10 border border-pink-200">
                <h2 class="text-3xl font-extrabold mb-8 text-center text-pink-700">Add New Recipe</h2>
<form method="POST" action="{{ route('users.store') }}">
    @csrf

    <div>
        <label for="province" class="block text-pink-800 font-semibold mb-2">Province</label>
        <input list="province-list" id="province" name="province" value="{{ old('province') }}" class="w-full border-2 border-pink-200 rounded-xl px-4 py-3 bg-pink-50" placeholder="Type or select a province">
        <datalist id="province-list">
            @foreach($provinces as $province)
                <option value="{{ $province['name'] }}">
            @endforeach
        </datalist>
    </div>

    <div>
        <label for="name" class="block text-pink-800 font-semibold mb-2">Dish Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full border-2 border-pink-200 rounded-xl px-4 py-3 bg-pink-50" placeholder="e.g. Kare-Kare">
    </div>

    <div>
        <label for="description" class="block text-pink-800 font-semibold mb-2">Dish Description</label>
        <textarea id="description" name="description" rows="4" class="w-full border-2 border-pink-200 rounded-xl px-4 py-3 bg-pink-50" placeholder="List the ingredients...">{{ old('description') }}</textarea>
    </div>

    <div>
        <label class="block text-pink-800 font-semibold mb-2">Ingredients</label>
        <div id="ingredients-list"></div>
        <div class="flex gap-2 mb-2">
            <input type="text" id="ingredient-input" class="w-full border-2 border-pink-200 rounded-xl px-4 py-2 bg-pink-50" placeholder="Add ingredient">
            <button type="button" onclick="addIngredient()" class="bg-pink-600 text-white px-4 py-2 rounded-xl font-bold hover:bg-pink-700">Add</button>
        </div>
        <input type="hidden" name="ingredients" id="ingredients-hidden">
        <input type="hidden" id="old-ingredients" value="{{ old('ingredients') }}">
    </div>

    <div>
        <label class="block text-pink-800 font-semibold mb-2">Recipe Steps</label>
        <div id="steps-list"></div>
        <div class="flex gap-2 mb-2">
            <input type="text" id="step-input" class="w-full border-2 border-pink-200 rounded-xl px-4 py-2 bg-pink-50" placeholder="Add step">
            <button type="button" onclick="addStep()" class="bg-pink-600 text-white px-4 py-2 rounded-xl font-bold hover:bg-pink-700">Add</button>
        </div>
        <input type="hidden" name="recipe" id="steps-hidden">
        <input type="hidden" id="old-steps" value="{{ old('recipe') }}">
    </div>

    <div class="flex justify-center">
        <button type="submit" class="bg-pink-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-pink-700 hover:scale-105 transition">
            Submit
        </button>
    </div>
</form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    let ingredients = [];
    let steps = [];

    function addIngredient() {
        const input = document.getElementById('ingredient-input');
        if (input.value.trim() === '') return;
        ingredients.push(input.value.trim());
        input.value = '';
        updateIngredients();
    }

    function removeIngredient(index) {
        ingredients.splice(index, 1);
        updateIngredients();
    }

    function updateIngredients() {
        const list = document.getElementById('ingredients-list');
        list.innerHTML = ingredients.map((ing, i) =>
            `<div class="flex items-center gap-2 mb-1">
                <span>${ing}</span>
                <button type="button" onclick="removeIngredient(${i})" class="text-red-500 font-bold">Remove</button>
            </div>`
        ).join('');
        document.getElementById('ingredients-hidden').value = ingredients.join(', ');
    }

    function addStep() {
        const input = document.getElementById('step-input');
        if (input.value.trim() === '') return;
        steps.push(input.value.trim());
        input.value = '';
        updateSteps();
    }

    function removeStep(index) {
        steps.splice(index, 1);
        updateSteps();
    }

    function updateSteps() {
        const list = document.getElementById('steps-list');
        list.innerHTML = steps.map((step, i) =>
            `<div class="flex items-center gap-2 mb-1">
                <span>Step ${i+1}: ${step}</span>
                <button type="button" onclick="removeStep(${i})" class="text-red-500 font-bold">Remove</button>
            </div>`
        ).join('');
        document.getElementById('steps-hidden').value = steps.join('\n');
    }

    const oldIngredients = document.getElementById('old-ingredients').value;
    if (oldIngredients) {
        ingredients = oldIngredients.split(',').map(i => i.trim()).filter(i => i);
        updateIngredients();
    }

    const oldSteps = document.getElementById('old-steps').value;
    if (oldSteps) {
        steps = oldSteps.split('\n').map(s => s.trim()).filter(s => s);
        updateSteps();
    }
</script>