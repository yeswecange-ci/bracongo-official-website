@php($ga4Id = config('services.ga4.id'))
@if(filled($ga4Id))
<div id="cookie-consent" role="dialog" aria-labelledby="cookie-consent-titre" aria-describedby="cookie-consent-texte"
     class="hidden fixed inset-x-0 bottom-0 z-[10000] p-4 sm:p-6">
    <div class="mx-auto max-w-5xl bg-white rounded-2xl shadow-2xl ring-1 ring-black/10 p-6 sm:p-7 flex flex-col lg:flex-row lg:items-center gap-6">
        <div class="flex-1">
            <h2 id="cookie-consent-titre" class="text-base font-bold text-gray-900">Votre choix en matière de cookies</h2>
            <p id="cookie-consent-texte" class="mt-2 text-sm text-gray-600 leading-relaxed">
                Nous utilisons des cookies de mesure d'audience pour comprendre comment le site est consulté et
                l'améliorer. Ils ne sont déposés qu'avec votre accord. Vous pouvez revenir sur votre choix à tout
                moment via « Gérer les cookies » en bas de page.
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 shrink-0">
            <button type="button" data-consent="granted"
                    class="px-6 py-2.5 rounded-full bg-bracongo text-white text-sm font-bold hover:opacity-90 transition-opacity">
                Tout accepter
            </button>
            <button type="button" data-consent="denied"
                    class="px-6 py-2.5 rounded-full border border-gray-300 text-gray-700 text-sm font-bold hover:bg-gray-50 transition-colors">
                Continuer sans accepter
            </button>
        </div>
    </div>
</div>
<script>
(function () {
    var banniere = document.getElementById('cookie-consent');
    var consent = window.bracongoConsent;
    if (!banniere || !consent) return;

    function afficher() { banniere.classList.remove('hidden'); }
    function masquer() { banniere.classList.add('hidden'); }

    // Aucun choix encore exprime (ou choix perime) : on le demande.
    if (consent.choix === null) {
        afficher();
    }

    banniere.querySelectorAll('[data-consent]').forEach(function (bouton) {
        bouton.addEventListener('click', function () {
            consent.definir(bouton.getAttribute('data-consent'));
            masquer();
        });
    });

    // « Gérer les cookies » (pied de page) : permet de revenir sur son choix.
    document.querySelectorAll('[data-consent-reouvrir]').forEach(function (lien) {
        lien.addEventListener('click', function (e) {
            e.preventDefault();
            afficher();
            banniere.querySelector('[data-consent]').focus();
        });
    });
})();
</script>
@endif
