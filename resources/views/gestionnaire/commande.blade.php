<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestion des Commandes') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Liste des Commandes</h3>

                @foreach($commandes as $commande)
                    <div class="border-b py-4 flex justify-between items-center">
                        <div>
                            <p class="font-semibold">Commande #{{ $commande->id }}</p>
                            <p>Client : {{ $commande->user->name }}</p>
                            <p>Statut : {{ $commande->statut }}</p>
                        </div>
                        <div>
                            <form method="POST" action="{{ route('gestionnaire.commandes.update', $commande->id) }}">
                                @csrf
                                @method('PATCH')
                                <select name="statut" class="px-4 py-2 border border-gray-300 rounded">
                                    <option value="En attente" @selected($commande->statut == 'En attente')>En attente</option>
                                    <option value="En préparation" @selected($commande->statut == 'En préparation')>En préparation</option>
                                    <option value="Prête" @selected($commande->statut == 'Prête')>Prête</option>
                                    <option value="Payée" @selected($commande->statut == 'Payée')>Payée</option>
                                </select>
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded mt-2">Mettre à jour</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>