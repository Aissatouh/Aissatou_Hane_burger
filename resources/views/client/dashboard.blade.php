<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tableau de bord - Client') }}
            </h2>
        </div>
    </x-slot>

    <!-- MENU -->
    @include('menu')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Bonjour, {{ auth()->user()->name }}</h3>
                <p class="text-gray-700">Explorez nos produits et passez vos commandes en toute simplicité.</p>
            </div>
        </div>
    </div>
</x-app-layout>
