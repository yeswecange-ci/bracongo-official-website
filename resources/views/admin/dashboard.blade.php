@extends('admin.layouts.app')

@section('title', 'Dashboard CMS')

@push('styles')
<link href="{{ asset('admin/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
@endpush

@push('header-left')
<span class="a-topbar-title">Dashboard</span>
@endpush

@section('content')

{{-- Page header --}}
<div class="a-page-header">
    <h3>Bienvenue, {{ Auth::user()->name ?? 'Admin' }} 👋</h3>
    <p>Vue d'ensemble de votre back-office CMS Bracongo</p>
</div>

{{-- ===== KPI STATS ===== --}}
<div class="row g-3 mb-4">

    <div class="col-xl-2 col-md-4 col-6">
        <div class="card">
            <div class="a-stat-card">
                <div class="a-stat-icon primary">
                    <i class="bi bi-envelope"></i>
                </div>
                <div>
                    <div class="a-stat-value">{{ $statsMessages }}</div>
                    <div class="a-stat-label">Messages reçus</div>
                    <a class="a-stat-link" href="{{ route('admin.messages.index') }}">Voir →</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-6">
        <div class="card {{ $statsNonLus > 0 ? 'border-danger' : '' }}" style="{{ $statsNonLus > 0 ? 'border-color:#E30613!important' : '' }}">
            <div class="a-stat-card">
                <div class="a-stat-icon {{ $statsNonLus > 0 ? 'primary' : 'success' }}">
                    <i class="bi bi-envelope-open"></i>
                </div>
                <div>
                    <div class="a-stat-value {{ $statsNonLus > 0 ? 'text-danger' : '' }}">{{ $statsNonLus }}</div>
                    <div class="a-stat-label">Non lus</div>
                    <a class="a-stat-link" href="{{ route('admin.messages.index') }}">Traiter →</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-6">
        <div class="card">
            <div class="a-stat-card">
                <div class="a-stat-icon warning">
                    <i class="bi bi-briefcase"></i>
                </div>
                <div>
                    <div class="a-stat-value">{{ $statsOffres }}</div>
                    <div class="a-stat-label">Offres actives</div>
                    <a class="a-stat-link" href="{{ route('admin.offres-emploi.index') }}">Voir →</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-6">
        <div class="card">
            <div class="a-stat-card">
                <div class="a-stat-icon info">
                    <i class="bi bi-play-circle"></i>
                </div>
                <div>
                    <div class="a-stat-value">{{ $statsSlides }}</div>
                    <div class="a-stat-label">Hero Slides</div>
                    <a class="a-stat-link" href="{{ route('admin.hero-slides.index') }}">Voir →</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-6">
        <div class="card">
            <div class="a-stat-card">
                <div class="a-stat-icon purple">
                    <i class="bi bi-star"></i>
                </div>
                <div>
                    <div class="a-stat-value">{{ $statsValeurs }}</div>
                    <div class="a-stat-label">Valeurs PREMIERS</div>
                    <a class="a-stat-link" href="{{ route('admin.valeurs.index') }}">Voir →</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-6">
        <div class="card">
            <div class="a-stat-card">
                <div class="a-stat-icon slate">
                    <i class="bi bi-images"></i>
                </div>
                <div>
                    <div class="a-stat-value">{{ $statsGalerie }}</div>
                    <div class="a-stat-label">Galerie footer</div>
                    <a class="a-stat-link" href="{{ route('admin.footer-gallery.index') }}">Voir →</a>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ===== BANNER SWIPER ===== --}}
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Bannières — Hero Slides</h5>
                <a href="{{ route('admin.hero-slides.index') }}"
                   class="btn btn-sm btn-outline-primary">Gérer</a>
            </div>
            <div class="card-body">
                <div class="swiper bracongo-banner-swiper" style="border-radius:8px;overflow:hidden">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="dash-slide" style="background:linear-gradient(135deg,#E30613,#ff4d4d)">
                                <div>
                                    <h4 class="mb-1">{{ $statsSlides }} slide{{ $statsSlides > 1 ? 's' : '' }} actif{{ $statsSlides > 1 ? 's' : '' }}</h4>
                                    <p class="mb-0 opacity-75">Carrousel d'accueil administrable.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dash-slide" style="background:linear-gradient(135deg,#6d28d9,#db2777)">
                                <div>
                                    <h4 class="mb-1">100 % dynamique</h4>
                                    <p class="mb-0 opacity-75">Données issues de la base de données.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dash-slide" style="background:linear-gradient(135deg,#0F172A,#334155)">
                                <div>
                                    <h4 class="mb-1">Responsive</h4>
                                    <p class="mb-0 opacity-75">Adapté mobile & desktop.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <style>
                    .dash-slide {
                        min-height: 200px;
                        padding: 28px;
                        display: flex;
                        align-items: flex-end;
                        color: #fff;
                    }
                    @media (max-width: 576px) { .dash-slide { min-height: 150px; padding: 18px; } }
                </style>
            </div>
        </div>
    </div>
</div>

{{-- ===== MESSAGES + QUICK ACTIONS ===== --}}
<div class="row g-3">

    {{-- Derniers messages --}}
    <div class="col-xl-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Derniers messages</h5>
                <a href="{{ route('admin.messages.index') }}"
                   class="btn btn-sm btn-outline-primary">Voir tout</a>
            </div>
            <div class="card-body p-0">
                @if($derniersMessages->isEmpty())
                    <div class="p-4 text-center" style="color:var(--text-secondary)">
                        <i class="bi bi-inbox" style="font-size:2rem;opacity:.3"></i>
                        <p class="mt-2 mb-0">Aucun message pour le moment.</p>
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
                                <tr>
                                    <td>
                                        <div style="font-weight:600;font-size:.84rem">{{ $msg->name }}</div>
                                        <div style="font-size:.75rem;color:var(--text-secondary)">{{ $msg->email }}</div>
                                    </td>
                                    <td>
                                        @if(!$msg->lu)
                                            <span class="badge" style="background:var(--primary);font-size:.65rem;margin-right:4px">Nouveau</span>
                                        @endif
                                        {{ Str::limit($msg->subject ?? '—', 32) }}
                                    </td>
                                    <td style="white-space:nowrap;font-size:.82rem;color:var(--text-secondary)">
                                        {{ $msg->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.messages.show', $msg) }}"
                                           class="btn btn-sm btn-outline-primary" style="font-size:.75rem;padding:3px 10px">
                                            Ouvrir
                                        </a>
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
        <div class="card h-100">
            <div class="card-header">
                <h5>Actions rapides</h5>
            </div>
            <div class="card-body p-0">
                @php
                $actions = [
                    ['label' => 'Page Welcome',     'route' => route('admin.pages.welcome.edit'),      'icon' => 'bi-file-earmark-text', 'primary' => true],
                    ['label' => 'Page Accueil',     'route' => route('admin.pages.accueil.edit'),      'icon' => 'bi-house'],
                    ['label' => 'Notre Histoire',   'route' => route('admin.pages.histoire.edit'),     'icon' => 'bi-book'],
                    ['label' => 'Offres d\'emploi', 'route' => route('admin.offres-emploi.index'),     'icon' => 'bi-briefcase'],
                    ['label' => 'Messages',         'route' => route('admin.messages.index'),          'icon' => 'bi-envelope'],
                    ['label' => 'Paramètres',       'route' => route('admin.parametres.edit'),         'icon' => 'bi-gear'],
                ];
                @endphp
                @foreach($actions as $action)
                <a href="{{ $action['route'] }}"
                   class="d-flex align-items-center gap-3 px-4 py-3 text-decoration-none"
                   style="border-bottom:1px solid var(--border);transition:background .12s;color:var(--text-primary)"
                   onmouseover="this.style.background='var(--content-bg)'"
                   onmouseout="this.style.background='transparent'">
                    <i class="bi {{ $action['icon'] }}" style="font-size:1rem;color:{{ isset($action['primary']) ? 'var(--primary)' : 'var(--text-secondary)' }};width:20px;text-align:center"></i>
                    <span style="font-size:.875rem;font-weight:500">{{ $action['label'] }}</span>
                    <i class="bi bi-chevron-right ms-auto" style="font-size:.7rem;color:var(--text-secondary)"></i>
                </a>
                @endforeach
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
if (typeof Swiper !== 'undefined') {
    new Swiper('.bracongo-banner-swiper', {
        loop: true,
        slidesPerView: 1,
        pagination: { el: '.bracongo-banner-swiper .swiper-pagination', clickable: true },
        autoplay: { delay: 4500, disableOnInteraction: false }
    });
}
</script>
@endpush
