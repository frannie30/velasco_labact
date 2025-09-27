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
    @error('province')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div>
        <label for="name" class="block text-pink-800 font-semibold mb-2">Dish Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full border-2 border-pink-200 rounded-xl px-4 py-3 bg-pink-50" placeholder="e.g. Kare-Kare">
    </div>

     @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div>
        <label for="description" class="block text-pink-800 font-semibold mb-2">Dish Description</label>
        <textarea id="description" name="description" rows="4" class="w-full border-2 border-pink-200 rounded-xl px-4 py-3 bg-pink-50" placeholder="List the ingredients...">{{ old('description') }}</textarea>
    </div>

<div 
    x-data="{
        ingredients: {{ json_encode(old('ingredients', [])) }},
        newIngredient: '{{ old('newIngredient') }}'
    }" 
    class="mb-4"
>
    <label class="block text-pink-800 font-semibold mb-2">Ingredients</label>

    <!-- Input and Add button -->
    <div class="flex gap-2 mb-2">
        <input type="text" 
               name="newIngredient"
               x-model="newIngredient"
               class="w-full border-2 border-pink-200 rounded-xl px-4 py-2 bg-pink-50"
               placeholder="Type ingredient and click Add"
               value="{{ old('newIngredient') }}">
        <button type="button"
                class="bg-pink-600 text-white px-4 py-2 rounded-xl font-bold hover:bg-pink-700"
                @click="if(newIngredient.trim() !== '') { 
                            ingredients.push(newIngredient.trim()); 
                            newIngredient=''; 
                         }">
            Add
        </button>
    </div>



    <!-- Ingredient list with remove buttons -->
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

    <!-- Error messages -->
    @error('ingredients')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror

    @foreach ($errors->get('ingredients.*') as $index => $messages)
        @foreach ($messages as $message)
            <div class="alert alert-danger">Ingredient {{ $index+1 }}: {{ $message }}</div>
        @endforeach
    @endforeach
</div>



  <div 
    x-data="{
        steps: {{ json_encode(old('recipe', [])) }},
        newStep: '{{ old('newStep') }}'
    }" 
    class="mb-4"
>
    <label class="block text-pink-800 font-semibold mb-2">Recipe Steps</label>

    <!-- Input and Add button -->
    <div class="flex gap-2 mb-2">
        <input type="text" 
               name="newStep"
               x-model="newStep"
               value="{{ old('newStep') }}"
               class="w-full border-2 border-pink-200 rounded-xl px-4 py-2 bg-pink-50"
               placeholder="Type a step and click Add">
        <button type="button"
                class="bg-pink-600 text-white px-4 py-2 rounded-xl font-bold hover:bg-pink-700"
                @click="if(newStep.trim() !== '') { 
                            steps.push(newStep.trim()); 
                            newStep=''; 
                         }">
            Add
        </button>
    </div>

    <!-- Steps list with remove buttons -->
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

    <!-- Error messages -->
    @error('recipe')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror

    @foreach ($errors->get('recipe.*') as $index => $messages)
        @foreach ($messages as $message)
            <div class="alert alert-danger">Step {{ $index+1 }}: {{ $message }}</div>
        @endforeach
    @endforeach
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

