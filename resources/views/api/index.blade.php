<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-pink-700 dark:text-pink-200 leading-tight">
            {{ __('API Tokens') }}
        </h2>
    </x-slot>

    <div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 bg-pink-50 dark:bg-pink-900 rounded-xl shadow">
            @livewire('api.api-token-manager')
        </div>
    </div>
</x-app-layout>
