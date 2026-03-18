@extends('layout.app')

@section('title', 'Bracongo Pro')

@section('content')
    <div class="relative w-full h-[400px] md:h-[700px] overflow-hidden">
        <img src="{{ asset('img/brcpro.png') }}" alt="Bracongo Pro Banner" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-center uppercase tracking-widest">
                Bracongo Pro
            </h1>
        </div>
    </div>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-16 items-center">
                
                <div class="flex justify-center lg:justify-end lg:col-span-2">
                    <div class="w-full max-w-[900px] h-[500px] md:h-[700px]">
                        <img src="{{ asset('img/tel.png') }}" alt="Application Bracongo Pro Mockup" class="w-full h-auto object-contain scale-110 md:scale-125">
                    </div>
                </div>

                <div class="space-y-12 lg:col-span-3">
                    <p class="text-gray-800 text-sm md:text-base leading-relaxed font-bold">
                        Bracongo Pro est l'application mobile pensée pour les ténanciers de bars, clients fidèles de Bracongo. Simple, intuitive et 100% mobile, elle facilite la gestion quotidienne des achats, permet un suivi personnalisé et rapproche encore plus les utilisateurs des services Bracongo dans un secteur en pleine digitalisation.
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-6 w-auto">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Pourquoi choisir Bracongo Pro?</h2>
                        </div>
                        <p class="text-gray-700 text-sm md:text-base font-medium">
                            Dans une dynamique citoyenne et innovante, Bracongo met à disposition de ses partenaires une solution numérique conçue pour:
                        </p>
                        <ul class="space-y-3 text-gray-700 text-sm md:text-base font-medium list-disc pl-5">
                            <li><span class="font-bold">Informer:</span> Recevez, au quotidien, le détail de vos achats, montants payés et remises sur une interface claire.</li>
                            <li><span class="font-bold">Consulter les tarifs:</span> Accédez instantanément à tous les produits Bracongo et comparez les formats et les prix pour mieux piloter votre activité.</li>
                            <li><span class="font-bold">Gérer votre profil:</span> Retrouvez toutes vos informations client (nom, code, circuit, centre de distribution) en un clic.</li>
                            <li><span class="font-bold">Suivre les livraisons:</span> Localisez la position du camion de votre circuit en temps réel sur la carte, pour planifier vos réceptions en toute sérénité.</li>
                            <li><span class="font-bold">Satisfaire vos besoins:</span> Adressez vos réclamations directement par l'application, suivez l'état de votre demande et bénéficiez d'une prise en charge optimisée.</li>
                        </ul>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-6 w-auto">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Fonctionnalités clés</h2>
                        </div>
                        <ul class="space-y-3 text-gray-700 text-sm md:text-base font-medium list-disc pl-5">
                            <li><span class="font-bold">Accueil personnalisé:</span> Visualisez votre catégorie client, vos chiffres du mois et les réductions appliquées.</li>
                            <li><span class="font-bold">Historique complet:</span> Tableaux et graphiques présentant la progression de vos achats, volumes et montants détaillés par période.</li>
                            <li><span class="font-bold">Module Camion:</span> Suivi géolocalisé du camion SRD avec historique de passage.</li>
                            <li><span class="font-bold">Gestion des plaintes:</span> Suivi des réclamations avec notifications à chaque étape. <a href="#" class="text-bracongo hover:underline italic">Bracongopro-presentation.pdf</a></li>
                            <li><span class="font-bold">Catalogue produits:</span> Galerie de produits Bracongo avec images, tarifs et formats.</li>
                        </ul>
                    </div>

                    <div class="pt-4">
                        <a href="#" class="inline-flex items-center gap-3 px-10 py-4 bg-bracongo text-white rounded-full font-bold hover:opacity-90 transition-all shadow-lg group">
                            <span>Télécharger Bracongo pro</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
