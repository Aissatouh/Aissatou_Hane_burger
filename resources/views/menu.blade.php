<x-alert />

@if(auth()->user()->role === 'client')
<nav class="bg-blue-600 text-white p-4">
    <div class="max-w-7xl mx-auto flex justify-between">
        <a href="{{ route('client.dashboard') }}" class="px-4 py-2 hover:bg-blue-500 rounded">Accueil</a>
        <a href="{{ route('panier.index') }}" class="px-4 py-2 hover:bg-blue-500 rounded">Panier</a>
        <a href="{{ route('client.commandes') }}" class="px-4 py-2 hover:bg-blue-500 rounded">Mes Commandes</a>
        <a href="{{ route('client.factures') }}" class="px-4 py-2 hover:bg-blue-500 rounded">Factures</a> <!-- Lien vers les factures -->
    </div>
</nav>
@elseif (auth()->user()->role === 'gestionnaire')
<nav class="bg-gray-800 text-white p-4">
    <div class="max-w-7xl mx-auto flex justify-between">
        <a href="{{ route('gestionnaire.dashboard') }}" class="px-4 py-2 hover:bg-gray-700 rounded">Dashboard</a>
        <a href="{{ route('gestionnaire.produits.index') }}" class="px-4 py-2 hover:bg-gray-700 rounded">Produits</a>
        <a href="{{ route('gestionnaire.commandes.index') }}" class="px-4 py-2 hover:bg-gray-700 rounded">Commandes</a>
        <!-- <a href="{{ route('gestionnaire.factures.index') }}" class="px-4 py-2 hover:bg-gray-700 rounded">Factures</a> Lien vers gestion des factures
        <a href="#" class="px-4 py-2 hover:bg-gray-700 rounded">Paramètres</a> -->
    </div>
</nav>
@endif