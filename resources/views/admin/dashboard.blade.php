@extends('admin.layouts.app')

@section('title', 'Dashboard CMS')
@section('body-class', 'bracongo-no-sidebar')
@section('footer-text', 'Back-office CMS (prototype)')

@push('styles')
<link href="{{ asset('admin/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
<style>
	.row.page-titles { margin-bottom: 12px; }
	.page-head { margin-bottom: 18px; }
</style>
@endpush

@section('header')
@include('admin.layouts.partials.header')
@endsection

@section('header-left')
<div class="input-group search-area">
	<input type="text" class="form-control" placeholder="Rechercher…">
	<span class="input-group-text">
		<a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a>
	</span>
</div>
@endsection

@section('content')
<div class="page-head">
	<div class="row">
		<div class="col-sm-6 mb-sm-4 mb-3">
			<h3 class="mb-0">Bienvenue, {{ Auth::user()->name ?? 'Admin' }}</h3>
			<p class="mb-0">Voici l'état de votre back-office CMS</p>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<h4 class="mb-0">Carrousel — Bannières des pages</h4>
			</div>
			<div class="card-body">
				<div class="swiper bracongo-banner-swiper">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<div class="bracongo-banner-slide">
								<div>
									<h3 class="mb-1">Espace réservé</h3>
									<p class="mb-0 opacity-75">
										Ici on affichera toutes les bannières (hero/banner) des pages, récupérées depuis la BD.
									</p>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="bracongo-banner-slide bracongo-banner-slide--alt">
								<div>
									<h3 class="mb-1">Dynamique bientôt</h3>
									<p class="mb-0 opacity-75">
										Images, CTA et textes seront administrables via le back-office.
									</p>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="bracongo-banner-slide bracongo-banner-slide--dark">
								<div>
									<h3 class="mb-1">100% responsive</h3>
									<p class="mb-0 opacity-75">
										Le carrousel s'adapte (desktop/tablette/mobile).
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="swiper-pagination"></div>
				</div>

				<style>
					.bracongo-banner-swiper { width: 100%; }
					.bracongo-banner-slide {
						min-height: 260px;
						border-radius: 16px;
						padding: 28px;
						display: flex;
						align-items: flex-end;
						color: #fff;
						background: linear-gradient(135deg, #E30613 0%, #ff4d4d 100%);
					}
					.bracongo-banner-slide--alt {
						background: linear-gradient(135deg, #6d28d9 0%, #db2777 100%);
					}
					.bracongo-banner-slide--dark {
						background: linear-gradient(135deg, #111827 0%, #334155 100%);
					}
					@media (max-width: 576px) {
						.bracongo-banner-slide { min-height: 200px; padding: 18px; }
					}
				</style>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl-3 col-sm-6">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<h6 class="mb-0">Pages</h6>
				<div class="dropdown ms-auto c-pointer">
					<a class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-ellipsis-v text-muted"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="{{ route('admin.pages.index') }}">Voir la liste</a>
						<a class="dropdown-item" href="{{ route('admin.pages.create') }}">Créer / éditer</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<h2 class="mb-0" id="kpiPages">—</h2>
				<small class="text-muted">Contenus CMS</small>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<h6 class="mb-0">Images</h6>
				<div class="dropdown ms-auto c-pointer">
					<a class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-ellipsis-v text-muted"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="javascript:void(0)">Bibliothèque</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<h2 class="mb-0" id="kpiImages">—</h2>
				<small class="text-muted">Bannières, hero, logos, etc.</small>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<h6 class="mb-0">CTA</h6>
				<div class="dropdown ms-auto c-pointer">
					<a class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-ellipsis-v text-muted"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="{{ route('admin.pages.create') }}">Éditer une page</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<h2 class="mb-0" id="kpiCtas">—</h2>
				<small class="text-muted">Boutons / liens stratégiques</small>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<h6 class="mb-0">Statut</h6>
				<div class="dropdown ms-auto c-pointer">
					<a class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-ellipsis-v text-muted"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="javascript:void(0)">Paramètres</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<h2 class="mb-0">Responsive</h2>
				<small class="text-muted">Priorité absolue</small>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl-8">
		<div class="card">
			<div class="card-header">
				<h4 class="mb-0">Pilotage CMS (aperçu)</h4>
			</div>
			<div class="card-body">
				<div class="row g-3">
					<div class="col-md-6">
						<div class="p-3 border rounded">
							<h6 class="mb-1">Objectif</h6>
							<p class="mb-0 text-muted">
								Tout rendre dynamique : textes, images, sections, CTA… via back-office.
							</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="p-3 border rounded">
							<h6 class="mb-1">Réflexe</h6>
							<p class="mb-0 text-muted">
								Les composants HTML doivent venir de WorldNic (sauf force majeure).
							</p>
						</div>
					</div>
					<div class="col-12">
						<div class="d-flex flex-wrap gap-2">
							<a href="{{ route('admin.pages.index') }}" class="btn btn-primary">Gérer les pages</a>
							<a href="{{ route('admin.pages.create') }}" class="btn btn-outline-primary">Éditer une page</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<h4 class="mb-0">Actions rapides</h4>
			</div>
			<div class="card-body">
				<ul class="list-group">
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Créer une page
						<a class="btn btn-sm btn-primary" href="{{ route('admin.pages.create') }}">Ouvrir</a>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Liste des pages
						<a class="btn btn-sm btn-outline-primary" href="{{ route('admin.pages.index') }}">Voir</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('admin/vendor/swiper/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('admin/vendor/apexchart/apexchart.js') }}"></script>
<script src="{{ asset('admin/vendor/chart-js/chart.bundle.min.js') }}"></script>
<script src="{{ asset('admin/vendor/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('admin/js/dashboard/dashboard-2.js') }}"></script>
<script>
	const mockCmsStats = { pages: 7, images: 128, ctas: 19 };
	document.getElementById("kpiPages").textContent = mockCmsStats.pages;
	document.getElementById("kpiImages").textContent = mockCmsStats.images;
	document.getElementById("kpiCtas").textContent = mockCmsStats.ctas;

	if (typeof Swiper !== "undefined") {
		new Swiper(".bracongo-banner-swiper", {
			loop: true,
			slidesPerView: 1,
			spaceBetween: 16,
			pagination: { el: ".bracongo-banner-swiper .swiper-pagination", clickable: true },
			autoplay: { delay: 4500, disableOnInteraction: false }
		});
	}
</script>
@endpush
