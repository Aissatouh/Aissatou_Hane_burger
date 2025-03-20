<x-app-layout>

    @include('menu')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Toutes les commandes</h2>

                <table class="w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="p-3 text-left">#</th>
                            <th class="p-3 text-left">Client</th>
                            <th class="p-3 text-left">Total</th>
                            <th class="p-3 text-left">Statut</th>
                            <th class="p-3 text-left">Date</th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($commandes->isEmpty())
                            <tr>
                                <td colspan="6" class="py-3 px-6 text-center">Aucune commande trouvé</td>
                            </tr>
                        @else
                            @foreach ($commandes as $commande)
                                <tr class="border-b">
                                    <td class="p-3">{{ $commande->id }}</td>
                                    <td class="p-3">{{ $commande->user->name }}</td>
                                    <td class="p-3">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                                    <td class="p-3">{{ $commande->statut }}</td>
                                    <td class="p-3">{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="p-3">
                                        <a href="{{ route('gestionnaire.commandes.show', $commande->id) }}" 
                                        class="bg-blue-500 text-white px-3 py-1 rounded">
                                            Voir
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>