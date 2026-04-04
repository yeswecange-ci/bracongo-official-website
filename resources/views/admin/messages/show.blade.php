@extends('admin.layouts.app')
@section('title', 'Message de contact')

@php
    $replySubject = 'Re: '.($messageContact->subject ?: 'Votre message');
    $mailtoHref = 'mailto:'.$messageContact->email.'?'.http_build_query([
        'subject' => $replySubject,
    ], '', '&', PHP_QUERY_RFC3986);
    $initials = strtoupper(collect(explode(' ', trim($messageContact->name)))->filter()->take(2)->map(fn ($p) => \Illuminate\Support\Str::substr($p, 0, 1))->implode(''));
    if ($initials === '') {
        $initials = '?';
    }
@endphp

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.messages.index') }}">Messages</a></li>
        <li class="breadcrumb-item active">Détail</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Message de contact</h6>
</div>
@endpush
@push('header-actions')
<a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary">
    <i class="bi bi-arrow-left me-1"></i>Retour à la liste
</a>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')

<div class="a-msg-page a-msg-page--split">
    <div class="row g-4 align-items-start">
        <div class="col-lg-7 col-xl-8">
            <div class="a-msg-detail pe-lg-1">

                <section class="a-msg-detail__card a-msg-detail__card--hero">
                    <div class="a-msg-detail__hero-top">
                        <div class="a-msg-detail__avatar" aria-hidden="true">{{ $initials }}</div>
                        <div class="a-msg-detail__hero-main">
                            <p class="a-msg-detail__de mb-1">
                                <span class="text-muted">De</span>
                                <strong class="text-dark">{{ $messageContact->name }}</strong>
                            </p>
                            <h1 class="a-msg-detail__title">{{ $messageContact->subject ?: 'Sans sujet' }}</h1>
                        </div>
                        <div class="a-msg-detail__hero-badge">
                            @if($messageContact->lu)
                                <span class="a-msg-detail__pill a-msg-detail__pill--read"><i class="bi bi-check2-circle me-1"></i>Lu</span>
                            @else
                                <span class="a-msg-detail__pill a-msg-detail__pill--unread"><i class="bi bi-envelope-fill me-1"></i>Non lu</span>
                            @endif
                        </div>
                    </div>

                    <div class="a-msg-detail__meta-grid">
                        <div class="a-msg-detail__meta-item">
                            <div class="a-msg-detail__meta-label">E-mail</div>
                            <a href="{{ $mailtoHref }}" class="a-msg-detail__link">{{ $messageContact->email }}</a>
                        </div>
                        <div class="a-msg-detail__meta-item">
                            <div class="a-msg-detail__meta-label">Téléphone</div>
                            <div class="a-msg-detail__meta-value">{{ $messageContact->phone ?: '—' }}</div>
                        </div>
                        <div class="a-msg-detail__meta-item">
                            <div class="a-msg-detail__meta-label">Reçu le</div>
                            <div class="a-msg-detail__meta-value">{{ $messageContact->created_at->format('d/m/Y à H:i') }}</div>
                        </div>
                        <div class="a-msg-detail__meta-item a-msg-detail__meta-item--actions">
                            <div class="a-msg-detail__meta-label">Autre</div>
                            <a href="{{ $mailtoHref }}" class="btn btn-sm btn-outline-secondary" target="_blank" rel="noopener">
                                <i class="bi bi-envelope-at me-1"></i>Client mail
                            </a>
                        </div>
                    </div>
                </section>

                <section class="a-msg-detail__bubble" aria-labelledby="msg-received-label">
                    <div class="a-msg-detail__bubble-head">
                        <span id="msg-received-label" class="a-msg-detail__bubble-label">Message reçu</span>
                    </div>
                    <div class="a-msg-detail__bubble-body">
                        <p class="a-msg-detail__bubble-text">{{ $messageContact->message }}</p>
                    </div>
                </section>

                <section class="a-msg-detail__reply" aria-labelledby="reply-title">
                    <div class="a-msg-detail__reply-head">
                        <h2 id="reply-title" class="a-msg-detail__reply-title"><i class="bi bi-reply-fill me-2"></i>Répondre au message</h2>
                        <p class="a-msg-detail__reply-hint mb-0">
                            Après envoi, un message de confirmation s’affiche en haut de page. L’aperçu à droite reflète le même rendu que l’e-mail envoyé au contact (en-tête rouge Bracongo).
                        </p>
                    </div>
                    <div class="a-msg-detail__reply-body">
                        <form action="{{ route('admin.messages.reply', $messageContact) }}" method="POST" class="a-msg-detail__form">
                            @csrf
                            <label class="form-label fw-semibold mb-2" for="reply-body">Votre réponse</label>
                            <textarea name="body" id="reply-body" rows="9" class="form-control a-msg-detail__textarea @error('body') is-invalid @enderror" required placeholder="Bonjour {{ $messageContact->name }},&#10;&#10;">{{ old('body') }}</textarea>
                            @error('body')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div class="a-msg-detail__form-actions">
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="bi bi-send-fill me-2"></i>Envoyer la réponse
                                    </button>
                                    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary">Annuler</a>
                                </div>
                                <button type="button" class="btn btn-link btn-sm text-secondary text-decoration-none p-0 align-self-center" id="btn-copy-email" data-email="{{ e($messageContact->email) }}">
                                    <i class="bi bi-clipboard me-1"></i>Copier l’e-mail du contact
                                </button>
                            </div>
                        </form>
                    </div>
                </section>

                <footer class="a-msg-detail__footer">
                    <form action="{{ route('admin.messages.destroy', $messageContact) }}" method="POST"
                          class="ms-auto"
                          data-bracongo-confirm
                          data-bc-title="Supprimer ce message ?"
                          data-bc-text="Cette action est définitive et ne peut pas être annulée."
                          data-bc-icon="warning"
                          data-bc-confirm-text="Supprimer">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash me-1"></i>Supprimer le message
                        </button>
                    </form>
                </footer>

            </div>
        </div>

        <div class="col-lg-5 col-xl-4 a-msg-preview-col">
            <p class="a-msg-preview__label mb-2">
                <i class="bi bi-envelope-check me-1"></i>Aperçu côté client
            </p>
            <div class="a-msg-preview-sticky">
                <div class="a-msg-preview" id="client-email-preview" aria-live="polite">
                    <div class="a-msg-preview__header">{{ config('app.name') }}</div>
                    <div class="a-msg-preview__body">
                        <p class="a-msg-preview__hello">Bonjour {{ $messageContact->name }},</p>
                        <div class="a-msg-preview__reply a-msg-preview__reply--empty" id="preview-reply-body"></div>
                        <div class="a-msg-preview__closing" id="preview-closing">{{ $contactReplyClosing }}</div>
                    </div>
                    <div class="a-msg-preview__original">
                        <strong>Votre message initial :</strong>
                        @if($messageContact->subject)
                            <div class="a-msg-preview__subj">Sujet : {{ $messageContact->subject }}</div>
                        @endif
                        <div class="a-msg-preview__orig-msg">{{ $messageContact->message }}</div>
                    </div>
                </div>
            </div>
            <p class="a-msg-preview-help small text-muted mt-2 mb-0">
                La zone grise en bas reprend le message initial du contact. La formule de politesse est celle définie dans les paramètres du site.
            </p>

            <div class="a-msg-sent-history">
                <p class="a-msg-preview__label mb-2">
                    <i class="bi bi-send-check me-1"></i>Réponses envoyées
                </p>
                @forelse($sentReplies as $reply)
                    <div class="a-msg-sent-item">
                        <div class="a-msg-sent-item__main">
                            <span class="a-msg-sent-item__date">{{ $reply->created_at->format('d/m/Y H:i') }}</span>
                            <span class="a-msg-sent-item__excerpt">{{ \Illuminate\Support\Str::limit($reply->body, 72) }}</span>
                            @if($reply->user)
                                <span class="a-msg-sent-item__author">{{ $reply->user->name }}</span>
                            @endif
                        </div>
                        <button type="button"
                                class="a-msg-sent-item__eye"
                                title="Voir le message complet"
                                data-bs-toggle="modal"
                                data-bs-target="#modalSentReply"
                                data-sent-reply-id="{{ $reply->id }}"
                                aria-label="Voir le message du {{ $reply->created_at->format('d/m/Y') }}">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                @empty
                    <p class="a-msg-sent-empty small text-muted mb-0">Aucune réponse envoyée pour ce fil pour l’instant.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSentReply" tabindex="-1" aria-labelledby="modalSentReplyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <div>
                    <h5 class="modal-title" id="modalSentReplyLabel">Réponse envoyée</h5>
                    <p class="small text-muted mb-0" id="modal-sent-reply-meta"></p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div class="a-msg-sent-modal-body" id="modal-sent-reply-body"></div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
window.__aSentRepliesById = @json($sentRepliesByIdForJs);
</script>
<script>
(function () {
    var modalEl = document.getElementById('modalSentReply');
    if (modalEl && window.__aSentRepliesById) {
        modalEl.addEventListener('show.bs.modal', function (e) {
            var btn = e.relatedTarget;
            if (!btn || typeof btn.getAttribute !== 'function') return;
            var id = btn.getAttribute('data-sent-reply-id');
            if (!id) return;
            var r = window.__aSentRepliesById[id];
            if (!r) return;
            var meta = document.getElementById('modal-sent-reply-meta');
            var bodyEl = document.getElementById('modal-sent-reply-body');
            if (meta) meta.textContent = 'Envoyé le ' + r.sentAt + ' · ' + r.author;
            if (bodyEl) bodyEl.textContent = r.body;
        });
    }
})();
(function () {
    var textarea = document.getElementById('reply-body');
    var previewReply = document.getElementById('preview-reply-body');
    var emptyHint = 'Le texte de votre réponse apparaîtra ici…';

    function syncEmailPreview() {
        if (!textarea || !previewReply) return;
        var v = textarea.value;
        if (v.trim() === '') {
            previewReply.textContent = emptyHint;
            previewReply.classList.add('a-msg-preview__reply--empty');
        } else {
            previewReply.textContent = v;
            previewReply.classList.remove('a-msg-preview__reply--empty');
        }
    }

    if (textarea) {
        textarea.addEventListener('input', syncEmailPreview);
        textarea.addEventListener('change', syncEmailPreview);
        syncEmailPreview();
    }

    var btn = document.getElementById('btn-copy-email');
    if (btn && navigator.clipboard) {
        btn.addEventListener('click', function () {
            var email = btn.getAttribute('data-email');
            navigator.clipboard.writeText(email).then(function () {
                var prev = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check-lg me-1"></i>Copié';
                setTimeout(function () { btn.innerHTML = prev; }, 2000);
            });
        });
    }
})();
</script>
@endpush
