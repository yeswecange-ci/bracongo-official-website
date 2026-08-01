<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\Boisson;
use App\Models\CandidatureEmploi;
use App\Models\FooterGallery;
use App\Models\FooterSettings;
use App\Models\HeroSlide;
use App\Models\Marque;
use App\Models\NavigationItem;
use App\Models\News;
use App\Models\OffreEmploi;
use App\Models\PageAccueil;
use App\Models\PageBieres;
use App\Models\PageBoissonsEnergisantes;
use App\Models\PageBoissonsGazeuses;
use App\Models\PageBoutique;
use App\Models\PageCarriere;
use App\Models\PageContact;
use App\Models\PageEaux;
use App\Models\PageEauxGazeuses;
use App\Models\PageHistoire;
use App\Models\PageLacledeschateaux;
use App\Models\PagePro;
use App\Models\PageWelcome;
use App\Models\ParametresSite;
use App\Models\Produit;
use App\Models\ReseauSocial;
use App\Models\User;
use App\Models\Valeur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class BracongoSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RbacSeeder::class);

        ParametresSite::updateOrCreate(['id' => 1], [
            'logo' => 'img/LOGO BRACONGO copie 1.webp',
            'couleur_principale' => '#E30613',
            'search_suggestions' => 'Beaufort Lager,Actualités,Nkoyi,RSE',
            'seo_meta_description' => null,
            'telephone_public' => null,
            'invitation_expires_hours' => '48',
        ]);

        PageWelcome::updateOrCreate(['id' => 1], [
            'fond_image' => 'img/fete.webp',
            'titre' => 'BIENVENUE SUR LE SITE BRACONGO SA',
            'texte_avertissement' => "Ce site web contient des informations sur nos boissons alcoolisées.\nEn cliquant sur l'un des boutons ci-dessous, vous confirmez être majeur dans votre pays de résidence.",
            'btn_majeur_texte' => "J'ai plus de 18 ans",
            'btn_mineur_texte' => "J'ai moins de 18 ans",
            'message_refus' => "Nous sommes désolés, vous n'avez pas l'âge requis pour accéder à ce site.",
            'mention_legale' => "L'abus de l'alcool est dangereux pour la santé, à consommer avec modération.",
        ]);

        PageAccueil::updateOrCreate(['id' => 1], [
            'qui_titre' => 'Qui sommes-nous ?',
            'qui_texte' => 'Lorem ipsum dolor sit amet consectetur. Nec augue tortor cursus vulputate ultricies mattis a. Bibendum gravida morbi urna at id dui vitae. Massa bibendum magna in quis amet neque neque diam eget. Tincidunt scelerisque mattis at habitant malesuada congue. Ut malesuada ac mauris amet non sit lobortis proin.',
            'qui_image_fond' => 'img/brasserie.webp',
            'qui_cta_texte' => 'Lire plus',
            'qui_cta_lien' => '/histoire',
            'marques_titre' => 'Nos marques',
            'marques_description' => 'Lorem ipsum dolor sit amet consectetur. Nec augue tortor cursus vulputate ultricies mattis a. Bibendum gravida morbi urna at id dui vitae. Lorem ipsum dolor sit amet consectetur. Nec augue tortor cursus.',
            'rejoignez_titre' => 'Rejoignez nous',
            'rejoignez_texte' => "Employer et former les bonnes personnes pour le poste est la clé de notre succès. Notre aspiration est d'offrir le meilleur à nos clients et consommateurs et d'offrir des produits de qualité à des prix abordables. Si vous appréciez l'action, la qualité et l'intégrité, notre entreprise est l'endroit idéal pour vous",
            'rejoignez_image' => 'img/rejoignez.webp',
            'rejoignez_cta_texte' => "Voir nos offres d'emploi",
            'rejoignez_cta_lien' => '/Carriere',
            'actualites_titre' => 'Dernières actualités',
            'actualites_voir_plus_lien' => '/Actualites-et-evenements',
        ]);

        HeroSlide::query()->delete();
        $slides = [
            ['image' => 'img/coverhome.webp', 'alt' => 'Beaufort Hero', 'ordre' => 1, 'is_active' => true],
            ['image' => 'img/banniere.webp', 'alt' => 'Tembo Hero', 'ordre' => 2, 'is_active' => true],
        ];
        foreach ($slides as $slide) {
            HeroSlide::create($slide);
        }

        PageHistoire::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/usine-bracongo.webp',
            'titre' => 'Notre histoire',
            'paragraphe_1' => 'Lorem ipsum dolor sit amet consectetur. Sapien fusce scelerisque condimentum iaculis viverra aliquam varius. Senectus tristique dapibus aliquet faucibus semper euismod nibh mauris leo. Sed adipiscing faucibus cursus scelerisque non turpis pellentesque.',
            'paragraphe_2' => 'Lorem ipsum dolor sit amet consectetur. Sapien fusce scelerisque condimentum iaculis viverra aliquam varius. Senectus tristique dapibus aliquet faucibus semper euismod nibh mauris leo. Sed adipiscing faucibus cursus scelerisque non turpis pellentesque.',
            'paragraphe_3' => 'Lorem ipsum dolor sit amet consectetur. Sapien fusce scelerisque condimentum iaculis viverra aliquam varius. Senectus tristique dapibus aliquet faucibus semper euismod nibh mauris leo. Sed adipiscing faucibus cursus scelerisque non turpis pellentesque.',
            'image_brasserie' => 'img/Frame-115.webp',
            'rse_texte' => 'Lorem ipsum dolor sit amet consectetur. Ultricies nulla at tincidunt orci et. Adipiscing risus dictum ullamcorper massa sit mattis suspendisse orci netus.',
            'rse_image' => 'img/Frame 33.webp',
            'rse_cta_texte' => 'En savoir plus sur nos engagements RSE',
            'rse_cta_lien' => '#',
            'maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3978.508544403328!2d15.352467376045353!3d-4.332304995641773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a6a33f44498394b%3A0xf6396e9803277785!2sBracongo!5e0!3m2!1sfr!2scd!4v1710680000000!5m2!1sfr!2scd',
            'presence_note' => '* Cliquez sur la carte pour explorer nos différents centres de distribution à travers le pays.',
        ]);

        Valeur::query()->delete();
        $valeurs = [
            ['lettre' => 'P', 'description' => 'Parler vrai', 'ordre' => 1],
            ['lettre' => 'R', 'description' => 'Réussir en équipe', 'ordre' => 2],
            ['lettre' => 'E', 'description' => 'Etre optimiste et audacieux', 'ordre' => 3],
            ['lettre' => 'M', 'description' => 'Maitriser le stress', 'ordre' => 4],
            ['lettre' => 'I', 'description' => 'Intégrer les enjeux à moyen et long termes', 'ordre' => 5],
            ['lettre' => 'E', 'description' => 'Etre exemplaire', 'ordre' => 6],
            ['lettre' => 'R', 'description' => 'Respecter son environnement', 'ordre' => 7],
            ['lettre' => 'S', 'description' => 'Savoir décider', 'ordre' => 8],
        ];
        foreach ($valeurs as $v) {
            Valeur::create($v);
        }

        PageContact::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/usine-bracongo-2.webp',
            'hero_titre' => 'Nos Contacts',
            'form_titre' => 'Nous contacter',
            'submit_label' => 'Envoyer',
            'whatsapp_label' => 'Discutons sur WhatsApp',
            'whatsapp_url' => '#',
            'denomination' => "Les Boissons Rafraîchissantes du Congo,\nBRACONGO SA",
            'adresse' => "Avenue des Brasseries, numéro 7666, Quartier Kingabwa,\nCommune de Limete, dans la province de Kinshasa, en\nRépublique Démocratique du Congo.",
            'bp' => 'BP: 7.600 KINSHASA 1',
            'email' => 'bracongo.contact@castel-afrique.com',
            'tel_consommateurs' => '0815586874',
            'tel_fetes' => '082 850 00 56',
            'tel_fournisseurs' => '082 850 04 60',
            'tel_cle_chateaux' => '082 850 00 40',
            'devenir_client_lien' => '#',
        ]);

        PageCarriere::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/rejoins.webp',
            'texte_intro' => "Employer et former les bonnes personnes pour le poste est la clé de notre succès. Notre aspiration est d'offrir le meilleur à nos clients et consommateurs et d'offrir des produits de qualité à des prix abordables. Si vous appréciez l'action, la qualité et l'intégrité, notre entreprise est l'endroit idéal pour vous",
        ]);

        CandidatureEmploi::query()->delete();
        OffreEmploi::query()->delete();
        $offres = [
            [
                'titre' => "Responsable Sécurité des Systèmes d'information",
                'slug' => 'responsable-securite-des-systemes-dinformation',
                'description' => "<p>BRACONGO recherche un(e) Responsable Sécurité des Systèmes d'information pour piloter la stratégie de cybersécurité et garantir la protection des actifs numériques de l'entreprise.</p><p>Ce poste stratégique, rattaché au Département des Systèmes d'Information, implique une étroite collaboration avec les équipes informatiques, la direction générale et les référents sécurité du groupe.</p><p><strong>Prêt(e) à relever le défi ? Postulez dès maintenant !</strong></p>",
                'lieu' => 'Kinshasa',
                'type_contrat' => 'CDI',
                'date_limite_candidature' => now()->addMonths(2)->toDateString(),
                'image' => 'img/secu.webp',
                'lien' => 'https://www.linkedin.com/company/bracongo',
                'is_active' => true,
                'ordre' => 1,
            ],
            [
                'titre' => 'Ingénieur de Maintenance Industrielle',
                'slug' => 'ingenieur-de-maintenance-industrielle',
                'description' => "<p>Garantissez la performance de nos lignes de production en pilotant les interventions préventives et curatives.</p><p>Expert technique, vous veillez à la sécurité des installations et à l'optimisation des coûts de maintenance.</p><p><strong>Mettez votre expertise au service de l'excellence industrielle.</strong></p>",
                'lieu' => 'Kinshasa',
                'type_contrat' => 'CDI',
                'date_limite_candidature' => now()->addMonth()->toDateString(),
                'image' => 'img/brasserie.webp',
                'lien' => '#',
                'is_active' => true,
                'ordre' => 2,
            ],
            [
                'titre' => 'Analyste Financier Senior',
                'slug' => 'analyste-financier-senior',
                'description' => "<p>Accompagnez la direction dans le pilotage de la performance économique de l'entreprise.</p><p>Vous assurez le contrôle budgétaire, l'analyse des écarts et proposez des plans d'actions correctifs.</p><p><strong>Un rôle clé au cœur de la stratégie financière.</strong></p>",
                'lieu' => 'Kinshasa',
                'type_contrat' => 'CDI',
                'date_limite_candidature' => now()->addMonths(3)->toDateString(),
                'image' => 'img/rejoignez.webp',
                'lien' => '#',
                'is_active' => true,
                'ordre' => 3,
            ],
        ];
        foreach ($offres as $offre) {
            OffreEmploi::create($offre);
        }

        PagePro::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/brcpro.webp',
            'description' => "Bracongo Pro est l'application mobile pensée pour les ténanciers de bars, clients fidèles de Bracongo. Simple, intuitive et 100% mobile, elle facilite la gestion quotidienne des achats, permet un suivi personnalisé et rapproche encore plus les utilisateurs des services Bracongo dans un secteur en pleine digitalisation.",
            'pourquoi_titre' => 'Pourquoi choisir Bracongo Pro?',
            'pourquoi_intro' => 'Dans une dynamique citoyenne et innovante, Bracongo met à disposition de ses partenaires une solution numérique conçue pour:',
            'pourquoi_items' => "<ul><li><strong>Informer:</strong> Recevez, au quotidien, le détail de vos achats, montants payés et remises sur une interface claire.</li><li><strong>Consulter les tarifs:</strong> Accédez instantanément à tous les produits Bracongo et comparez les formats et les prix pour mieux piloter votre activité.</li><li><strong>Gérer votre profil:</strong> Retrouvez toutes vos informations client (nom, code, circuit, centre de distribution) en un clic.</li><li><strong>Suivre les livraisons:</strong> Localisez la position du camion de votre circuit en temps réel sur la carte, pour planifier vos réceptions en toute sérénité.</li><li><strong>Satisfaire vos besoins:</strong> Adressez vos réclamations directement par l'application, suivez l'état de votre demande et bénéficiez d'une prise en charge optimisée.</li></ul>",
            'fonctionnalites_titre' => 'Fonctionnalités clés',
            'fonctionnalites_items' => '<ul><li><strong>Accueil personnalisé:</strong> Visualisez votre catégorie client, vos chiffres du mois et les réductions appliquées.</li><li><strong>Historique complet:</strong> Tableaux et graphiques présentant la progression de vos achats, volumes et montants détaillés par période.</li><li><strong>Module Camion:</strong> Suivi géolocalisé du camion SRD avec historique de passage.</li><li><strong>Gestion des plaintes:</strong> Suivi des réclamations avec notifications à chaque étape.</li><li><strong>Catalogue produits:</strong> Galerie de produits Bracongo avec images, tarifs et formats.</li></ul>',
            'app_image' => 'img/tel.webp',
            'cta_texte' => 'Télécharger Bracongo pro',
            'cta_lien' => '#',
        ]);

        PageBoutique::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/brasserie.webp',
            'hero_badge' => 'Bracongo officiel',
            'hero_titre' => 'Boutique',
            'hero_description' => 'Retrouvez ici nos produits et accessoires officiels.',
        ]);

        PageLacledeschateaux::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/brasserie.webp',
            'hero_titre' => 'Clé des Châteaux',
            'paragraphe_1' => 'Vins de France et d’ailleurs, La Clé Des Châteaux propose le plus large choix de vins à Kinshasa. Représentante de Castel & Frères en Afrique, notre boutique bénéficie d’une expérience dans le vin depuis 1949 avec plus de 20 Châteaux & Domaines possédés. La Clé Des Châteaux propose le meilleur de ce qui se fait en vins, champagnes et spiritueux.',
            'paragraphe_2' => 'Que ce soit en boutique pour du vin à emporter, ou au bar à vins & tapas pour consommer sur place, venez profiter d’un service de qualité et déguster les meilleurs vins de la place.',
            'horaire' => 'Ouvert de mardi à dimanche de 10h à 23h',
            'adresse' => '64, Boulevard du 30 Juin, Commune de Gombe Kinshasa, République Démocratique du Congo',
            'telephone' => '+243 828 500 048 / +243 828 500 343',
            'email' => 'lacledeschateaux@bracongo.cd',
            'cta_libelle' => 'En savoir plus',
            'cta_url' => 'https://bracongo.cd/lacledeschateaux/',
            'selection_titre' => 'Sélection du mois',
            'selection_texte' => 'Chaque mois, notre caviste vous propose une sélection de vins à découvrir et à déguster.',
            'services_titre' => 'Nos services',
            'services_html' => '<ul><li><h4>Location d’espace</h4><p>Profitez de nos différents espaces pour des réunions, petites cérémonies, dégustations en groupe. Appelez pour réserver et bénéficier de nos meilleures offres.</p></li>'
                .'<li><h4>Livraison à domicile à partir de 6 bouteilles</h4><p>Nous assurons la livraison pour tout achat à partir de 6 bouteilles. Appelez-nous pour vous aider à passer votre commande.</p></li></ul>',
        ]);

        PageBieres::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/marque.webp',
            'hero_titre' => 'Nos Bières',
            'hero_image_alt' => 'Nos Marques – Bières',
            'breadcrumb_libelle' => 'Bières',
            'meta_title' => null,
            'search_placeholder' => 'Taper un nom de bière',
            'message_liste_vide' => 'Aucune bière disponible pour le moment.',
            'message_recherche_vide' => 'Aucune bière ne correspond à votre recherche.',
        ]);

        PageEaux::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/marque.webp',
            'hero_titre' => '',
            'hero_image_alt' => null,
            'breadcrumb_libelle' => 'Eaux',
            'meta_title' => null,
            'search_placeholder' => 'Taper le nom d\'une eau',
            'message_liste_vide' => 'Aucune eau disponible pour le moment.',
            'message_recherche_vide' => 'Aucune eau ne correspond à votre recherche.',
        ]);
        PageEauxGazeuses::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/marque.webp',
            'hero_titre' => '',
            'hero_image_alt' => null,
            'breadcrumb_libelle' => 'Eaux gazeuses',
            'meta_title' => null,
            'search_placeholder' => 'Taper le nom d\'une eau gazeuse',
            'message_liste_vide' => 'Aucune eau gazeuse disponible pour le moment.',
            'message_recherche_vide' => 'Aucune boisson ne correspond à votre recherche.',
        ]);
        PageBoissonsGazeuses::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/marque.webp',
            'hero_titre' => '',
            'hero_image_alt' => null,
            'breadcrumb_libelle' => 'Boissons gazeuses',
            'meta_title' => null,
            'search_placeholder' => 'Taper le nom d\'une boisson',
            'message_liste_vide' => 'Aucune boisson gazeuse disponible pour le moment.',
            'message_recherche_vide' => 'Aucune boisson ne correspond à votre recherche.',
        ]);
        PageBoissonsEnergisantes::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/marque.webp',
            'hero_titre' => '',
            'hero_image_alt' => null,
            'breadcrumb_libelle' => 'Boissons énergisantes',
            'meta_title' => null,
            'search_placeholder' => 'Taper le nom d\'une boisson',
            'message_liste_vide' => 'Aucune boisson énergisante disponible pour le moment.',
            'message_recherche_vide' => 'Aucune boisson ne correspond à votre recherche.',
        ]);

        Boisson::query()->delete();
        Marque::query()->delete();

        $marquesBieres = [
            ['nom' => 'Beaufort', 'slug' => 'beaufort', 'image' => 'img/beaufort.webp', 'lien' => '/Nos-marques-bieres', 'ordre' => 1],
            ['nom' => 'Castel Beer', 'slug' => 'castel-beer', 'image' => 'img/castel.webp', 'lien' => '/Nos-marques-bieres', 'ordre' => 2],
            ['nom' => 'Doppel Munich', 'slug' => 'doppel-munich', 'image' => 'img/dopel.webp', 'lien' => '/Nos-marques-bieres', 'ordre' => 3],
            ['nom' => 'Nkoyi', 'slug' => 'nkoyi', 'image' => 'img/blonde.webp', 'lien' => '/Nos-marques-bieres', 'ordre' => 4],
            ['nom' => '33 Export', 'slug' => '33-export', 'image' => 'img/33b.webp', 'lien' => '/Nos-marques-bieres', 'ordre' => 5],
            ['nom' => 'TEMBO', 'slug' => 'tembo', 'image' => 'img/tembo.webp', 'lien' => '/Nos-marques-bieres', 'ordre' => 6],
        ];
        foreach ($marquesBieres as $m) {
            Marque::create(array_merge($m, ['is_active' => true]));
        }

        $marquesAutres = [
            ['nom' => 'Youzou', 'slug' => 'youzou', 'image' => 'img/gazeux.webp', 'lien' => '/Nos-marques/gazeuses', 'ordre' => 7],
            ['nom' => 'World Cola', 'slug' => 'worldcola', 'image' => 'img/gazeux.webp', 'lien' => '/Nos-marques/gazeuses', 'ordre' => 8],
            ['nom' => 'XXL Energy', 'slug' => 'xxl-energy', 'image' => 'img/energie.webp', 'lien' => '/Nos-marques/energisantes', 'ordre' => 9],
            ['nom' => 'Eau Vive', 'slug' => 'eau-vive', 'image' => 'img/eau.webp', 'lien' => '/Nos-marques/eaux', 'ordre' => 10],
        ];
        foreach ($marquesAutres as $m) {
            Marque::create(array_merge($m, ['is_active' => true]));
        }

        $beaufort = Marque::where('slug', 'beaufort')->first();
        $castel = Marque::where('slug', 'castel-beer')->first();
        $doppel = Marque::where('slug', 'doppel-munich')->first();
        $nkoyi = Marque::where('slug', 'nkoyi')->first();
        $export33 = Marque::where('slug', '33-export')->first();
        $tembo = Marque::where('slug', 'tembo')->first();

        $boissons = [
            [
                'marque_id' => $beaufort->id,
                'categorie' => 'bieres',
                'nom' => 'Beaufort Lager',
                'slug' => 'beaufort-lager',
                'description' => "est une bière précieuse et distinguée qui célèbre et prône l'excellence. Depuis 1952, seuls les meilleurs ingrédients sont sélectionnés pour assurer une qualité exceptionnelle à cette bière blonde. Son processus de fabrication ne tolère que la perfection. Sa mousse fine et ses reflets dorés laissent présager une bière d'exception.",
                'hero_image' => 'img/beauban.webp',
                'image' => 'img/beaufort.webp',
                'logo' => 'img/logob.webp',
                'annee_lancement' => 2013,
                'ingredients' => 'Eau, malt, maïs, houblon.',
                'type' => 'Bière blonde',
                'taux_alcool' => '5%',
                'conditionnement' => '33 cl et 50 cl',
                'slogan' => 'Au cœur de la fraîcheur',
                'ddm' => '12 mois',
                'type_bouteille' => 'ALE Verte et Bremer verte',
                'positionnement' => 'Premium',
                'coeur_cible' => '25-35 ans (Amateurs de mode et de beauté)',
                'video_urls' => ['https://www.youtube.com/embed/3IS5fjkBA3g', 'https://www.youtube.com/embed/Tiv6UIey21M'],
                'ordre' => 1,
            ],
            ['marque_id' => $castel->id, 'categorie' => 'bieres', 'nom' => 'Castel Beer', 'slug' => 'castel-beer', 'image' => 'img/castel.webp', 'ordre' => 1],
            [
                'marque_id' => $doppel->id,
                'categorie' => 'bieres',
                'nom' => 'Doppel Munich',
                'slug' => 'doppel-munich',
                'description' => "est la bière brune du portefeuille Bracongo. Inspirée de la tradition brassicole munichoise, elle se distingue par sa robe sombre, ses arômes maltés intenses et son caractère généreux. Une bière de dégustation appréciée des amateurs de brunes.",
                'image' => 'img/dopel.webp',
                'type' => 'Bière brune',
                'ordre' => 1,
            ],
            ['marque_id' => $nkoyi->id, 'categorie' => 'bieres', 'nom' => 'Nkoyi Blonde', 'slug' => 'nkoyi-blonde', 'image' => 'img/blonde.webp', 'ordre' => 1],
            ['marque_id' => $nkoyi->id, 'categorie' => 'bieres', 'nom' => 'Nkoyi Black', 'slug' => 'nkoyi-black', 'image' => 'img/black.webp', 'ordre' => 2],
            ['marque_id' => $export33->id, 'categorie' => 'bieres', 'nom' => '33 Export', 'slug' => '33-export', 'image' => 'img/33b.webp', 'ordre' => 1],
            ['marque_id' => $tembo->id, 'categorie' => 'bieres', 'nom' => 'TEMBO', 'slug' => 'tembo', 'image' => 'img/tembo.webp', 'conditionnement' => '50 cl', 'ordre' => 1],
        ];
        foreach ($boissons as $b) {
            Boisson::create(array_merge($b, ['is_active' => true]));
        }

        $youzou = Marque::where('slug', 'youzou')->first();
        $worldcola = Marque::where('slug', 'worldcola')->first();
        $xxlEnergy = Marque::where('slug', 'xxl-energy')->first();
        $eauVive = Marque::where('slug', 'eau-vive')->first();
        $boissonsAutres = [
            ['marque_id' => $youzou->id, 'categorie' => 'gazeuses', 'nom' => 'Youzou', 'slug' => 'youzou', 'image' => 'img/gazeux.webp', 'ordre' => 1],
            ['marque_id' => $worldcola->id, 'categorie' => 'gazeuses', 'nom' => 'World Cola', 'slug' => 'world-cola', 'image' => 'img/gazeux.webp', 'ordre' => 1],
            [
                'marque_id' => $worldcola->id,
                'categorie' => 'gazeuses',
                'nom' => 'World Cola – Édition Limitée « Cola Na Biso »',
                'slug' => 'world-cola-cola-na-biso',
                'description' => "est l'édition limitée de World Cola qui célèbre la fierté congolaise. « Cola Na Biso » — notre cola — met à l'honneur les couleurs et l'identité de la RDC.",
                'image' => 'img/gazeux.webp',
                'ordre' => 2,
            ],
            ['marque_id' => $xxlEnergy->id, 'categorie' => 'energisantes', 'nom' => 'XXL Energy', 'slug' => 'xxl-energy', 'image' => 'img/energie.webp', 'ordre' => 1],
            ['marque_id' => $eauVive->id, 'categorie' => 'eaux', 'nom' => 'Eau Vive', 'slug' => 'eau-vive', 'image' => 'img/eau.webp', 'ordre' => 1],
        ];
        foreach ($boissonsAutres as $b) {
            Boisson::create(array_merge($b, ['is_active' => true]));
        }

        Produit::query()->delete();
        $this->call(MerchandisingProduitsSeeder::class);

        News::query()->delete();
        $news = [
            [
                'titre' => 'Rencontre avec Lumumba',
                'slug' => 'rencontre-avec-lumumba',
                'type' => 'actualites',
                'extrait' => 'Retour en images sur une rencontre marquante autour des valeurs de la marque.',
                'contenu' => '<p>Un moment fort de partage et de proximité avec nos partenaires et consommateurs.</p>',
                'image' => 'img/lumumba.webp',
                'date_publication' => now()->subDays(2),
                'ordre' => 1,
            ],
            [
                'titre' => 'Rencontre des influenceurs',
                'slug' => 'rencontre-des-influenceurs',
                'type' => 'evenements',
                'extrait' => 'Une session dédiée aux créateurs de contenu pour présenter les nouveautés Bracongo.',
                'contenu' => '<p>Cette rencontre a permis de renforcer les liens avec notre écosystème digital.</p>',
                'image' => 'img/influ.webp',
                'date_publication' => now()->subDay(),
                'date_evenement' => now()->subDay(),
                'lieu' => 'Kinshasa',
                'ordre' => 2,
            ],
            [
                'titre' => 'Soirée festive en championnat',
                'slug' => 'soiree-festive-en-championnat',
                'type' => 'sponsoring',
                'extrait' => 'Une ambiance exceptionnelle lors de notre activation autour du championnat local.',
                'contenu' => '<p>Nos équipes étaient mobilisées pour offrir une expérience premium aux participants.</p>',
                'image' => 'img/champ.webp',
                'date_publication' => now(),
                'date_evenement' => now(),
                'lieu' => 'Stade des Martyrs',
                'whatsapp_url' => 'https://wa.me/243815586874?text='.rawurlencode('Bonjour BRACONGO — Soirée festive'),
                'whatsapp_label' => 'Vivez l’événement avec nous sur WhatsApp',
                'ordre' => 3,
            ],
        ];
        foreach ($news as $n) {
            News::create(array_merge($n, ['is_active' => true]));
        }

        NavigationItem::whereNotNull('parent_id')->delete();
        NavigationItem::query()->delete();
        $menuParents = [
            ['label' => 'Bracongo SA', 'url' => '#', 'ordre' => 1],
            ['label' => 'Nos marques', 'url' => '/Nos-marques', 'ordre' => 2],
            ['label' => 'Actualités & événements', 'url' => '#', 'ordre' => 3],
            ['label' => 'Carrière', 'url' => '#', 'ordre' => 4],
            ['label' => 'Contacts', 'url' => '#', 'ordre' => 5],
            ['label' => 'Bracongo Pro', 'url' => '#', 'ordre' => 6],
            ['label' => 'Boutique', 'url' => '/boutique', 'ordre' => 7],
        ];
        $createdParents = [];
        foreach ($menuParents as $item) {
            $createdParents[] = NavigationItem::create(array_merge($item, ['is_active' => true]));
        }
        $enfants = [
            0 => [
                ['label' => 'Notre historique', 'url' => '/histoire'],
                ['label' => 'Nos valeurs', 'url' => '/histoire#valeurs'],
                ['label' => 'Nos engagements RSE', 'url' => '/histoire#rse'],
                ['label' => 'Présence nationale', 'url' => '/histoire#presence'],
            ],
            1 => [
                ['label' => 'Bières', 'url' => '/Nos-marques-bieres'],
                ['label' => 'Boissons gazeuses', 'url' => '/Nos-marques/gazeuses'],
                ['label' => 'Eaux', 'url' => '/Nos-marques/eaux'],
                ['label' => 'Eaux gazeuses', 'url' => '/Nos-marques/eaux-gazeuses'],
                ['label' => 'Boissons énergisantes', 'url' => '/Nos-marques/energisantes'],
                ['label' => 'Clé des Châteaux', 'url' => '/lacledeschateaux'],
            ],
            2 => [
                ['label' => 'Dernières actualités', 'url' => '/Actualites-et-evenements'],
            ],
            3 => [
                ['label' => 'Nous rejoindre ?', 'url' => '/Carriere'],
            ],
            4 => [
                ['label' => 'Nous écrire', 'url' => '/Contact'],
                ['label' => 'FAQ', 'url' => '/faq'],
            ],
            5 => [
                ['label' => 'Rejoindre Bracongo Pro', 'url' => '/Bracongo-pro'],
            ],
        ];
        foreach ($enfants as $parentIdx => $children) {
            foreach ($children as $i => $child) {
                NavigationItem::create([
                    'label' => $child['label'],
                    'url' => $child['url'],
                    'ordre' => $i + 1,
                    'parent_id' => $createdParents[$parentIdx]->id,
                    'is_active' => true,
                ]);
            }
        }

        FooterSettings::updateOrCreate(['id' => 1], [
            'mission_texte' => '« Assurer une qualité et une disponibilité constantes de nos produits au meilleur prix avec un réseau de distribution complet, rapide et performant »',
            'adresse' => 'Les Boissons Rafraîchissantes du Congo, BRACONGO SA Avenue des Brasseries, N° 7666, Kingabwa, Limete, Kinshasa, RDC',
            'telephone' => '+243 815 586 874',
            'email' => 'bracongo.contact@castel-afrique.com',
            'certification_image' => 'img/image 12.webp',
            'copyright_debut_annee' => 1996,
        ]);

        FooterGallery::query()->delete();
        $gallery = [
            ['image' => 'img/beau.webp', 'alt' => 'Beaufort Gallery', 'ordre' => 1],
            ['image' => 'img/tempo.webp', 'alt' => 'Tempo Gallery', 'ordre' => 2],
            ['image' => 'img/love.webp', 'alt' => 'Love Gallery', 'ordre' => 3],
            ['image' => 'img/for.webp', 'alt' => 'For Gallery', 'ordre' => 4],
            ['image' => 'img/33.webp', 'alt' => '33 Export Gallery', 'ordre' => 5],
            ['image' => 'img/coca.webp', 'alt' => 'Coca Gallery', 'ordre' => 6],
        ];
        foreach ($gallery as $img) {
            FooterGallery::create($img);
        }

        ReseauSocial::query()->delete();
        $reseaux = [
            ['platform' => 'facebook', 'url' => '#', 'is_active' => true, 'ordre' => 1],
            ['platform' => 'instagram', 'url' => '#', 'is_active' => true, 'ordre' => 2],
            ['platform' => 'twitter', 'url' => '#', 'is_active' => true, 'ordre' => 3],
        ];
        foreach ($reseaux as $rs) {
            ReseauSocial::create($rs);
        }

        $superEmail = env('BRACONGO_SUPER_ADMIN_EMAIL', 'superadmin@bracongo.local');
        $superPassword = env('BRACONGO_SUPER_ADMIN_PASSWORD', 'SuperAdmin@123456');
        $superName = env('BRACONGO_SUPER_ADMIN_NAME', 'Super Admin');

        User::updateOrCreate(
            ['email' => $superEmail],
            [
                'name' => $superName,
                'password' => Hash::make($superPassword),
                'role' => UserRole::SuperAdmin->value,
                'status' => UserStatus::Active,
                'email_verified_at' => now(),
                'two_factor_exempt' => true,
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
            ]
        );

        if ($this->command !== null) {
            $this->command->newLine();
            $this->command->warn('[Super admin] Compte technique (2FA exemptée, non listé dans Utilisateurs). Identifiants :');
            $this->command->line('  '.$superEmail);
        }

        $adminEmail = env('BRACONGO_ADMIN_EMAIL', 'admin@bracongo.local');
        $adminPassword = env('BRACONGO_ADMIN_PASSWORD', 'Admin@123456');
        $adminName = env('BRACONGO_ADMIN_NAME', 'Administrateur');

        User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => $adminName,
                'password' => Hash::make($adminPassword),
                'role' => UserRole::Admin->value,
                'status' => UserStatus::Active,
                'email_verified_at' => now(),
                'two_factor_exempt' => true,
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
            ]
        );

        if ($this->command !== null) {
            $this->command->newLine();
            $this->command->warn('[Administrateur] Compte par défaut (2FA requise, listé dans Utilisateurs). Identifiants :');
            $this->command->line('  '.$adminEmail);
        }

        // DatabaseSeeder utilise WithoutModelEvents : les hooks NavigationItem::saved ne tournent pas,
        // donc le cache front n’est pas invalidé automatiquement après le seed.
        foreach ([
            'front.nav_items',
            'front.footer_config',
            'front.footer_gallery',
            'front.reseaux',
            'front.parametres',
            'front.search_data',
        ] as $key) {
            Cache::forget($key);
        }
    }
}
