@php($ga4Id = config('services.ga4.id'))
@if(filled($ga4Id))
{{-- Consentement : tout est refusé par défaut, l'utilisateur décide via la bannière.
     Doit rester AVANT le tag pour qu'il démarre bridé. --}}
<script>
(function (w) {
    var KEY = 'bracongo_consent';
    var DUREE = 15552000000; // 6 mois : durée de conservation du choix recommandée par la CNIL

    w.dataLayer = w.dataLayer || [];
    function gtag() { w.dataLayer.push(arguments); }

    function signaux(etat) {
        return {
            ad_storage: etat,
            ad_user_data: etat,
            ad_personalization: etat,
            analytics_storage: etat,
            functionality_storage: etat,
            personalization_storage: etat,
            security_storage: 'granted' // strictement necessaire, hors consentement
        };
    }

    // Un choix absent, illisible ou perime vaut « pas de choix » : la banniere sera reposee.
    function lire() {
        try {
            var brut = w.localStorage.getItem(KEY);
            if (!brut) return null;
            var enregistre = JSON.parse(brut);
            if (!enregistre || (Date.now() - enregistre.ts) > DUREE) return null;

            return enregistre.choix === 'granted' ? 'granted' : 'denied';
        } catch (e) {
            return null; // navigation privee ou stockage bloque
        }
    }

    var choix = lire();
    gtag('consent', 'default', signaux(choix === 'granted' ? 'granted' : 'denied'));

    w.bracongoConsent = {
        choix: choix,
        definir: function (etat) {
            etat = etat === 'granted' ? 'granted' : 'denied';
            gtag('consent', 'update', signaux(etat));
            w.dataLayer.push({ event: 'consent_update', consent_state: etat });
            try {
                w.localStorage.setItem(KEY, JSON.stringify({ choix: etat, ts: Date.now() }));
            } catch (e) {}
            w.bracongoConsent.choix = etat;
        }
    };
})(window);
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $ga4Id }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '{{ $ga4Id }}');
</script>
@endif
