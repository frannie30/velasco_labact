<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight">
            {{ __('Admin - Manage Recipes') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-2xl p-10 border border-pink-200">
                <a href="{{ route('index.index') }}"
                   class="self-start inline-flex items-center justify-center w-10 h-10 text-pink-600 hover:text-pink-800 font-bold rounded-full transition duration-200 mb-4 text-2xl focus:outline-none focus:ring-2 focus:ring-pink-400 focus:ring-offset-2 bg-pink-100 hover:bg-pink-200 shadow"
                   title="Back to Dashboard"
                   aria-label="Back to Dashboard">
                    &larr;
                </a>  
                <h2 class="text-3xl font-extrabold mb-6 text-center text-pink-700">Add New Recipe</h2>

                <!-- Static Table of Posts -->
                <h2 class="text-xl font-bold mb-4 text-pink-800">Here are the Recipes submitted by the users</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-pink-200 rounded-xl shadow">
                        <thead class="bg-pink-100">
                            <tr>
                                <th class="px-6 py-3 border-b text-left text-pink-800 font-semibold">User</th>
                                <th class="px-6 py-3 border-b text-left text-pink-800 font-semibold">Province</th>
                                <th class="px-6 py-3 border-b text-left text-pink-800 font-semibold">Dish Name</th>
                                <th class="px-6 py-3 border-b text-left text-pink-800 font-semibold">Description</th>

                                <th class="px-6 py-3 border-b text-left text-pink-800 font-semibold">Ingredients</th>
                                <th class="px-6 py-3 border-b text-left text-pink-800 font-semibold">Recipe</th>
                                <th class="px-6 py-3 border-b text-left text-pink-800 font-semibold">Actions</th>
                            </tr>
                        </thead>
<tbody>
    @forelse($recipes as $recipe)
        <tr class="hover:bg-pink-50 transition">
            <td class="px-6 py-4 border-b align-top">{{ $recipe->user->name ?? 'Unknown' }}</td>
            <td class="px-6 py-4 border-b align-top">{{ $recipe->province->name ?? 'Unknown' }}</td>
            <td class="px-6 py-4 border-b align-top">{{ $recipe->name }}</td>
            <td class="px-6 py-4 border-b align-top">{{ $recipe->description }}</td>

            <td class="px-6 py-4 border-b align-top">
                <ul class="list-disc list-inside text-pink-900">
                    @foreach(explode(',', $recipe->ingredients) as $ingredient)
                        <li>{{ trim($ingredient) }}</li>
                    @endforeach
                </ul>
            </td>
            <td class="px-6 py-4 border-b align-top">
                <ol class="list-decimal list-inside text-pink-900">
                    @foreach(explode('.', $recipe->recipe) as $step)
                        @if(trim($step) != '')
                            <li>{{ trim($step) }}</li>
                        @endif
                    @endforeach
                </ol>
            </td>
            <td class="px-6 py-4 border-b align-top">
    <form method="POST" action="{{ route('admin.approve', $recipe->id) }}" style="display:inline;">
        @csrf
        <button type="submit" class="inline-block bg-pink-100 text-pink-700 px-4 py-2 rounded-lg font-semibold hover:bg-pink-200 transition mr-2">Add</button>
    </form>
    <form method="POST" action="{{ route('admin.recipe.remove', $recipe->id) }}" style="display:inline;">
        @csrf
        <button type="submit" class="inline-block bg-pink-50 text-red-600 px-4 py-2 rounded-lg font-semibold hover:bg-pink-100 transition">Remove</button>
    </form>
</td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="px-6 py-4 border-b text-center text-pink-600">No recipes found.</td>
        </tr>
    @endforelse
</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
