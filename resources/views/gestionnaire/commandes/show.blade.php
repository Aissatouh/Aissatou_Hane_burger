<x-app-layout>

    <x-alert />
    <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Détails de la commande #{{ $commande->id }}</h2>

                <div class="bg-white p-4 shadow rounded-lg">
                    <p><strong>Client :</strong> {{ $commande->user->name }}</p>
                    <p><strong>Total :</strong> {{ number_format($commande->total, 0, ',', ' ') }} FCFA</p>
                    <p><strong>Statut :</strong> {{ $commande->statut }}</p>
                    <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <h3 class="text-xl font-bold mt-6">Produits commandés</h3>

                <table class="w-full bg-white shadow-md rounded-lg mt-3">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="p-3 text-left">Produit</th>
                            <th class="p-3 text-left">Quantité</th>
                            <th class="p-3 text-left">Prix unitaire</th>
                            <th class="p-3 text-left">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commande->produits as $produit)
                            <tr class="border-b">
                                <td class="p-3">{{ $produit->nom }}</td>
                                <td class="p-3">{{ $produit->pivot->quantite }}</td>
                                <td class="p-3">{{ number_format($produit->pivot->prix, 0, ',', ' ') }} FCFA</td>
                                <td class="p-3">{{ number_format($produit->pivot->total, 0, ',', ' ') }} FCFA</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Formulaire de modification du statut -->
                @if ($commande->statut !== 'Payée' && $commande->statut !== 'Annulée')
                    <form action="{{ route('gestionnaire.commandes.update_statut', $commande->id) }}" method="POST" class="mt-6 bg-white p-4 shadow rounded-lg">
                        @csrf
                        @method('PATCH')
                        <label for="statut" class="block font-semibold mb-2">Modifier le statut :</label>
                        <div class="flex items-center space-x-3">
                            <select name="statut" id="statut" class="border rounded px-4 py-2">
                                <option value="En attente" {{ $commande->statut == 'En attente' ? 'selected' : '' }}>En attente</option>
                                <option value="En préparation" {{ $commande->statut == 'En préparation' ? 'selected' : '' }}>En préparation</option>
                                <option value="Prête" {{ $commande->statut == 'Prête' ? 'selected' : '' }}>Prête</option>
                                <option value="Payée">Payée</option>
                            </select>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                Mettre à jour
                            </button>
                        </div>
                    </form>

                    <!-- Formulaire d'annulation de commande -->
                    <form action="{{ route('gestionnaire.commandes.annuler', $commande->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            Annuler la commande
                        </button>
                    </form>
                @else
                    <p class="text-red-500 font-semibold mt-4">
                        Cette commande est {{ $commande->statut }} et ne peut plus être modifiée.
                    </p>
                @endif

                <a href="{{ route('gestionnaire.commandes.index') }}" 
                class="mt-4 inline-block bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Retour
                </a>
            </div>
        </div>
    </div>
</x-app-layout>