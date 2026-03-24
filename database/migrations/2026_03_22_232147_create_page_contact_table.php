<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_contact', function (Blueprint $table) {
            $table->id();
            $table->string('hero_image')->default('img/bracongo.jpg');
            $table->string('hero_titre')->default('Nos Contacts');
            $table->text('denomination')->default('Les Boissons Rafraîchissantes du Congo, BRACONGO SA');
            $table->text('adresse')->default('Avenue des Brasseries, numéro 7666, Quartier Kingabwa, Commune de Limete, dans la province de Kinshasa, en République Démocratique du Congo.');
            $table->string('bp')->default('BP: 7.600 KINSHASA 1');
            $table->string('email')->default('bracongo.contact@castel-afrique.com');
            $table->string('tel_consommateurs')->default('0815586874');
            $table->string('tel_fetes')->default('082 850 00 56');
            $table->string('tel_fournisseurs')->default('082 850 04 60');
            $table->string('tel_cle_chateaux')->default('082 850 00 40');
            $table->string('devenir_client_lien')->default('#');
            $table->string('form_titre')->default('Nous contacter');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_contact');
    }
};
