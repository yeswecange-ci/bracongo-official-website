/**
 * Remplace les boîtes de dialogue natives par SweetAlert2 (thème Bracongo).
 * Utiliser sur les formulaires : attribut data-bracongo-confirm + data-bc-* (voir README inline).
 */
(function () {
    'use strict';

    if (typeof Swal === 'undefined') {
        return;
    }

    var PASS = 'data-bc-pass';

    function getAttr(form, name, fallback) {
        var v = form.getAttribute(name);
        return v !== null && v !== '' ? v : fallback;
    }

    document.addEventListener(
        'submit',
        function (e) {
            var form = e.target;
            if (!(form instanceof HTMLFormElement)) {
                return;
            }
            if (!form.hasAttribute('data-bracongo-confirm')) {
                return;
            }
            if (form.getAttribute(PASS) === '1') {
                form.removeAttribute(PASS);
                return;
            }

            e.preventDefault();
            e.stopPropagation();

            var title = getAttr(form, 'data-bc-title', 'Confirmer cette action ?');
            var text = form.getAttribute('data-bc-text');
            var icon = getAttr(form, 'data-bc-icon', 'warning');
            var confirmText = getAttr(form, 'data-bc-confirm-text', 'Confirmer');
            var cancelText = getAttr(form, 'data-bc-cancel-text', 'Annuler');

            Swal.fire({
                icon: icon,
                title: title,
                text: text || undefined,
                html: form.getAttribute('data-bc-html') || undefined,
                showCancelButton: true,
                confirmButtonText: confirmText,
                cancelButtonText: cancelText,
                confirmButtonColor: '#E30613',
                cancelButtonColor: '#64748B',
                reverseButtons: true,
                focusCancel: true,
                customClass: {
                    popup: 'bracongo-swal-popup',
                    confirmButton: 'bracongo-swal-btn-confirm',
                    cancelButton: 'bracongo-swal-btn-cancel',
                },
                buttonsStyling: true,
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.setAttribute(PASS, '1');
                    if (typeof form.requestSubmit === 'function') {
                        form.requestSubmit();
                    } else {
                        form.submit();
                    }
                }
            });
        },
        true
    );
})();
