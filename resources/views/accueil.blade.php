@extends('layouts.layout')

@section('content')

<div class="max-w-6xl mx-auto mt-10 p-6 bg-white border border-gray-300 shadow-lg rounded-lg">
    <!-- En-tête avec logo et boutons -->
    @include('header')

    <!-- Barre de recherche -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accueil - Nos Produits') }}
        </h2>

        <form method="GET" action="{{ route('accueil') }}" class="flex space-x-2">
            <!-- Champ de recherche par nom -->
            <input type="text" name="search" id="search" placeholder="Rechercher un produit..."
                value="{{ request('search') }}"
                class="rounded-lg p-1.5 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 w-32 sm:w-48">

            <!-- Champ de prix minimum -->
            <input type="number" name="prix_min" id="prix_min" placeholder="Prix min"
                value="{{ request('prix_min') }}"
                class="rounded-lg p-1.5 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 w-32 sm:w-48">

            <!-- Champ de prix maximum -->
            <input type="number" name="prix_max" id="prix_max" placeholder="Prix max"
                value="{{ request('prix_max') }}"
                class="rounded-lg p-1.5 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 w-32 sm:w-48">

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    
    <x-alert></x-alert>

    <div class="py-6">
        <h3 class="text-lg font-semibold mb-4 border-b pb-2">Tous nos produits</h3>

        <!-- Grille des produits -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @if ($produits->isEmpty())
                <p class="col-span-4 text-center text-gray-500">Aucun produit disponible.</p>
            @else
                @foreach ($produits as $produit)
                    @if(!$produit->archived)
                        <div class="border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition duration-300">
                            <div class="w-full h-40 bg-gray-100 rounded-md flex items-center justify-center overflow-hidden">
                                @if ($produit->image)
                                    <img src="{{ asset($produit->image) }}" alt="{{ $produit->nom }}" class="object-cover w-full h-full">
                                @else
                                    <span class="text-gray-500">Pas d'image</span>
                                @endif
                            </div>
                            <h4 class="font-semibold text-lg mt-2 text-gray-800">{{ $produit->nom }}</h4>
                            <p class="text-gray-700 font-medium">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</p>
                            <p class="text-green-700 font-medium">{{ $produit->categorie }} </p>

                            <i class="mt-2 mb-2 {{ $produit->stock === 0 ? 'text-red-500 font-bold' : '' }}">
                                {{ $produit->stock === 0 ? 'Rupture de stock' : $produit->stock . ' produit(s) restant(s)' }}
                            </i>


                            <!-- Bouton Voir le produit -->
                            <a href="{{ route('produit.show', $produit->id) }}" class="mt-2 inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-center w-full">Voir le produit</a>

                            <!-- Bouton Ajouter au panier visible seulement si l'utilisateur est connecté -->
                            @if ($produit->stock !== 0)
                                @auth
                                    @if(auth()->user()->role === 'client')
                                        <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="mt-2 inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-center w-full">
                                                <i class="fas fa-cart-plus"></i> Ajouter au panier
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection