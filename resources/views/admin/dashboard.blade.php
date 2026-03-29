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
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div>
                    <h5 class="mb-0">Bannières — Hero Slides</h5>
                    <small class="text-muted">{{ $slidesForDashboard->count() }} visuel{{ $slidesForDashboard->count() > 1 ? 's' : '' }}
                        · {{ $statsSlides }} slide{{ $statsSlides > 1 ? 's' : '' }} actif{{ $statsSlides > 1 ? 's' : '' }} (carrousel)</small>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.pages.accueil.edit') }}"
                       class="btn btn-sm btn-outline-secondary">Page Accueil</a>
                    <a href="{{ route('admin.hero-slides.index') }}"
                       class="btn btn-sm btn-outline-primary">Hero slides</a>
                </div>
            </div>
            <div class="card-body">
                @if($slidesForDashboard->isEmpty())
                    <div class="text-center py-5 px-3" style="color:var(--text-secondary);border:1px dashed var(--border);border-radius:8px">
                        <i class="bi bi-image" style="font-size:2rem;opacity:.35"></i>
                        <p class="mt-2 mb-3">Aucune image pour l’instant. Ajoutez des visuels sur la page Accueil (sections) et dans les hero slides.</p>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="{{ route('admin.pages.accueil.edit') }}" class="btn btn-sm btn-primary">Page Accueil</a>
                            <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-sm btn-outline-primary">Gérer les slides</a>
                        </div>
                    </div>
                @else
                    <div class="swiper bracongo-banner-swiper" style="border-radius:8px;overflow:hidden">
                        <div class="swiper-wrapper">
                            @foreach($slidesForDashboard as $dashSlide)
                                <div class="swiper-slide">
                                    <a href="{{ $dashSlide['edit_url'] }}"
                                       class="dash-slide-link text-decoration-none d-block position-relative">
                                        <img src="{{ asset($dashSlide['image']) }}"
                                             alt="{{ $dashSlide['title'] }}"
                                             class="dash-slide-img"
                                             loading="lazy"
                                             width="1200"
                                             height="480">
                                        <div class="dash-slide-caption">
                                            <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                                                <strong class="text-white">{{ $dashSlide['title'] }}</strong>
                                                @if($dashSlide['kind'] === 'banner')
                                                    <span class="badge bg-info text-dark">Bannière accueil</span>
                                                @else
                                                    @if($dashSlide['active'] === false)
                                                        <span class="badge bg-warning text-dark">Inactif</span>
                                                    @else
                                                        <span class="badge bg-success">Actif</span>
                                                    @endif
                                                @endif
                                            </div>
                                            <p class="mb-0 small text-white-50">{{ $dashSlide['subtitle'] }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                @endif
                <style>
                    .dash-slide-link { border-radius: 8px; overflow: hidden; }
                    .dash-slide-img {
                        width: 100%;
                        height: auto;
                        min-height: 200px;
                        max-height: 420px;
                        object-fit: cover;
                        display: block;
                        vertical-align: middle;
                    }
                    .dash-slide-caption {
                        position: absolute;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        padding: 18px 20px;
                        background: linear-gradient(to top, rgba(0,0,0,.75), transparent);
                    }
                    @media (max-width: 576px) {
                        .dash-slide-img { min-height: 150px; max-height: 280px; }
                        .dash-slide-caption { padding: 12px 14px; }
                    }
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
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Swiper === 'undefined') return;
    var el = document.querySelector('.bracongo-banner-swiper');
    if (!el) return;
    var n = el.querySelectorAll('.swiper-slide').length;
    if (n === 0) return;
    new Swiper('.bracongo-banner-swiper', {
        loop: n > 1,
        slidesPerView: 1,
        spaceBetween: 0,
        pagination: { el: '.bracongo-banner-swiper .swiper-pagination', clickable: true },
        autoplay: n > 1 ? { delay: 4500, disableOnInteraction: false } : false
    });
});
</script>
@endpush
