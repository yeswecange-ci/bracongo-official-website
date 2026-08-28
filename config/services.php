<?php

return [

    // Ajouter ici les services tiers si nécessaire (Mailgun, SES, etc.)

    /*
     * Google Tag Manager : conteneur chargé sur les pages publiques.
     * Vider GOOGLE_TAG_MANAGER_ID dans le .env désactive le tag (utile en local).
     */
    'gtm' => [
        'id' => env('GOOGLE_TAG_MANAGER_ID', 'GTM-T2K7VJP5'),
    ],

];
