/**
 * Éditeur de texte enrichi pour les champs éditoriaux du back-office.
 *
 * Transforme chaque <textarea data-rich-text> en éditeur CKEditor 5, afin que
 * le rédacteur mette en gras, insère un lien ou passe à la ligne sans écrire
 * de HTML.
 *
 * La barre d'outils est volontairement limitée aux mises en forme que
 * CmsHtmlSanitizer conserve à l'affichage (app/Support/CmsHtmlSanitizer.php) :
 * un tableau, une image ou un alignement seraient supprimés côté public, donc
 * on ne les propose pas plutôt que de laisser le rédacteur perdre son travail.
 */
(function () {
    'use strict';

    var CHAMPS = 'textarea[data-rich-text]';

    var CONFIG = {
        language: 'fr',
        toolbar: [
            'heading', '|',
            'bold', 'italic', 'underline', '|',
            'link', '|',
            'bulletedList', 'numberedList', 'blockQuote', '|',
            'undo', 'redo'
        ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraphe', class: 'ck-heading_paragraph' },
                { model: 'heading2', view: 'h2', title: 'Titre', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Sous-titre', class: 'ck-heading_heading3' }
            ]
        },
        link: {
            // Un lien vers un autre site s'ouvre dans un nouvel onglet, sans que
            // le rédacteur ait à s'en occuper. Le sanitizer accepte target/rel.
            addTargetToExternalLinks: true
        }
    };

    function activer(champ) {
        ClassicEditor.create(champ, CONFIG)
            .then(function (editor) {
                var formulaire = champ.form;
                if (!formulaire) {
                    return;
                }

                // Filet de sécurité : on réécrit le textarea juste avant l'envoi
                // au lieu de dépendre de la synchronisation implicite du build.
                formulaire.addEventListener('submit', function () {
                    editor.updateSourceElement();
                });
            })
            .catch(function (erreur) {
                // En cas d'échec, le textarea reste affiché et utilisable tel quel.
                console.error('Éditeur enrichi indisponible :', erreur);
            });
    }

    function init() {
        var champs = document.querySelectorAll(CHAMPS);
        if (champs.length === 0) {
            return;
        }

        if (typeof ClassicEditor === 'undefined') {
            console.error('Éditeur enrichi : CKEditor n’a pas été chargé.');
            return;
        }

        champs.forEach(activer);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
