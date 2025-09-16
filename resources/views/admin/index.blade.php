<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 shadow-2xl rounded-2xl p-14 border border-pink-200">
                <div class="mb-10 border-b pb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-3xl font-extrabold text-pink-700 mb-1">
                            Manage Content
                        </h3>
                        <p class="text-pink-800">
                            Hi, <span class="font-semibold">{{ Auth::user()->name }}</span>! What would you like to do?
                        </p>
                    </div>
                    <a href="{{ route('create.index') }}"
                       class="bg-pink-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-pink-700 hover:scale-105 transition focus:outline-none focus:ring-2 focus:ring-pink-400">
                        + Add New Recipe
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-pink-200 rounded-xl shadow">
                        <thead class="bg-pink-100">
                            <tr>
                                <th class="px-6 py-3 border-b text-left text-pink-800 font-semibold">User</th>
                                <th class="px-6 py-3 border-b text-left text-pink-800 font-semibold">Province</th>
                                <th class="px-6 py-3 border-b text-left text-pink-800 font-semibold">Dish Name</th>
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
                                        <a href="{{ route('edit.index', $recipe->id) }}" class="inline-block bg-pink-100 text-pink-700 px-4 py-2 rounded-lg font-semibold hover:bg-pink-200 transition mr-2">Edit</a>
                                        <form method="POST" action="{{ route('admin.recipe.remove', $recipe->id) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="inline-block bg-pink-50 text-red-600 px-4 py-2 rounded-lg font-semibold hover:bg-pink-100 transition">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 border-b text-center text-pink-600">No approved recipes found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
