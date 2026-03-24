<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\ParametresSite;
use App\Models\PageWelcome;
use App\Models\PageAccueil;
use App\Models\HeroSlide;
use App\Models\PageHistoire;
use App\Models\Valeur;
use App\Models\PageContact;
use App\Models\PageCarriere;
use App\Models\OffreEmploi;
use App\Models\PagePro;
use App\Models\NavigationItem;
use App\Models\FooterSettings;
use App\Models\FooterGallery;
use App\Models\ReseauSocial;
use App\Models\Marque;
use App\Models\Boisson;
use App\Models\Produit;
use App\Models\News;

class BracongoSeeder extends Seeder
{
    public function run(): void
    {
        // Paramètres globaux
        ParametresSite::updateOrCreate(['id' => 1], [
            'logo' => 'img/LOGO BRACONGO copie 1.png',
            'couleur_principale' => '#E30613',
            'search_suggestions' => 'Beaufort Lager,Actualités,Nkoyi,RSE',
        ]);

        // Page Welcome
        PageWelcome::updateOrCreate(['id' => 1], [
            'fond_image' => 'img/fete.png',
            'titre' => 'BIENVENUE SUR LE SITE BRACONGO SA',
            'texte_avertissement' => "Ce site web contient des informations sur nos boissons alcoolisées.\nEn cliquant sur l'un des boutons ci-dessous, vous confirmez être majeur dans votre pays de résidence.",
            'btn_majeur_texte' => "J'ai plus de 18 ans",
            'btn_mineur_texte' => "J'ai moins de 18 ans",
            'message_refus' => "Nous sommes désolés, vous n'avez pas l'âge requis pour accéder à ce site.",
        ]);

        // Page Accueil
        PageAccueil::updateOrCreate(['id' => 1], [
            'qui_titre' => 'Qui sommes-nous ?',
            'qui_texte' => "Lorem ipsum dolor sit amet consectetur. Nec augue tortor cursus vulputate ultricies mattis a. Bibendum gravida morbi urna at id dui vitae. Massa bibendum magna in quis amet neque neque diam eget. Tincidunt scelerisque mattis at habitant malesuada congue. Ut malesuada ac mauris amet non sit lobortis proin.",
            'qui_image_fond' => 'img/brasserie.jpg',
            'qui_cta_texte' => 'Lire plus',
            'qui_cta_lien' => '/histoire',
            'marques_titre' => 'Nos marques',
            'marques_description' => "Lorem ipsum dolor sit amet consectetur. Nec augue tortor cursus vulputate ultricies mattis a. Bibendum gravida morbi urna at id dui vitae. Lorem ipsum dolor sit amet consectetur. Nec augue tortor cursus.",
            'rejoignez_titre' => 'Rejoignez nous',
            'rejoignez_texte' => "Employer et former les bonnes personnes pour le poste est la clé de notre succès. Notre aspiration est d'offrir le meilleur à nos clients et consommateurs et d'offrir des produits de qualité à des prix abordables. Si vous appréciez l'action, la qualité et l'intégrité, notre entreprise est l'endroit idéal pour vous",
            'rejoignez_image' => 'img/rejoignez.png',
            'rejoignez_cta_texte' => "Voir nos offres d'emploi",
            'rejoignez_cta_lien' => '/Carriere',
            'actualites_titre' => 'Dernières actualités',
            'actualites_voir_plus_lien' => '/Actualités-et-evenements',
        ]);

        // Hero slides
        HeroSlide::truncate();
        $slides = [
            ['image' => 'img/coverhome.jpg', 'alt' => 'Beaufort Hero', 'ordre' => 1, 'is_active' => true],
            ['image' => 'img/banniere.jpg', 'alt' => 'Tembo Hero', 'ordre' => 2, 'is_active' => true],
        ];
        foreach ($slides as $slide) {
            HeroSlide::create($slide);
        }

        // Page Histoire
        PageHistoire::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/bracongo.jpg',
            'titre' => 'Notre histoire',
            'paragraphe_1' => "Lorem ipsum dolor sit amet consectetur. Sapien fusce scelerisque condimentum iaculis viverra aliquam varius. Senectus tristique dapibus aliquet faucibus semper euismod nibh mauris leo. Sed adipiscing faucibus cursus scelerisque non turpis pellentesque.",
            'paragraphe_2' => "Lorem ipsum dolor sit amet consectetur. Sapien fusce scelerisque condimentum iaculis viverra aliquam varius. Senectus tristique dapibus aliquet faucibus semper euismod nibh mauris leo. Sed adipiscing faucibus cursus scelerisque non turpis pellentesque.",
            'paragraphe_3' => "Lorem ipsum dolor sit amet consectetur. Sapien fusce scelerisque condimentum iaculis viverra aliquam varius. Senectus tristique dapibus aliquet faucibus semper euismod nibh mauris leo. Sed adipiscing faucibus cursus scelerisque non turpis pellentesque.",
            'image_brasserie' => 'img/Frame-115.png',
            'rse_texte' => "Lorem ipsum dolor sit amet consectetur. Ultricies nulla at tincidunt orci et. Adipiscing risus dictum ullamcorper massa sit mattis suspendisse orci netus.",
            'rse_image' => 'img/Frame 33.png',
            'rse_cta_texte' => 'En savoir plus sur nos engagements RSE',
            'rse_cta_lien' => '#',
            'maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3978.508544403328!2d15.352467376045353!3d-4.332304995641773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a6a33f44498394b%3A0xf6396e9803277785!2sBracongo!5e0!3m2!1sfr!2scd!4v1710680000000!5m2!1sfr!2scd',
            'presence_note' => '* Cliquez sur la carte pour explorer nos différents centres de distribution à travers le pays.',
        ]);

        // Valeurs PREMIERS
        Valeur::truncate();
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

        // Page Contact
        PageContact::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/bracongo.jpg',
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

        // Page Carrière
        PageCarriere::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/rejoins.png',
            'texte_intro' => "Employer et former les bonnes personnes pour le poste est la clé de notre succès. Notre aspiration est d'offrir le meilleur à nos clients et consommateurs et d'offrir des produits de qualité à des prix abordables. Si vous appréciez l'action, la qualité et l'intégrité, notre entreprise est l'endroit idéal pour vous",
        ]);

        // Offres d'emploi
        OffreEmploi::truncate();
        $offres = [
            [
                'titre' => "Responsable Sécurité des Systèmes d'information",
                'description' => "<p>BRACONGO recherche un(e) Responsable Sécurité des Systèmes d'information pour piloter la stratégie de cybersécurité et garantir la protection des actifs numériques de l'entreprise.</p><p>Ce poste stratégique, rattaché au Département des Systèmes d'Information, implique une étroite collaboration avec les équipes informatiques, la direction générale et les référents sécurité du groupe.</p><p><strong>Prêt(e) à relever le défi ? Postulez dès maintenant !</strong></p>",
                'image' => 'img/secu.jpg',
                'lien' => '#',
                'is_active' => true,
                'ordre' => 1,
            ],
            [
                'titre' => 'Ingénieur de Maintenance Industrielle',
                'description' => "<p>Garantissez la performance de nos lignes de production en pilotant les interventions préventives et curatives.</p><p>Expert technique, vous veillez à la sécurité des installations et à l'optimisation des coûts de maintenance.</p><p><strong>Mettez votre expertise au service de l'excellence industrielle.</strong></p>",
                'image' => 'img/brasserie.jpg',
                'lien' => '#',
                'is_active' => true,
                'ordre' => 2,
            ],
            [
                'titre' => 'Analyste Financier Senior',
                'description' => "<p>Accompagnez la direction dans le pilotage de la performance économique de l'entreprise.</p><p>Vous assurez le contrôle budgétaire, l'analyse des écarts et proposez des plans d'actions correctifs.</p><p><strong>Un rôle clé au cœur de la stratégie financière.</strong></p>",
                'image' => 'img/rejoignez.png',
                'lien' => '#',
                'is_active' => true,
                'ordre' => 3,
            ],
        ];
        foreach ($offres as $offre) {
            OffreEmploi::create($offre);
        }

        // Page Pro
        PagePro::updateOrCreate(['id' => 1], [
            'hero_image' => 'img/brcpro.png',
            'description' => "Bracongo Pro est l'application mobile pensée pour les ténanciers de bars, clients fidèles de Bracongo. Simple, intuitive et 100% mobile, elle facilite la gestion quotidienne des achats, permet un suivi personnalisé et rapproche encore plus les utilisateurs des services Bracongo dans un secteur en pleine digitalisation.",
            'pourquoi_titre' => 'Pourquoi choisir Bracongo Pro?',
            'pourquoi_intro' => "Dans une dynamique citoyenne et innovante, Bracongo met à disposition de ses partenaires une solution numérique conçue pour:",
            'pourquoi_items' => "<ul><li><strong>Informer:</strong> Recevez, au quotidien, le détail de vos achats, montants payés et remises sur une interface claire.</li><li><strong>Consulter les tarifs:</strong> Accédez instantanément à tous les produits Bracongo et comparez les formats et les prix pour mieux piloter votre activité.</li><li><strong>Gérer votre profil:</strong> Retrouvez toutes vos informations client (nom, code, circuit, centre de distribution) en un clic.</li><li><strong>Suivre les livraisons:</strong> Localisez la position du camion de votre circuit en temps réel sur la carte, pour planifier vos réceptions en toute sérénité.</li><li><strong>Satisfaire vos besoins:</strong> Adressez vos réclamations directement par l'application, suivez l'état de votre demande et bénéficiez d'une prise en charge optimisée.</li></ul>",
            'fonctionnalites_titre' => 'Fonctionnalités clés',
            'fonctionnalites_items' => "<ul><li><strong>Accueil personnalisé:</strong> Visualisez votre catégorie client, vos chiffres du mois et les réductions appliquées.</li><li><strong>Historique complet:</strong> Tableaux et graphiques présentant la progression de vos achats, volumes et montants détaillés par période.</li><li><strong>Module Camion:</strong> Suivi géolocalisé du camion SRD avec historique de passage.</li><li><strong>Gestion des plaintes:</strong> Suivi des réclamations avec notifications à chaque étape.</li><li><strong>Catalogue produits:</strong> Galerie de produits Bracongo avec images, tarifs et formats.</li></ul>",
            'app_image' => 'img/tel.png',
            'cta_texte' => 'Télécharger Bracongo pro',
            'cta_lien' => '#',
            'pdf_lien' => null,
        ]);

        // Marques et Boissons (basé sur bracongo.cd)
        Schema::disableForeignKeyConstraints();
        Boisson::truncate();
        Marque::truncate();
        Schema::enableForeignKeyConstraints();

        $marquesBieres = [
            ['nom' => 'Beaufort', 'slug' => 'beaufort', 'categorie' => 'bieres', 'image' => 'img/beaufort.png', 'image_banner' => 'img/beauban.jpg', 'lien' => '/Nos-marques-bieres', 'ordre' => 1],
            ['nom' => 'Castel Beer', 'slug' => 'castel-beer', 'categorie' => 'bieres', 'image' => 'img/castel.png', 'image_banner' => null, 'lien' => '/Nos-marques-bieres', 'ordre' => 2],
            ['nom' => 'Doppel Munich', 'slug' => 'doppel-munich', 'categorie' => 'bieres', 'image' => 'img/dopel.png', 'image_banner' => null, 'lien' => '/Nos-marques-bieres', 'ordre' => 3],
            ['nom' => 'Nkoyi', 'slug' => 'nkoyi', 'categorie' => 'bieres', 'image' => 'img/blonde.png', 'image_banner' => null, 'lien' => '/Nos-marques-bieres', 'ordre' => 4],
            ['nom' => '33 Export', 'slug' => '33-export', 'categorie' => 'bieres', 'image' => 'img/33b.png', 'image_banner' => null, 'lien' => '/Nos-marques-bieres', 'ordre' => 5],
            ['nom' => 'TEMBO', 'slug' => 'tembo', 'categorie' => 'bieres', 'image' => 'img/tembo.png', 'image_banner' => null, 'lien' => '/Nos-marques-bieres', 'ordre' => 6],
        ];
        foreach ($marquesBieres as $m) {
            Marque::create(array_merge($m, ['is_active' => true]));
        }

        $marquesAutres = [
            ['nom' => 'Boissons gazeuses', 'slug' => 'boissons-gazeuses', 'categorie' => 'gazeuses', 'image' => 'img/gazeux.png', 'lien' => '#', 'ordre' => 1],
            ['nom' => 'Eaux', 'slug' => 'eaux', 'categorie' => 'eaux', 'image' => 'img/eau.png', 'lien' => '#', 'ordre' => 2],
            ['nom' => 'Boissons énergisantes', 'slug' => 'boissons-energisantes', 'categorie' => 'energisantes', 'image' => 'img/energie.png', 'lien' => '#', 'ordre' => 3],
        ];
        foreach ($marquesAutres as $m) {
            Marque::create(array_merge($m, ['image_banner' => null, 'is_active' => true]));
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
                'nom' => 'Beaufort Lager',
                'slug' => 'beaufort-lager',
                'description' => "est une bière précieuse et distinguée qui célèbre et prône l'excellence. Depuis 1952, seuls les meilleurs ingrédients sont sélectionnés pour assurer une qualité exceptionnelle à cette bière blonde. Son processus de fabrication ne tolère que la perfection. Sa mousse fine et ses reflets dorés laissent présager une bière d'exception.",
                'hero_image' => 'img/beauban.jpg',
                'image' => 'img/beaufort.png',
                'logo' => 'img/logob.png',
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
            ['marque_id' => $castel->id, 'nom' => 'Castel Beer', 'slug' => 'castel-beer', 'image' => 'img/marron.png', 'ordre' => 1],
            ['marque_id' => $doppel->id, 'nom' => 'Doppel Munich', 'slug' => 'doppel-munich', 'image' => 'img/dopel.png', 'ordre' => 1],
            ['marque_id' => $nkoyi->id, 'nom' => 'Nkoyi Blonde', 'slug' => 'nkoyi-blonde', 'image' => 'img/blonde.png', 'ordre' => 1],
            ['marque_id' => $nkoyi->id, 'nom' => 'Nkoyi Black', 'slug' => 'nkoyi-black', 'image' => 'img/black.png', 'ordre' => 2],
            ['marque_id' => $export33->id, 'nom' => '33 Export', 'slug' => '33-export', 'image' => 'img/33b.png', 'ordre' => 1],
            ['marque_id' => $tembo->id, 'nom' => 'TEMBO', 'slug' => 'tembo', 'image' => 'img/tembo.png', 'ordre' => 1],
        ];
        foreach ($boissons as $b) {
            Boisson::create(array_merge($b, ['is_active' => true]));
        }

        // Produits (goodies - vide pour l'instant, backend only)
        Produit::truncate();

        // News (actualités, événements, etc.)
        News::truncate();
        $news = [
            ['titre' => 'Actualité exemple', 'slug' => 'actualite-exemple', 'type' => 'actualites', 'extrait' => 'Lorem ipsum...', 'date_publication' => now(), 'ordre' => 1],
        ];
        foreach ($news as $n) {
            News::create(array_merge($n, ['is_active' => true]));
        }

        // Navigation
        NavigationItem::truncate();
        $menuParents = [
            ['label' => 'Bracongo SA', 'url' => '#', 'ordre' => 1],
            ['label' => 'Nos marques', 'url' => '/Nos-marques', 'ordre' => 2],
            ['label' => 'Actualités & événements', 'url' => '#', 'ordre' => 3],
            ['label' => 'Carrière', 'url' => '#', 'ordre' => 4],
            ['label' => 'Contacts', 'url' => '#', 'ordre' => 5],
            ['label' => 'Bracongo Pro', 'url' => '#', 'ordre' => 6],
            ['label' => 'FAQ', 'url' => '#', 'ordre' => 7],
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
                ['label' => 'Boissons gazeuses', 'url' => '#'],
                ['label' => 'Eaux', 'url' => '#'],
                ['label' => 'Boissons énergisantes', 'url' => '#'],
            ],
            2 => [
                ['label' => 'Dernières actualités', 'url' => '/Actualités-et-evenements'],
            ],
            3 => [
                ['label' => 'Nous rejoindre ?', 'url' => '/Carriere'],
            ],
            4 => [
                ['label' => 'Nous écrire', 'url' => '/Contact'],
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

        // Footer
        FooterSettings::updateOrCreate(['id' => 1], [
            'mission_texte' => "« Assurer une qualité et une disponibilité constantes de nos produits au meilleur prix avec un réseau de distribution complet, rapide et performant »",
            'adresse' => 'Les Boissons Rafraîchissantes du Congo, BRACONGO SA Avenue des Brasseries, N° 7666, Kingabwa, Limete, Kinshasa, RDC',
            'telephone' => '+243 815 586 874',
            'email' => 'bracongo.contact@castel-afrique.com',
            'certification_image' => 'img/image 12.png',
            'copyright_debut_annee' => 1996,
        ]);

        // Footer gallery
        FooterGallery::truncate();
        $gallery = [
            ['image' => 'img/beau.png', 'alt' => 'Beaufort Gallery', 'ordre' => 1],
            ['image' => 'img/tempo.png', 'alt' => 'Tempo Gallery', 'ordre' => 2],
            ['image' => 'img/love.png', 'alt' => 'Love Gallery', 'ordre' => 3],
            ['image' => 'img/for.png', 'alt' => 'For Gallery', 'ordre' => 4],
            ['image' => 'img/33.png', 'alt' => '33 Export Gallery', 'ordre' => 5],
            ['image' => 'img/coca.png', 'alt' => 'Coca Gallery', 'ordre' => 6],
        ];
        foreach ($gallery as $img) {
            FooterGallery::create($img);
        }

        // Réseaux sociaux
        ReseauSocial::truncate();
        $reseaux = [
            ['platform' => 'facebook', 'url' => '#', 'is_active' => true, 'ordre' => 1],
            ['platform' => 'instagram', 'url' => '#', 'is_active' => true, 'ordre' => 2],
            ['platform' => 'twitter', 'url' => '#', 'is_active' => true, 'ordre' => 3],
        ];
        foreach ($reseaux as $rs) {
            ReseauSocial::create($rs);
        }
    }
}
