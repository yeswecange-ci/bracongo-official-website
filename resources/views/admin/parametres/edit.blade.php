@extends('admin.layouts.app')
@section('title', 'Paramètres du site')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Paramètres</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Paramètres du site</h6>
</div>
@endpush

@section('content')
@php
    $canEditContactEmail = auth()->user()->isSuperAdmin() || auth()->user()->isAdmin();
@endphp
<form action="{{ route('admin.parametres.update') }}" method="POST" enctype="multipart/form-data" class="row align-items-start">
	@csrf
	@method('PUT')

	<div class="col-xl-8">
		@include('admin.layouts.partials.alerts')

			<div class="card">
				<div class="card-header">
					<h5 class="mb-0"><i class="bi bi-gear me-2" style="color:#E30613"></i>Paramètres globaux</h5>
				</div>
				<div class="card-body">
					<div class="row g-4">
						<div class="col-12">
							<x-admin.image-upload name="logo" label="Logo" :value="$parametres->logo ?? null" help="PNG, JPG, GIF, WebP — max 10 Mo" compact-preview />
						</div>
						<div class="col-12">
							<label class="form-label fw-semibold">Suggestions de recherche <span class="text-muted small">(séparées par des virgules)</span></label>
							<input type="text" class="form-control" name="search_suggestions" value="{{ old('search_suggestions', $parametres->search_suggestions) }}" placeholder="Beaufort Lager,Actualités,Nkoyi,RSE">
							<div class="form-text">Ce texte sert de <strong>placeholder</strong> dans la barre de recherche du site public (header).</div>
						</div>
						<div class="col-12">
							<label class="form-label fw-semibold">Méta description par défaut (SEO)</label>
							<textarea class="form-control" name="seo_meta_description" rows="2" maxlength="500" placeholder="Résumé du site pour les moteurs de recherche (facultatif)">{{ old('seo_meta_description', $parametres->seo_meta_description) }}</textarea>
							<div class="form-text">Injectée dans <code class="small">&lt;meta name="description"&gt;</code> sur le site public pour les pages sans description dédiée (max. 500 caractères).</div>
						</div>
						<div class="col-md-6">
							<label class="form-label fw-semibold">Téléphone affiché (public)</label>
							<input type="text" class="form-control" name="telephone_public" value="{{ old('telephone_public', $parametres->telephone_public) }}" placeholder="+243 …" maxlength="80">
							<div class="form-text">Référence centralisée pour affichage futur (footer, contact, etc.).</div>
						</div>
						<div class="col-md-6">
							<label class="form-label fw-semibold">Page Actualités — titre hero</label>
							<input type="text" class="form-control" name="actualites_hero_titre" value="{{ old('actualites_hero_titre', $parametres->actualites_hero_titre ?? 'Actualités & Événements') }}">
						</div>
						<div class="col-md-6">
							<label class="form-label fw-semibold">Page Actualités — libellé « tout voir »</label>
							<input type="text" class="form-control" name="actualites_filtre_tout_label" value="{{ old('actualites_filtre_tout_label', $parametres->actualites_filtre_tout_label ?? 'Tout voir') }}">
						</div>
						<div class="col-md-6">
							<label class="form-label fw-semibold">Invitations — durée de validité</label>
							<select name="invitation_expires_hours" class="form-select @error('invitation_expires_hours') is-invalid @enderror">
								@php
									$currentInvitationHours = (string) old('invitation_expires_hours', $parametres->invitation_expires_hours?->value ?? $parametres->invitation_expires_hours ?? '48');
								@endphp
								@foreach($invitationExpiresOptions as $opt)
								<option value="{{ $opt->value }}" @selected($currentInvitationHours === $opt->value)>{{ $opt->label() }}</option>
								@endforeach
							</select>
							@error('invitation_expires_hours')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
							<div class="form-text">S’applique aux nouvelles invitations.</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card mt-3">
				<div class="card-header">
					<h5 class="mb-0"><i class="bi bi-cone-striped me-2" style="color:#E30613"></i>Mode maintenance</h5>
				</div>
				<div class="card-body">
					<p class="text-muted small mb-3">
						Lorsqu'il est activé, le site public affiche une page de maintenance à tous les visiteurs. Le back-office reste accessible et les administrateurs connectés continuent de voir le site normalement.
					</p>
					<div class="form-check form-switch mb-4">
						<input type="hidden" name="maintenance_active" value="0">
						<input class="form-check-input" type="checkbox" role="switch" id="maintenance_active" name="maintenance_active" value="1" @checked(old('maintenance_active', $parametres->maintenance_active)) style="width:2.75em;height:1.4em;cursor:pointer;">
						<label class="form-check-label fw-semibold ms-2" for="maintenance_active">Activer le mode maintenance</label>
					</div>
					<div class="row g-4">
						<div class="col-12">
							<label class="form-label fw-semibold">Titre affiché</label>
							<input type="text" class="form-control" name="maintenance_titre" value="{{ old('maintenance_titre', $parametres->maintenance_titre) }}" placeholder="Site en maintenance" maxlength="255">
						</div>
						<div class="col-12">
							<label class="form-label fw-semibold">Message affiché</label>
							<textarea class="form-control" name="maintenance_message" rows="3" maxlength="2000" placeholder="Notre site est momentanément indisponible…">{{ old('maintenance_message', $parametres->maintenance_message) }}</textarea>
							<div class="form-text">Laissez vide pour utiliser le texte par défaut.</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card mt-3">
				<div class="card-header">
					<h5 class="mb-0"><i class="bi bi-bag-check me-2" style="color:#E30613"></i>E-mail — mise à jour du statut de commande</h5>
				</div>
				<div class="card-body">
					<p class="text-muted small mb-3">
						Envoyé automatiquement au client lorsqu’un administrateur modifie le statut d’une commande (boutique). Le texte est le même pour tous les cas&nbsp;; seuls les libellés de statut changent (ex.&nbsp;En attente, Confirmée, Livrée…).
					</p>
					<p class="small fw-semibold mb-2">Variables (copier-coller dans le sujet ou le corps)&nbsp;:</p>
					<ul class="small text-muted mb-4 ps-3">
						<li><code>{nom_client}</code> — nom du client</li>
						<li><code>{reference}</code> — référence de la commande</li>
						<li><code>{ancien_statut}</code> / <code>{nouveau_statut}</code> — libellés affichés (ex.&nbsp;En attente → Livrée)</li>
						<li><code>{nom_site}</code> — {{ config('app.name') }}</li>
					</ul>
					<label class="form-label fw-semibold" for="commande_statut_email_sujet">Objet de l’e-mail</label>
					<input type="text" class="form-control @error('commande_statut_email_sujet') is-invalid @enderror" name="commande_statut_email_sujet" id="commande_statut_email_sujet" maxlength="255"
						value="{{ old('commande_statut_email_sujet', $parametres->commande_statut_email_sujet) }}"
						placeholder="{{ \App\Models\ParametresSite::defaultCommandeStatutEmailSubjectTemplate() }}">
					@error('commande_statut_email_sujet')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
					<div class="form-text mb-3">Si vide, l’objet par défaut est utilisé (voir placeholder).</div>

					<label class="form-label fw-semibold" for="commande_statut_email_corps_html">Corps du message (HTML)</label>
					<textarea class="form-control font-monospace small @error('commande_statut_email_corps_html') is-invalid @enderror" name="commande_statut_email_corps_html" id="commande_statut_email_corps_html" rows="14" spellcheck="false">{{ old('commande_statut_email_corps_html', $parametres->commande_statut_email_corps_html) }}</textarea>
					@error('commande_statut_email_corps_html')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
					<div class="form-text mb-3">Fragment HTML inséré dans la mise en page de l’e-mail (en-tête rouge / charte). Laisser vide pour le texte par défaut.</div>

					@php
						$p = $parametres;
						$previewSubject = $p->resolvedCommandeStatutEmailSubject(
							'Jean Dupont',
							'CMD-EXEMPLE00',
							'En attente',
							'Confirmée',
						);
						$previewBody = $p->resolvedCommandeStatutEmailCorpsHtml(
							'Jean Dupont',
							'CMD-EXEMPLE00',
							'En attente',
							'Confirmée',
						);
					@endphp
					<div class="p-3 rounded border bg-light">
						<p class="small fw-semibold text-muted text-uppercase mb-2" style="font-size:0.7rem;">Aperçu (données fictives)</p>
						<p class="small mb-1"><span class="text-muted">Objet :</span> {{ $previewSubject }}</p>
						<hr class="my-2">
						<div class="small" style="max-height:200px;overflow:auto;line-height:1.45;">{!! $previewBody !!}</div>
					</div>
				</div>
			</div>

			<div class="mt-3">
				<button type="submit" class="btn btn-primary">
					<i class="bi bi-floppy me-1"></i>Enregistrer
				</button>
			</div>
	</div>

	<div class="col-xl-4 align-self-start mt-4 mt-xl-0">
		<div class="card border-0 shadow-sm mb-3">
			<div class="card-header py-2 bg-white border-bottom"><h5 class="mb-0 small fw-bold text-muted text-uppercase">Aperçu</h5></div>
			<div class="card-body py-3 text-center">
				<div class="d-flex align-items-center justify-content-center gap-3 flex-wrap">
					<img src="{{ asset($parametres->logo ?? 'img/LOGO BRACONGO copie 1.webp') }}" alt="Logo" class="object-contain" style="max-height:52px;width:auto;">
					<span class="badge px-2 py-1 rounded-pill text-white small" style="background-color:{{ $parametres->couleur_principale }};">
						{{ $parametres->couleur_principale }}
					</span>
				</div>
				@if(filled($parametres->favicon ?? null))
				<div class="mt-3 pt-3 border-top text-start">
					<p class="small text-muted mb-2 fw-semibold">Favicon actuel</p>
					<div class="d-flex align-items-center gap-2">
						<img src="{{ asset($parametres->favicon) }}" alt="" width="32" height="32" class="rounded border bg-white p-1" style="object-fit:contain;">
						<span class="small text-break text-muted">{{ basename($parametres->favicon) }}</span>
					</div>
				</div>
				@endif
			</div>
		</div>

		@if($canEditContactEmail)
		<div class="card border-0 shadow-sm mb-3">
			<div class="card-header py-2 bg-white border-bottom">
				<h5 class="mb-0 small fw-bold text-muted text-uppercase"><i class="bi bi-envelope-paper me-1" style="color:#E30613"></i>Réponses contact</h5>
			</div>
			<div class="card-body">
				<label class="form-label fw-semibold small" for="contact_reply_closing">Formule de politesse (pied de l’e-mail)</label>
				@php
					$closingPlaceholder = "Cordialement,\n\nL'équipe ".config('app.name');
				@endphp
				<textarea class="form-control form-control-sm @error('contact_reply_closing') is-invalid @enderror" name="contact_reply_closing" id="contact_reply_closing" rows="5" placeholder="{{ $closingPlaceholder }}">{{ old('contact_reply_closing', $parametres->contact_reply_closing) }}</textarea>
				@error('contact_reply_closing')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
				<div class="form-text mt-2 small">
					Sous votre réponse, avant le rappel du message du contact. Vide = formule par défaut (« L’équipe {{ config('app.name') }} »).
				</div>
			</div>
		</div>
		@endif

		<div class="card border-0 shadow-sm">
			<div class="card-header py-2 bg-white border-bottom">
				<h5 class="mb-0 small fw-bold text-muted text-uppercase">Favicon &amp; référencement</h5>
			</div>
			<div class="card-body">
				<x-admin.image-upload name="favicon" label="Favicon" :value="$parametres->favicon ?? null" help="PNG, ICO, JPG — max 10 Mo" />
				<p class="form-text mb-0">Icône affichée dans l’onglet du navigateur sur le site public. Si aucun fichier n’est choisi, le logo par défaut reste utilisé.</p>
				@if(filled(trim((string) ($parametres->seo_meta_description ?? ''))))
				<div class="mt-3 p-3 rounded bg-light border small">
					<p class="fw-semibold mb-1 text-muted text-uppercase" style="font-size:0.7rem;">Aperçu méta description</p>
					<p class="mb-0 text-body-secondary" style="line-height:1.35;">{{ Str::limit($parametres->seo_meta_description, 220) }}</p>
				</div>
				@else
				<p class="small text-muted mt-3 mb-0">Renseignez la méta description dans le formulaire de gauche pour un aperçu ici et pour les moteurs de recherche.</p>
				@endif
			</div>
		</div>
	</div>
</form>

@endsection

@push('scripts')
@endpush
