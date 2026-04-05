<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // boissons : filtre actif+catégorie+ordre utilisé sur toutes les pages marques
        Schema::table('boissons', function (Blueprint $table) {
            $table->index(['is_active', 'categorie', 'ordre'], 'boissons_active_cat_ordre');
            $table->index('marque_id', 'boissons_marque_id');
        });

        // news : filtre actif+type+date utilisé sur actualités et accueil
        Schema::table('news', function (Blueprint $table) {
            $table->index(['is_active', 'type', 'date_publication'], 'news_active_type_date');
        });

        // offres_emploi : filtre actif+ordre utilisé sur carrière
        Schema::table('offres_emploi', function (Blueprint $table) {
            $table->index(['is_active', 'ordre'], 'offres_emploi_active_ordre');
        });

        // navigation_items : filtre actif+parent_id utilisé par le menu
        Schema::table('navigation_items', function (Blueprint $table) {
            $table->index(['is_active', 'parent_id'], 'nav_items_active_parent');
        });

        // messages_contact : filtre lu utilisé dans le dashboard admin
        Schema::table('messages_contact', function (Blueprint $table) {
            $table->index('lu', 'messages_contact_lu');
        });
    }

    public function down(): void
    {
        Schema::table('boissons', function (Blueprint $table) {
            $table->dropIndex('boissons_active_cat_ordre');
            $table->dropIndex('boissons_marque_id');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropIndex('news_active_type_date');
        });

        Schema::table('offres_emploi', function (Blueprint $table) {
            $table->dropIndex('offres_emploi_active_ordre');
        });

        Schema::table('navigation_items', function (Blueprint $table) {
            $table->dropIndex('nav_items_active_parent');
        });

        Schema::table('messages_contact', function (Blueprint $table) {
            $table->dropIndex('messages_contact_lu');
        });
    }
};
