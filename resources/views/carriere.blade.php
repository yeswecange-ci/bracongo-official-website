@extends('layout.app')

@section('title', 'Carrière')

@section('content')
    <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
        <img src="{{ asset('img/rejoins.png') }}" alt="Rejoignez-nous" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-center uppercase tracking-[0.2em]">
                Rejoignez-nous
            </h1>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <p class="text-gray-800 text-sm md:text-base leading-relaxed font-medium">
                Employer et former les bonnes personnes pour le poste est la clé de notre succès. Notre aspiration est d'offrir le meilleur à nos clients et consommateurs et d'offrir des produits de qualité à des prix abordables. Si vous appréciez l'action, la qualité et l'intégrité, notre entreprise est l'endroit idéal pour vous
            </p>
        </div>
    </section>

    <section class="pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-center gap-3 mb-16">
                <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-8 w-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Nos offres d'emploi</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
                <div class="rounded-[2rem] overflow-hidden shadow-xl border border-gray-100 h-[350px] md:h-[450px]">
                    <img src="{{ asset('img/secu.jpg') }}" alt="Responsable Sécurité" class="w-full h-full object-cover">
                </div>
                
                <div class="space-y-6">
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
                        Responsable Sécurité des Systèmes d’information
                    </h3>
                    
                    <div class="space-y-4 text-gray-700 text-sm md:text-base leading-relaxed">
                        <p>
                            BRACONGO recherche un(e) Responsable Sécurité des Systèmes d’information pour piloter la stratégie de cybersécurité et garantir la protection des actifs numériques de l’entreprise.
                        </p>
                        <p>
                            Ce poste stratégique, rattaché au Département des Systèmes d'Information, implique une étroite collaboration avec les équipes informatiques, la direction générale et les référents sécurité du groupe, afin d'assurer une gestion rigoureuse des risques informatiques et la conformité aux normes de sécurité.
                        </p>
                        <p class="font-bold text-gray-900">
                            Prêt(e) à relever le défi ? Postulez dès maintenant et rejoignez une entreprise en pleine transformation !
                        </p>
                    </div>

                    <div class="pt-4">
                        <a href="#" class="inline-flex items-center gap-2 px-8 py-3 border border-bracongo text-bracongo rounded-full font-bold hover:bg-bracongo hover:text-white transition-all duration-300 group">
                            Plus de détails sur l’offre
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center gap-4 mt-12">
                <span class="text-bracongo font-bold text-sm cursor-pointer">1</span>
                <span class="text-gray-400 font-bold text-sm cursor-pointer hover:text-bracongo transition-colors">2</span>
                <span class="text-gray-400 font-bold text-sm cursor-pointer hover:text-bracongo transition-colors">3</span>
                <span class="text-gray-400 font-bold text-sm cursor-pointer hover:text-bracongo transition-colors">4</span>
                <span class="text-gray-400 font-bold text-sm cursor-pointer hover:text-bracongo transition-colors">5</span>
                <div class="flex items-center text-bracongo">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>
@endsection