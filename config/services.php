<?php

return [

    // Ajouter ici les services tiers si nécessaire (Mailgun, SES, etc.)

    /*
     * Google Analytics 4, charge sur les pages publiques.
     * Vider GOOGLE_ANALYTICS_ID dans le .env desactive le tag (utile en local)
     * et retire du meme coup la banniere cookies, sans objet sans mesure.
     */
    'ga4' => [
        'id' => env('GOOGLE_ANALYTICS_ID', 'G-1DQ77CH7PG'),
    ],

];
