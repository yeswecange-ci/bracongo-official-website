<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * FAQ éditable depuis le back-office.
 *
 * Le contenu par défaut (repris à l'identique de l'ancienne page statique)
 * est inséré ici et non dans le seeder : la production n'exécute que
 * `migrate --force`, jamais les seeders, qui écraseraient le contenu saisi
 * par le client.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faq_sections', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('icone')->default('question');
            $table->unsignedTinyInteger('ordre')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('faq_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faq_section_id')->constrained('faq_sections')->cascadeOnDelete();
            $table->string('question');
            $table->text('reponse');
            $table->unsignedTinyInteger('ordre')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['faq_section_id', 'ordre']);
        });

        $this->insererContenuParDefaut();
    }

    public function down(): void
    {
        Schema::dropIfExists('faq_questions');
        Schema::dropIfExists('faq_sections');
    }

    private function insererContenuParDefaut(): void
    {
        $maintenant = Carbon::now();

        foreach ($this->contenuParDefaut() as $ordreSection => $section) {
            $sectionId = DB::table('faq_sections')->insertGetId([
                'titre' => $section['titre'],
                'icone' => $section['icone'],
                'ordre' => $ordreSection,
                'is_active' => true,
                'created_at' => $maintenant,
                'updated_at' => $maintenant,
            ]);

            $lignes = [];
            foreach ($section['questions'] as $ordreQuestion => $question) {
                $lignes[] = [
                    'faq_section_id' => $sectionId,
                    'question' => $question['q'],
                    'reponse' => $question['r'],
                    'ordre' => $ordreQuestion,
                    'is_active' => true,
                    'created_at' => $maintenant,
                    'updated_at' => $maintenant,
                ];
            }

            DB::table('faq_questions')->insert($lignes);
        }
    }

    /**
     * @return array<int, array{titre: string, icone: string, questions: array<int, array{q: string, r: string}>}>
     */
    private function contenuParDefaut(): array
    {
        return [
            [
                'titre' => 'À propos de Bracongo',
                'icone' => 'batiment',
                'questions' => [
                    [
                        'q' => "Qu'est-ce que Bracongo ?",
                        'r' => "Bracongo S.A. (Les Boissons Rafraîchissantes du Congo) est l'une des principales brasseries de la République Démocratique du Congo. Elle produit et distribue une large gamme de bières, boissons gazeuses, eaux et boissons énergisantes à travers tout le pays.",
                    ],
                    [
                        'q' => 'Où se trouvent vos installations ?',
                        'r' => "Notre siège social et notre principale unité de production sont situés Avenue des Brasseries, N° 7666, Kingabwa, Limete, Kinshasa, RDC. Nous disposons également de plusieurs centres de distribution à travers le territoire national pour assurer une disponibilité constante de nos produits.",
                    ],
                    [
                        'q' => "Bracongo fait-elle partie d'un groupe international ?",
                        'r' => "Oui, Bracongo est une filiale du Groupe Castel, l'un des plus grands groupes agroalimentaires africains, présent dans plus de 21 pays du continent.",
                    ],
                ],
            ],
            [
                'titre' => 'Nos produits',
                'icone' => 'produits',
                'questions' => [
                    [
                        'q' => 'Quelles sont les marques produites par Bracongo ?',
                        'r' => "Bracongo produit une gamme complète de boissons : des bières (Beaufort, Tembo — disponible en 50 cl —, Nkoyi, Castel Beer, 33 Export, Doppel Munich), des boissons gazeuses (World Cola — dont l'édition limitée « Cola Na Biso » —, Youzou, Top Tropical), des eaux (Eau Vive) et des boissons énergisantes (XXL Energy). Consultez notre page \"Nos marques\" pour découvrir l'ensemble du catalogue.",
                    ],
                    [
                        'q' => 'Vos produits respectent-ils des normes de qualité ?',
                        'r' => "Absolument. Bracongo est certifiée ISO et applique des processus de contrôle qualité stricts à chaque étape de la production, du brassage à la mise en bouteille, conformément aux standards internationaux du Groupe Castel.",
                    ],
                    [
                        'q' => 'Comment signaler un problème de qualité sur un produit ?',
                        'r' => "Si vous constatez un défaut sur l'un de nos produits, vous pouvez nous contacter directement via notre page Contact ou appeler notre service consommateurs. Conservez le produit et notez la date de fabrication et le code lot indiqués sur l'emballage.",
                    ],
                ],
            ],
            [
                'titre' => 'Commandes & distribution',
                'icone' => 'livraison',
                'questions' => [
                    [
                        'q' => 'Comment devenir revendeur ou distributeur Bracongo ?',
                        'r' => "Pour devenir partenaire commercial (revendeur, bar, restaurant, hôtel ou grossiste), rendez-vous sur notre page Contact et renseignez le formulaire \"Devenir client\". Notre équipe commerciale vous contactera dans les meilleurs délais pour étudier votre demande.",
                    ],
                    [
                        'q' => 'Puis-je commander directement auprès de Bracongo en tant que particulier ?',
                        'r' => "Bracongo distribue ses produits exclusivement via son réseau de revendeurs agréés (supermarchés, épiceries, bars, restaurants). Pour des commandes en grande quantité ou des événements, contactez-nous via notre formulaire dédié.",
                    ],
                    [
                        'q' => 'Bracongo assure-t-elle des livraisons à domicile ?',
                        'r' => "La livraison à domicile n'est pas un service assuré directement par Bracongo. Nous vous recommandons de vous rapprocher de l'un de nos revendeurs agréés dans votre zone géographique.",
                    ],
                    [
                        'q' => 'Comment localiser un point de vente près de chez moi ?',
                        'r' => "Nos produits sont disponibles dans la grande majorité des épiceries, supermarchés et points de vente sur l'ensemble du territoire. Consultez notre carte de présence sur la page \"Notre histoire\" pour localiser les centres de distribution les plus proches.",
                    ],
                ],
            ],
            [
                'titre' => 'Application Bracongo Pro',
                'icone' => 'mobile',
                'questions' => [
                    [
                        'q' => "Qu'est-ce que l'application Bracongo Pro ?",
                        'r' => "Bracongo Pro est notre application mobile dédiée aux professionnels (revendeurs, gérants de bars, restaurateurs). Elle permet de passer des commandes, suivre les livraisons, consulter les tarifs et accéder aux offres promotionnelles en temps réel.",
                    ],
                    [
                        'q' => 'Comment télécharger et accéder à Bracongo Pro ?',
                        'r' => "L'application Bracongo Pro est disponible sur les principales plateformes mobiles. Rendez-vous sur notre page dédiée \"Bracongo Pro\" pour obtenir le lien de téléchargement et les instructions d'activation de votre compte professionnel.",
                    ],
                    [
                        'q' => "L'application est-elle gratuite ?",
                        'r' => "Oui, l'application Bracongo Pro est entièrement gratuite pour tous nos partenaires commerciaux enregistrés. L'accès est réservé aux professionnels titulaires d'un compte Bracongo actif.",
                    ],
                ],
            ],
            [
                'titre' => 'Carrière & recrutement',
                'icone' => 'carriere',
                'questions' => [
                    [
                        'q' => "Comment postuler à une offre d'emploi chez Bracongo ?",
                        'r' => "Toutes nos offres d'emploi actives sont publiées sur notre page \"Carrière\". Pour postuler, sélectionnez l'offre qui vous intéresse et remplissez le formulaire de candidature en ligne en joignant votre CV (PDF, DOC ou DOCX, max 5 Mo).",
                    ],
                    [
                        'q' => 'Puis-je soumettre une candidature spontanée ?',
                        'r' => "Oui. Même en l'absence d'offre correspondant à votre profil, vous pouvez nous adresser une candidature spontanée via notre page Contact en précisant le poste et le service souhaités.",
                    ],
                    [
                        'q' => 'Quel est le délai de réponse après une candidature ?',
                        'r' => "Notre équipe RH traite chaque candidature et revient vers les profils retenus dans un délai de deux à quatre semaines suivant la réception du dossier.",
                    ],
                ],
            ],
            [
                'titre' => 'Contact & support',
                'icone' => 'contact',
                'questions' => [
                    [
                        'q' => 'Comment contacter Bracongo ?',
                        'r' => "Vous pouvez nous joindre via le formulaire de contact sur notre site, par téléphone au {telephone}, ou par e-mail. Retrouvez toutes nos coordonnées sur la page Contact.",
                    ],
                    [
                        'q' => 'Bracongo est-elle présente sur les réseaux sociaux ?',
                        'r' => "Oui, suivez-nous sur nos réseaux sociaux officiels (Facebook, Instagram, YouTube…) pour rester informé de nos actualités, promotions et événements. Les liens sont disponibles en pied de page du site.",
                    ],
                    [
                        'q' => 'Ma question ne figure pas dans cette FAQ, que faire ?',
                        'r' => "Si votre question n'a pas trouvé de réponse ici, n'hésitez pas à nous contacter directement via notre formulaire de contact. Notre équipe vous répondra dans les meilleurs délais.",
                    ],
                ],
            ],
        ];
    }
};
