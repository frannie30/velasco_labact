<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight">
            {{ __('Admin - Manage Recipes') }}
        </h2>
    </x-slot>

    @if (session('success'))
    <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 border border-green-300 text-green-800 font-semibold shadow">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 border border-red-300 text-red-800 font-semibold shadow">
        {{ session('error') }}
    </div>
@endif

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-full mx-auto sm:px-12 lg:px-24">
            <div class="bg-white/90 shadow-2xl rounded-2xl p-16 border border-pink-200">
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
                                <th class="px-6 py-3 border-b text-left text-pink-800 font-semibold">Submitted At</th>
                                <th class="px-6 py-3 border-b text-left text-pink-800 font-semibold">Actions</th>
                            </tr>
                        </thead>
<tbody>
    @forelse($recipes as $recipe)
        <tr class="hover:bg-pink-200 transition">
            <td class="px-6 py-4 border-b align-top">{{ $recipe->user->name ?? 'Unknown' }}</td>
            <td class="px-6 py-4 border-b align-top">{{ $recipe->province->name ?? 'Unknown' }}</td>
            <td class="px-6 py-4 border-b align-top">{{ $recipe->name }}</td>
            <td class="px-6 py-4 border-b align-top">{{ $recipe->description }}</td>
            <td class="px-6 py-4 border-b align-top">
                <ul class="list-disc list-inside text-pink-900">
                    @foreach($recipe->ingredients as $ingredient)
                        <li>{{ $ingredient }}</li>
                    @endforeach
                </ul>
            </td>
            <td class="px-6 py-4 border-b align-top">
                <ol class="list-decimal list-inside text-pink-900">
                    @foreach($recipe->recipe  as $step)
                        <li>{{ $step }}</li>
                    @endforeach
                </ol>
            </td>
            <td class="px-6 py-4 border-b align-top">
                {{ $recipe->created_at->format('M d, Y') }}
            </td>
            <td class="px-6 py-4 border-b align-top">
                <div class="flex flex-col items-stretch gap-3">
                    <form method="POST" action="{{ route('admin.approve', $recipe->id) }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2 bg-pink-600 text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-pink-700 transition focus:outline-none focus:ring-2 focus:ring-pink-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Approve
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.recipe.remove', $recipe->id) }}"
                          onsubmit="return confirm('Are you sure you want to decline this recipe? This action cannot be undone.');">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2 bg-red-100 text-red-700 px-4 py-2 rounded-lg font-semibold shadow hover:bg-red-200 transition focus:outline-none focus:ring-2 focus:ring-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Decline
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="px-6 py-4 border-b text-center text-pink-600">No recipes found.</td>
        </tr>
    @endforelse
</tbody>
                    </table>
                </div>
</br>
                {{ $recipes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
