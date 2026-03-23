@extends('admin.layouts.app')

@section('title', 'Dashboard CMS')
@section('body-class', 'bracongo-no-sidebar')
@section('footer-text', 'Back-office CMS Bracongo')

@push('styles')
<link href="{{ asset('admin/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
<style>
	.row.page-titles { margin-bottom: 12px; }
	.page-head { margin-bottom: 18px; }
</style>
@endpush

@section('header')
@include('admin.layouts.partials.header')
@endsection

@push('header-left')
<div class="input-group search-area">
	<input type="text" class="form-control" placeholder="Rechercher…">
	<span class="input-group-text">
		<a href="javascript:void(0)"><i class="flaticon-search-interface-symbol"></i></a>
	</span>
</div>
@endpush

@section('content')
<div class="page-head">
	<div class="row">
		<div class="col-sm-6 mb-sm-4 mb-3">
			<h3 class="mb-0">Bienvenue, {{ Auth::user()->name ?? 'Admin' }}</h3>
			<p class="mb-0">Vue d'ensemble de votre back-office CMS</p>
		</div>
	</div>
</div>

{{-- Carrousel Hero Slides --}}
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header border-0 pb-0 d-flex justify-content-between align-items-center">
				<h4 class="mb-0">Bannières — Hero Slides</h4>
				<a href="{{ route('admin.hero-slides.index') }}" class="btn btn-sm btn-outline-primary">Gérer</a>
			</div>
			<div class="card-body">
				<div class="swiper bracongo-banner-swiper">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<div class="bracongo-banner-slide">
								<div>
									<h3 class="mb-1">{{ $statsSlides }} slide{{ $statsSlides > 1 ? 's' : '' }} actif{{ $statsSlides > 1 ? 's' : '' }}</h3>
									<p class="mb-0 opacity-75">
										Images du carrousel d'accueil administrables via Hero Slides.
									</p>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="bracongo-banner-slide bracongo-banner-slide--alt">
								<div>
									<h3 class="mb-1">100% dynamique</h3>
									<p class="mb-0 opacity-75">Données issues de la base.</p>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="bracongo-banner-slide bracongo-banner-slide--dark">
								<div>
									<h3 class="mb-1">Responsive</h3>
									<p class="mb-0 opacity-75">Adapté mobile & desktop.</p>
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

{{-- Stats KPI --}}
<div class="row">
	<div class="col-xl-2 col-md-4 col-sm-6">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<h6 class="mb-0">Messages</h6>
			</div>
			<div class="card-body">
				<h2 class="mb-0">{{ $statsMessages }}</h2>
				<small class="text-muted">Reçus</small>
			</div>
			<div class="card-footer border-0 pt-0">
				<a href="{{ route('admin.messages.index') }}" class="text-primary small">Voir</a>
			</div>
		</div>
	</div>
	<div class="col-xl-2 col-md-4 col-sm-6">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<h6 class="mb-0">Non lus</h6>
			</div>
			<div class="card-body">
				<h2 class="mb-0 {{ $statsNonLus > 0 ? 'text-danger' : '' }}">{{ $statsNonLus }}</h2>
				<small class="text-muted">À traiter</small>
			</div>
			<div class="card-footer border-0 pt-0">
				<a href="{{ route('admin.messages.index') }}" class="text-primary small">Voir</a>
			</div>
		</div>
	</div>
	<div class="col-xl-2 col-md-4 col-sm-6">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<h6 class="mb-0">Offres</h6>
			</div>
			<div class="card-body">
				<h2 class="mb-0">{{ $statsOffres }}</h2>
				<small class="text-muted">Actives</small>
			</div>
			<div class="card-footer border-0 pt-0">
				<a href="{{ route('admin.offres-emploi.index') }}" class="text-primary small">Voir</a>
			</div>
		</div>
	</div>
	<div class="col-xl-2 col-md-4 col-sm-6">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<h6 class="mb-0">Slides</h6>
			</div>
			<div class="card-body">
				<h2 class="mb-0">{{ $statsSlides }}</h2>
				<small class="text-muted">Hero</small>
			</div>
			<div class="card-footer border-0 pt-0">
				<a href="{{ route('admin.hero-slides.index') }}" class="text-primary small">Voir</a>
			</div>
		</div>
	</div>
	<div class="col-xl-2 col-md-4 col-sm-6">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<h6 class="mb-0">Valeurs</h6>
			</div>
			<div class="card-body">
				<h2 class="mb-0">{{ $statsValeurs }}</h2>
				<small class="text-muted">PREMIERS</small>
			</div>
			<div class="card-footer border-0 pt-0">
				<a href="{{ route('admin.valeurs.index') }}" class="text-primary small">Voir</a>
			</div>
		</div>
	</div>
	<div class="col-xl-2 col-md-4 col-sm-6">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<h6 class="mb-0">Galerie</h6>
			</div>
			<div class="card-body">
				<h2 class="mb-0">{{ $statsGalerie }}</h2>
				<small class="text-muted">Footer</small>
			</div>
			<div class="card-footer border-0 pt-0">
				<a href="{{ route('admin.footer-gallery.index') }}" class="text-primary small">Voir</a>
			</div>
		</div>
	</div>
</div>

<div class="row">
	{{-- Derniers messages --}}
	<div class="col-xl-8">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h4 class="mb-0">Derniers messages</h4>
				<a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
			</div>
			<div class="card-body p-0">
				@if($derniersMessages->isEmpty())
				<div class="p-4 text-center text-muted">
					Aucun message pour le moment.
				</div>
				@else
				<div class="table-responsive">
					<table class="table table-hover mb-0">
						<thead>
							<tr>
								<th>Expéditeur</th>
								<th>Sujet</th>
								<th>Date</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($derniersMessages as $msg)
							<tr class="{{ !$msg->lu ? 'table-warning' : '' }}">
								<td>
									<strong>{{ $msg->name }}</strong>
									<br><small class="text-muted">{{ $msg->email }}</small>
								</td>
								<td>{{ Str::limit($msg->subject ?? '—', 30) }}</td>
								<td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
								<td>
									<a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-xs btn-light">Ouvrir</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@endif
			</div>
		</div>
	</div>

	{{-- Actions rapides --}}
	<div class="col-xl-4">
		<div class="card">
			<div class="card-header">
				<h4 class="mb-0">Actions rapides</h4>
			</div>
			<div class="card-body">
				<ul class="list-group list-group-flush">
					<li class="list-group-item d-flex justify-content-between align-items-center px-0">
						<span>Page Welcome</span>
						<a class="btn btn-sm btn-primary" href="{{ route('admin.pages.welcome.edit') }}">Ouvrir</a>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center px-0">
						<span>Page Accueil</span>
						<a class="btn btn-sm btn-outline-primary" href="{{ route('admin.pages.accueil.edit') }}">Ouvrir</a>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center px-0">
						<span>Offres d'emploi</span>
						<a class="btn btn-sm btn-outline-primary" href="{{ route('admin.offres-emploi.index') }}">Voir</a>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center px-0">
						<span>Messages</span>
						<a class="btn btn-sm btn-outline-primary" href="{{ route('admin.messages.index') }}">Voir</a>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center px-0">
						<span>Paramètres</span>
						<a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.parametres.edit') }}">Ouvrir</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts-vendor')
<script src="{{ asset('admin/vendor/swiper/js/swiper-bundle.min.js') }}"></script>
@endpush

@push('scripts')
<script>
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
