@extends('layout.app')

@section('title', 'Foire Aux Questions')

@section('meta_description', 'Retrouvez les réponses aux questions les plus fréquentes sur Bracongo, nos produits, nos services et notre application Bracongo Pro.')

@section('content')

    {{-- Hero --}}
    <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
        <img src="{{ asset('img/brasserie.jpg') }}" alt="FAQ Bracongo"
             class="w-full h-full object-cover" loading="eager" fetchpriority="high" decoding="async">
        <div class="absolute inset-0 bg-black/65"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4 text-center">
            <span class="inline-block px-4 py-1 border border-white/40 rounded-full text-xs font-semibold tracking-[0.2em] uppercase text-white/80 mb-4">Aide & informations</span>
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight uppercase tracking-[0.15em]">
                FAQ
            </h1>
            <p class="mt-4 text-white/75 text-sm md:text-base max-w-xl font-medium">
                Vous avez des questions ? Nous avons les réponses.
            </p>
        </div>
    </div>

    {{-- Contenu --}}
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4">

            @php
            $sections = [
                [
                    'titre' => 'À propos de Bracongo',
                    'icone' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 00-1-1h-2a1 1 0 00-1 1v5m4 0H9',
                    'questions' => [
                        [
                            'q' => 'Qu\'est-ce que Bracongo ?',
                            'r' => 'Bracongo S.A. (Brasseries, Limonaderies et Malteries du Congo) est la principale brasserie de la République Démocratique du Congo. Fondée en 1923, elle produit et distribue une large gamme de bières, boissons gazeuses, eaux et boissons énergisantes à travers tout le pays.',
                        ],
                        [
                            'q' => 'Où se trouvent vos installations ?',
                            'r' => 'Notre siège social et notre principale unité de production sont situés Avenue des Brasseries, N° 7666, Kingabwa, Limete, Kinshasa, RDC. Nous disposons également de plusieurs centres de distribution à travers le territoire national pour assurer une disponibilité constante de nos produits.',
                        ],
                        [
                            'q' => 'Bracongo fait-elle partie d\'un groupe international ?',
                            'r' => 'Oui, Bracongo est une filiale du Groupe Castel, l\'un des plus grands groupes agroalimentaires africains, présent dans plus de 21 pays du continent.',
                        ],
                    ],
                ],
                [
                    'titre' => 'Nos produits',
                    'icone' => 'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18',
                    'questions' => [
                        [
                            'q' => 'Quelles sont les marques produites par Bracongo ?',
                            'r' => 'Bracongo produit une gamme complète de boissons : dans les bières (Primus, Skol, Turbo King, Beaufort, Doppel…), les boissons gazeuses (Coca-Cola, Fanta, Sprite…), les eaux (Tembo) et les boissons énergisantes. Consultez notre page "Nos marques" pour découvrir l\'ensemble du catalogue.',
                        ],
                        [
                            'q' => 'Vos produits respectent-ils des normes de qualité ?',
                            'r' => 'Absolument. Bracongo est certifiée ISO et applique des processus de contrôle qualité stricts à chaque étape de la production, du brassage à la mise en bouteille, conformément aux standards internationaux du Groupe Castel.',
                        ],
                        [
                            'q' => 'Comment signaler un problème de qualité sur un produit ?',
                            'r' => 'Si vous constatez un défaut sur l\'un de nos produits, vous pouvez nous contacter directement via notre page Contact ou appeler notre service consommateurs. Conservez le produit et notez la date de fabrication et le code lot indiqués sur l\'emballage.',
                        ],
                    ],
                ],
                [
                    'titre' => 'Commandes & distribution',
                    'icone' => 'M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z',
                    'questions' => [
                        [
                            'q' => 'Comment devenir revendeur ou distributeur Bracongo ?',
                            'r' => 'Pour devenir partenaire commercial (revendeur, bar, restaurant, hôtel ou grossiste), rendez-vous sur notre page Contact et renseignez le formulaire "Devenir client". Notre équipe commerciale vous contactera dans les meilleurs délais pour étudier votre demande.',
                        ],
                        [
                            'q' => 'Puis-je commander directement auprès de Bracongo en tant que particulier ?',
                            'r' => 'Bracongo distribue ses produits exclusivement via son réseau de revendeurs agréés (supermarchés, épiceries, bars, restaurants). Pour des commandes en grande quantité ou des événements, contactez-nous via notre formulaire dédié.',
                        ],
                        [
                            'q' => 'Bracongo assure-t-elle des livraisons à domicile ?',
                            'r' => 'La livraison à domicile n\'est pas un service assuré directement par Bracongo. Nous vous recommandons de vous rapprocher de l\'un de nos revendeurs agréés dans votre zone géographique.',
                        ],
                        [
                            'q' => 'Comment localiser un point de vente près de chez moi ?',
                            'r' => 'Nos produits sont disponibles dans la grande majorité des épiceries, supermarchés et points de vente sur l\'ensemble du territoire. Consultez notre carte de présence sur la page "Notre histoire" pour localiser les centres de distribution les plus proches.',
                        ],
                    ],
                ],
                [
                    'titre' => 'Application Bracongo Pro',
                    'icone' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
                    'questions' => [
                        [
                            'q' => 'Qu\'est-ce que l\'application Bracongo Pro ?',
                            'r' => 'Bracongo Pro est notre application mobile dédiée aux professionnels (revendeurs, gérants de bars, restaurateurs). Elle permet de passer des commandes, suivre les livraisons, consulter les tarifs et accéder aux offres promotionnelles en temps réel.',
                        ],
                        [
                            'q' => 'Comment télécharger et accéder à Bracongo Pro ?',
                            'r' => 'L\'application Bracongo Pro est disponible sur les principales plateformes mobiles. Rendez-vous sur notre page dédiée "Bracongo Pro" pour obtenir le lien de téléchargement et les instructions d\'activation de votre compte professionnel.',
                        ],
                        [
                            'q' => 'L\'application est-elle gratuite ?',
                            'r' => 'Oui, l\'application Bracongo Pro est entièrement gratuite pour tous nos partenaires commerciaux enregistrés. L\'accès est réservé aux professionnels titulaires d\'un compte Bracongo actif.',
                        ],
                    ],
                ],
                [
                    'titre' => 'Carrière & recrutement',
                    'icone' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                    'questions' => [
                        [
                            'q' => 'Comment postuler à une offre d\'emploi chez Bracongo ?',
                            'r' => 'Toutes nos offres d\'emploi actives sont publiées sur notre page "Carrière". Pour postuler, sélectionnez l\'offre qui vous intéresse et remplissez le formulaire de candidature en ligne en joignant votre CV (PDF, DOC ou DOCX, max 5 Mo).',
                        ],
                        [
                            'q' => 'Puis-je soumettre une candidature spontanée ?',
                            'r' => 'Oui. Même en l\'absence d\'offre correspondant à votre profil, vous pouvez nous adresser une candidature spontanée via notre page Contact en précisant le poste et le service souhaités.',
                        ],
                        [
                            'q' => 'Quel est le délai de réponse après une candidature ?',
                            'r' => 'Notre équipe RH traite chaque candidature et revient vers les profils retenus dans un délai de deux à quatre semaines suivant la réception du dossier.',
                        ],
                    ],
                ],
                [
                    'titre' => 'Contact & support',
                    'icone' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                    'questions' => [
                        [
                            'q' => 'Comment contacter Bracongo ?',
                            'r' => 'Vous pouvez nous joindre via le formulaire de contact sur notre site, par téléphone au {{ isset($parametres) ? ($parametres->telephone_public ?? "+243 815 586 874") : "+243 815 586 874" }}, ou par e-mail. Retrouvez toutes nos coordonnées sur la page Contact.',
                        ],
                        [
                            'q' => 'Bracongo est-elle présente sur les réseaux sociaux ?',
                            'r' => 'Oui, suivez-nous sur nos réseaux sociaux officiels (Facebook, Instagram, YouTube…) pour rester informé de nos actualités, promotions et événements. Les liens sont disponibles en pied de page du site.',
                        ],
                        [
                            'q' => 'Ma question ne figure pas dans cette FAQ, que faire ?',
                            'r' => 'Si votre question n\'a pas trouvé de réponse ici, n\'hésitez pas à nous contacter directement via notre formulaire de contact. Notre équipe vous répondra dans les meilleurs délais.',
                        ],
                    ],
                ],
            ];
            @endphp

            {{-- En-tête --}}
            <div class="flex items-center gap-3 mb-14">
                <img src="{{ asset('img/Group.png') }}" alt="" class="h-8 w-auto" loading="lazy" decoding="async" aria-hidden="true">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Questions fréquentes</h2>
            </div>

            {{-- Sections FAQ --}}
            <div class="space-y-12" id="faq-container">

                @foreach($sections as $si => $section)
                <div>
                    {{-- Titre de section --}}
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-bracongo" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $section['icone'] }}"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">{{ $section['titre'] }}</h3>
                    </div>

                    {{-- Items --}}
                    <div class="space-y-3 pl-0 md:pl-12">
                        @foreach($section['questions'] as $qi => $item)
                        <div class="faq-item border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
                            <button class="faq-btn w-full flex items-center justify-between gap-4 px-6 py-4 text-left bg-white hover:bg-gray-50 transition-colors"
                                    aria-expanded="false">
                                <span class="font-semibold text-gray-900 text-sm md:text-base leading-snug">
                                    {{ $item['q'] }}
                                </span>
                                <span class="faq-icon flex-shrink-0 w-7 h-7 rounded-full border border-gray-200 bg-white flex items-center justify-center transition-all duration-200">
                                    <svg class="faq-plus w-3.5 h-3.5 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </span>
                            </button>
                            <div class="faq-panel hidden px-6 pb-5 bg-gray-50/60 border-t border-gray-100">
                                <p class="text-gray-600 text-sm leading-relaxed pt-4 font-medium">
                                    {{ $item['r'] }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach

            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.faq-btn').forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        var item   = btn.closest('.faq-item');
                        var panel  = item.querySelector('.faq-panel');
                        var icon   = item.querySelector('.faq-icon');
                        var plus   = item.querySelector('.faq-plus');
                        var isOpen = !panel.classList.contains('hidden');

                        if (isOpen) {
                            panel.classList.add('hidden');
                            icon.classList.remove('bg-bracongo', 'border-bracongo');
                            icon.classList.add('bg-white', 'border-gray-200');
                            plus.classList.remove('rotate-45', 'text-white');
                            plus.classList.add('text-gray-400');
                            btn.setAttribute('aria-expanded', 'false');
                        } else {
                            panel.classList.remove('hidden');
                            icon.classList.add('bg-bracongo', 'border-bracongo');
                            icon.classList.remove('bg-white', 'border-gray-200');
                            plus.classList.add('rotate-45', 'text-white');
                            plus.classList.remove('text-gray-400');
                            btn.setAttribute('aria-expanded', 'true');
                        }
                    });
                });
            });
            </script>

            {{-- CTA bas de page --}}
            <div class="mt-20 rounded-[2rem] bg-gray-50 border border-gray-100 p-10 text-center">
                <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="" class="h-10 w-auto mx-auto mb-4" loading="lazy" decoding="async" aria-hidden="true">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Vous n'avez pas trouvé votre réponse ?</h3>
                <p class="text-gray-500 text-sm mb-6 max-w-sm mx-auto">
                    Notre équipe est disponible pour répondre à toutes vos questions.
                </p>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 px-8 py-3 bg-bracongo text-white rounded-full font-bold hover:opacity-90 transition-all shadow-md group">
                    Nous contacter
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

        </div>
    </section>

@endsection

