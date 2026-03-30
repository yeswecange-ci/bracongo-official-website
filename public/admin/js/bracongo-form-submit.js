/**
 * Verrouille les soumissions de formulaires pour éviter les doubles envois.
 * - Compatible avec data-bracongo-confirm (SweetAlert)
 * - Désactive les boutons submit
 * - Affiche un spinner sur le bouton déclencheur
 */
(function () {
    'use strict';

    var FLAG_SUBMITTING = 'data-bc-submitting';
    var FLAG_PASS_CONFIRM = 'data-bc-pass';
    var FLAG_LAST_SUBMITTER = 'data-bc-last-submitter-id';
    var submitterSeed = 0;

    function isForm(el) {
        return el instanceof HTMLFormElement;
    }

    function shouldHandle(form) {
        if (!isForm(form)) return false;
        if (form.hasAttribute('data-bc-no-submit-lock')) return false;

        var method = (form.getAttribute('method') || 'GET').toUpperCase();
        return method !== 'GET';
    }

    function isWaitingForConfirm(form) {
        return form.hasAttribute('data-bracongo-confirm') && form.getAttribute(FLAG_PASS_CONFIRM) !== '1';
    }

    function getLoadingText(form, submitter) {
        if (submitter) {
            var submitterText = submitter.getAttribute('data-bc-loading-text');
            if (submitterText) return submitterText;
        }

        var formText = form.getAttribute('data-bc-loading-text');
        return formText || 'Traitement en cours...';
    }

    function ensureSubmitterId(submitter) {
        if (!submitter) return null;
        if (!submitter.id) {
            submitterSeed += 1;
            submitter.id = 'bc-submitter-' + submitterSeed;
        }

        return submitter.id;
    }

    function getTrackedSubmitter(form) {
        var id = form.getAttribute(FLAG_LAST_SUBMITTER);
        if (!id) return null;

        var el = document.getElementById(id);
        if (!el) return null;
        if (el.form !== form) return null;
        if (
            !(el instanceof HTMLButtonElement) &&
            !(el instanceof HTMLInputElement && el.type === 'submit')
        ) {
            return null;
        }

        return el;
    }

    function setLoadingState(form, submitter) {
        form.setAttribute(FLAG_SUBMITTING, '1');
        form.setAttribute('aria-busy', 'true');

        var buttons = form.querySelectorAll('button[type="submit"], input[type="submit"]');
        buttons.forEach(function (btn) {
            btn.disabled = true;
            btn.classList.add('a-btn-loading-disabled');
        });

        var loadingText = getLoadingText(form, submitter);

        if (!submitter) return;
        if (submitter instanceof HTMLInputElement && submitter.type === 'submit') {
            submitter.setAttribute('data-bc-original-value', submitter.value || '');
            submitter.value = loadingText;
            return;
        }

        if (!(submitter instanceof HTMLButtonElement)) return;
        if (submitter.getAttribute('data-bc-loading-attached') === '1') return;

        submitter.setAttribute('data-bc-loading-attached', '1');
        submitter.classList.add('a-btn-loading');
        submitter.setAttribute('data-bc-original-html', submitter.innerHTML);
        submitter.innerHTML = '';

        var spinner = document.createElement('span');
        spinner.className = 'spinner-border spinner-border-sm a-btn-loading-spinner';
        spinner.setAttribute('role', 'status');
        spinner.setAttribute('aria-hidden', 'true');

        var label = document.createElement('span');
        label.className = 'a-btn-loading-label';
        label.textContent = loadingText;

        submitter.appendChild(spinner);
        submitter.appendChild(label);
    }

    document.addEventListener(
        'click',
        function (e) {
            var target = e.target;
            if (!(target instanceof Element)) return;

            var submitter = target.closest('button[type="submit"], input[type="submit"]');
            if (!submitter) return;
            if (!(submitter instanceof HTMLElement)) return;

            var form = submitter.form;
            if (!shouldHandle(form)) return;

            var id = ensureSubmitterId(submitter);
            if (!id) return;
            form.setAttribute(FLAG_LAST_SUBMITTER, id);
        },
        true
    );

    document.addEventListener(
        'submit',
        function (e) {
            var form = e.target;
            if (!shouldHandle(form)) return;

            if (form.getAttribute(FLAG_SUBMITTING) === '1') {
                e.preventDefault();
                e.stopPropagation();
                return;
            }

            if (isWaitingForConfirm(form)) {
                // Le script de confirmation gère d'abord le submit.
                return;
            }

            var submitter = e.submitter || getTrackedSubmitter(form) || null;
            setLoadingState(form, submitter);
        },
        true
    );
})();
