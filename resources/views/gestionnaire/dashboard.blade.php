<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tableau de bord - Gestionnaire') }}
            </h2>
        </div>
    </x-slot>

    @include('menu')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Commandes du jour -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700">📦 Commandes du jour</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $nombreCommandesDuJour }}</p>
                </div>

                <!-- Commandes payées -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700">💰 Commandes payées</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $nombreCommandesPayees }}</p>
                </div>

                <!-- Recettes journalières -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700">💵 Recettes journalières</h3>
                    <p class="text-3xl font-bold text-orange-600 mt-2">{{ number_format($recettesJournalieres, 0, ',', ' ') }} FCFA</p>
                </div>

            </div>

            <!-- Graphique des commandes par mois -->
            <div class="bg-white p-6 rounded-lg shadow-md mt-8">
                <h3 class="text-lg font-semibold text-gray-700">📊 Commandes par mois</h3>
                <canvas id="chartCommandes" width="500" height="100"></canvas>
            </div>

            <!-- Graphique du Nombre de Produit par catégorie par mois -->
            <div class="bg-white p-6 rounded-lg shadow-md mt-8">
                <h3 class="text-lg font-semibold text-gray-700">📊 Produits vendus par catégorie par mois</h3>
                <canvas id="chartProduitsParCategorie" width="400" height="150"></canvas>
            </div>

        </div>
    </div>

    <!-- Nombre de commande par mois -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('chartCommandes').getContext('2d');
        var chartCommandes = new Chart(ctx, {
            type: 'bar', // Choisir le type de graphique
            data: {
                labels: @json($moisLabels), // Labels des mois
                datasets: [{
                    label: 'Nombre de commandes par mois',
                    data: @json($commandesData), // Données des commandes
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Couleur du fond des barres
                    borderColor: 'rgba(54, 162, 235, 1)', // Couleur des bords des barres
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!-- Nombre de Produit par catégorie par mois -->
    <script>
        var ctxProduits = document.getElementById('chartProduitsParCategorie').getContext('2d');
        var chartProduitsParCategorie = new Chart(ctxProduits, {
            type: 'line', // Graphique en courbe
            data: {
                labels: @json($moisLabel), // Mois de l'année
                datasets: [
                    {
                        label: 'Burgers',
                        data: @json($chartData['Burgers']),
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true
                    },
                    {
                        label: 'Boissons',
                        data: @json($chartData['Boissons']),
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true
                    },
                    {
                        label: 'Desserts',
                        data: @json($chartData['Desserts']),
                        borderColor: 'rgba(255, 206, 86, 1)',
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>