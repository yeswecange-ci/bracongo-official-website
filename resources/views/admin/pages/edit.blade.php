@extends('admin.layouts.app')

@section('title', 'Éditer une page (CMS)')
@section('footer-text', 'Édition de page (CMS)')

@section('header')
@include('admin.layouts.partials.header')
@endsection

@section('header-left')
<h4 class="mb-0">Édition de page</h4>
@endsection

@section('header-actions')
<li class="nav-item">
	<a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.pages.index') }}">Retour</a>
</li>
<li class="nav-item ms-2">
	<button class="btn btn-primary btn-sm" type="button" id="btnSaveTop">Enregistrer</button>
</li>
@endsection

@section('sidebar')
@include('admin.layouts.partials.sidebar', ['currentPage' => 'page-edit'])
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
	<div class="col-xl-8">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title mb-0">Contenu</h4>
			</div>
			<div class="card-body">
				<form id="pageForm" autocomplete="off">
					@csrf
					<div class="row">
						<div class="col-md-6 mb-3">
							<label class="form-label">Nom de la page</label>
							<input type="text" class="form-control" id="title" placeholder="Ex: Accueil">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Slug</label>
							<input type="text" class="form-control" id="slug" placeholder="Ex: home">
						</div>
						<div class="col-12 mb-3">
							<label class="form-label">Meta title (SEO)</label>
							<input type="text" class="form-control" id="metaTitle" placeholder="Titre SEO…">
						</div>
						<div class="col-12 mb-3">
							<label class="form-label">Meta description (SEO)</label>
							<textarea class="form-control" id="metaDescription" rows="3"
								placeholder="Description SEO…"></textarea>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-12">
							<h5 class="mb-2">Hero</h5>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Titre hero</label>
							<input type="text" class="form-control" id="heroTitle" placeholder="Titre…">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Image hero (URL ou chemin)</label>
							<input type="text" class="form-control" id="heroImage" placeholder="images/…">
						</div>
						<div class="col-12 mb-3">
							<label class="form-label">Texte hero</label>
							<textarea class="form-control" id="heroText" rows="4" placeholder="Texte…"></textarea>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-12">
							<h5 class="mb-2">CTA</h5>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Label bouton</label>
							<input type="text" class="form-control" id="ctaLabel" placeholder="Ex: Contactez-nous">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label">Lien</label>
							<input type="text" class="form-control" id="ctaHref" placeholder="Ex: /contact">
						</div>
					</div>

					<hr>

					<div class="d-flex flex-wrap gap-2">
						<button type="button" class="btn btn-primary" id="btnSave">Enregistrer</button>
						<button type="button" class="btn btn-outline-secondary" id="btnPreview">Prévisualiser</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-xl-4">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title mb-0">Statut</h4>
			</div>
			<div class="card-body">
				<div class="mb-3">
					<label class="form-label">Statut</label>
					<select class="default-select form-control wide" id="status">
						<option value="published">Publié</option>
						<option value="draft">Brouillon</option>
					</select>
				</div>
				<div class="mb-3">
					<label class="form-label">Dernière sauvegarde</label>
					<div class="text-muted" id="lastSaved">—</div>
				</div>
				<div class="alert alert-info mb-0">
					<strong>Dynamique bientôt :</strong> ces champs seront stockés en BD et serviront à générer le site comme un CMS.
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-header">
				<h4 class="card-title mb-0">Aperçu rapide</h4>
			</div>
			<div class="card-body">
				<div class="p-3 border rounded">
					<h6 class="mb-1" id="previewTitle">—</h6>
					<p class="mb-2 text-muted" id="previewHeroText">—</p>
					<div class="d-flex flex-wrap gap-2">
						<a class="btn btn-sm btn-primary disabled" href="javascript:void(0)" id="previewCta">CTA</a>
						<span class="badge light badge-secondary" id="previewSlug">—</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script>
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
			heroImage: "images/banner/1.jpg",
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

	function refreshPreview() {
		document.getElementById("previewTitle").textContent = document.getElementById("heroTitle").value || "—";
		document.getElementById("previewHeroText").textContent = document.getElementById("heroText").value || "—";
		document.getElementById("previewSlug").textContent = document.getElementById("slug").value || "—";
		document.getElementById("previewCta").textContent = document.getElementById("ctaLabel").value || "CTA";
	}

	["title", "slug", "metaTitle", "metaDescription", "heroTitle", "heroImage", "heroText", "ctaLabel", "ctaHref"].forEach(id => {
		setValue(id, initial[id]);
	});
	setValue("status", initial.status);
	refreshPreview();

	document.getElementById("pageForm").addEventListener("input", refreshPreview);

	function save() {
		document.getElementById("lastSaved").textContent = new Date().toLocaleString("fr-FR");
	}

	document.getElementById("btnSave").addEventListener("click", save);
	document.getElementById("btnSaveTop").addEventListener("click", save);
	document.getElementById("btnPreview").addEventListener("click", () => {
		refreshPreview();
		window.scrollTo({ top: 0, behavior: "smooth" });
	});
</script>
@endpush
