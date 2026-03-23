@extends('admin.layouts.app')

@section('title', 'Éditer une page (CMS)')
@section('footer-text', 'Édition de page (CMS)')

@section('header')
@include('admin.layouts.partials.header')
@endsection

@push('header-left')
<h4 class="mb-0">Édition de page</h4>
@endpush

@push('header-actions')
<li class="nav-item">
	<a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.pages.index') }}">Retour</a>
</li>
<li class="nav-item ms-2">
	<button class="btn btn-primary btn-sm" type="submit" form="pageForm">Enregistrer</button>
</li>
@endpush

@section('sidebar')
@include('admin.layouts.partials.sidebar')
@endsection


@section('content')
<div class="row page-titles">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
		<li class="breadcrumb-item active"><a href="javascript:void(0)">Éditer</a></li>
	</ol>
</div>

<div class="row">
	<div class="col-xl-12">
		<div class="row">
			<div class="col-xl-8">
				<form id="pageForm" autocomplete="off">
					@csrf

					{{-- Contenu principal --}}
					<div class="card h-auto">
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label required">Nom de la page</label>
								<input type="text" class="form-control" id="title" name="title" placeholder="Ex: Accueil">
							</div>
							<div class="mb-3">
								<label class="form-label required">Slug</label>
								<input type="text" class="form-control" id="slug" name="slug" placeholder="Ex: home">
							</div>
							<div class="mb-3">
								<label class="form-label">Meta title (SEO)</label>
								<input type="text" class="form-control" id="metaTitle" name="meta_title" placeholder="Titre SEO…">
							</div>
							<div class="mb-3">
								<label class="form-label">Meta description (SEO)</label>
								<textarea class="form-control" id="metaDescription" name="meta_description" rows="3" placeholder="Description SEO…"></textarea>
							</div>
						</div>
					</div>

					{{-- Hero --}}
					<div class="card h-auto">
						<div class="card-header d-block py-3">
							<h4 class="card-title--medium mb-0">Hero</h4>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label required">Titre hero</label>
								<input type="text" class="form-control" id="heroTitle" name="hero_title" placeholder="Titre…">
							</div>
							<div class="mb-3">
								<label class="form-label">Texte hero</label>
								<textarea class="form-control" id="heroText" name="hero_text" rows="5" placeholder="Texte du hero…"></textarea>
							</div>
							<div class="mb-3">
								<label class="form-label">Image hero (URL ou chemin)</label>
								<input type="text" class="form-control" id="heroImage" name="hero_image" placeholder="img/banner.jpg">
							</div>
						</div>
					</div>

					{{-- CTA --}}
					<div class="card h-auto">
						<div class="card-header d-block py-3">
							<h4 class="card-title--medium mb-0">CTA</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6 mb-3">
									<label class="form-label">Label bouton</label>
									<input type="text" class="form-control" id="ctaLabel" name="cta_label" placeholder="Ex: Contactez-nous">
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">Lien</label>
									<input type="text" class="form-control" id="ctaHref" name="cta_href" placeholder="Ex: /contact">
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>

			<div class="col-xl-4">
				<div class="right-sidebar-sticky">
					{{-- Thumbnail / Aperçu image hero --}}
					<div class="card h-auto">
						<div class="card-header py-3">
							<h4 class="card-title--medium mb-0">Aperçu image hero</h4>
						</div>
						<div class="card-body">
							<div class="avatar-upload d-flex align-items-center">
								<div class="position-relative w-100">
									<div class="avatar-preview">
										<div id="imagePreview" style="background-image: url('{{ asset('img/LOGO BRACONGO copie 1.png') }}'); background-size: contain; background-repeat: no-repeat; background-position: center; background-color: #f0f0f0; min-height: 120px;"></div>
									</div>
									<small class="text-muted d-block mt-2">L'aperçu se met à jour depuis le champ Image hero.</small>
								</div>
							</div>
						</div>
					</div>

					{{-- Statut --}}
					<div class="card h-auto">
						<div class="card-header py-3">
							<h4 class="card-title--medium mb-0">Statut</h4>
						</div>
						<div class="card-body">
							<label class="form-label">Statut</label>
							<select class="form-control default-select h-auto wide" id="status" name="status">
								<option value="published">Publié</option>
								<option value="draft">Brouillon</option>
							</select>
							<div class="mt-3">
								<label class="form-label">Dernière sauvegarde</label>
								<div class="text-muted" id="lastSaved">—</div>
							</div>
						</div>
					</div>

					{{-- Actions --}}
					<div class="card h-auto">
						<div class="card-header py-3">
							<h4 class="card-title--medium mb-0">Actions</h4>
						</div>
						<div class="card-body">
							<div class="d-grid gap-2">
								<button type="submit" form="pageForm" class="btn btn-primary" id="btnSave">
									<i class="fa fa-save me-2"></i>Enregistrer
								</button>
								<a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
									<i class="fa fa-times me-2"></i>Annuler
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script>
(function() {
	function qs(name) {
		const url = new URL(window.location.href);
		return url.searchParams.get(name);
	}

	const mockBySlug = {
		home: {
			title: "Accueil", slug: "home",
			metaTitle: "BRACONGO — Accueil",
			metaDescription: "C'est Frais, C'est Bon, C'est TOP!",
			heroTitle: "C'est Frais, C'est Bon, C'est TOP!",
			heroImage: "img/coverhome.jpg",
			heroText: "Contenu hero à rendre dynamique (texte, image, CTA, sections…).",
			ctaLabel: "Contactez-nous", ctaHref: "/contact", status: "published"
		}
	};

	const initialSlug = qs("slug") || "home";
	const initial = mockBySlug[initialSlug] || {
		title: "", slug: initialSlug || "", metaTitle: "", metaDescription: "",
		heroTitle: "", heroImage: "", heroText: "", ctaLabel: "", ctaHref: "", status: "draft"
	};

	function setValue(id, v) {
		const el = document.getElementById(id);
		if (!el) return;
		el.value = v ?? "";
		if (window.jQuery && jQuery.fn.selectpicker && el.tagName === "SELECT") {
			jQuery(el).selectpicker("refresh");
		}
	}

	["title", "slug", "metaTitle", "metaDescription", "heroTitle", "heroImage", "heroText", "ctaLabel", "ctaHref"].forEach(id => {
		setValue(id, initial[id]);
	});
	setValue("status", initial.status);

	// Mise à jour de l'aperçu image quand heroImage change
	const heroImageEl = document.getElementById("heroImage");
	if (heroImageEl) {
		heroImageEl.addEventListener("input", function() {
			updateImagePreview(this.value);
		});
	}

	function updateImagePreview(url) {
		const preview = document.getElementById("imagePreview");
		if (!preview) return;
		if (url && url.trim()) {
			const base = "{{ url('/') }}";
			const fullUrl = url.startsWith("http") ? url : (url.startsWith("/") ? base + url : base + "/" + url.replace(/^\//, ""));
			preview.style.backgroundImage = "url('" + fullUrl + "')";
			preview.style.backgroundSize = "cover";
		} else {
			preview.style.backgroundImage = "url('{{ asset('img/LOGO BRACONGO copie 1.png') }}')";
			preview.style.backgroundSize = "contain";
		}
	}

	// Initial preview
	updateImagePreview(initial.heroImage);

	function save() {
		document.getElementById("lastSaved").textContent = new Date().toLocaleString("fr-FR");
	}

	document.getElementById("pageForm").addEventListener("submit", function(e) {
		e.preventDefault();
		save();
	});
})();
</script>
@endpush
