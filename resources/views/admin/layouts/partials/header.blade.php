@php
    $topbarNonLus = \App\Models\MessageContact::where('lu', false)->count();
@endphp

<header class="a-topbar">

    {{-- Toggle sidebar --}}
    <button class="a-topbar-toggle a-sidebar-toggle" type="button" aria-label="Menu">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <line x1="3" y1="6"  x2="21" y2="6"/>
            <line x1="3" y1="12" x2="21" y2="12"/>
            <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
    </button>

    {{-- Left slot (breadcrumb / search pushed from views) --}}
    <div class="a-topbar-left">
        @stack('header-left')
    </div>

    {{-- Right actions --}}
    <div class="a-topbar-right">

        {{-- Slot for per-view actions --}}
        @stack('header-actions')

        {{-- Messages --}}
        <a href="{{ route('admin.messages.index') }}"
           class="a-icon-btn"
           title="{{ $topbarNonLus > 0 ? $topbarNonLus . ' message(s) non lu(s)' : 'Messages' }}">
            <i class="bi bi-envelope"></i>
            @if($topbarNonLus > 0)<span class="a-dot"></span>@endif
        </a>

        {{-- Site front-office --}}
        <a href="{{ url('/') }}" target="_blank" class="a-icon-btn" title="Voir le site">
            <i class="bi bi-box-arrow-up-right"></i>
        </a>

        {{-- User dropdown --}}
        <div class="dropdown">
            <a href="#" class="a-user-btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="a-user-avatar"
                     src="{{ asset('admin/images/user.jpg') }}"
                     alt="{{ Auth::user()->name ?? 'Admin' }}">
                <div class="a-user-info d-none d-sm-block">
                    <div class="a-user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div class="a-user-role">CMS</div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end a-dropdown">
                <li class="px-3 py-2" style="border-bottom:1px solid var(--border)">
                    <div style="font-weight:600;font-size:.84rem;color:var(--text-primary)">
                        {{ Auth::user()->name ?? 'Admin BRACONGO' }}
                    </div>
                    <div style="font-size:.74rem;color:var(--text-secondary)">
                        {{ Auth::user()->email ?? 'admin@bracongo.cd' }}
                    </div>
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0)">
                        <i class="bi bi-person me-2"></i>Profil
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.parametres.edit') }}">
                        <i class="bi bi-gear me-2"></i>Paramètres
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    @if(Route::has('logout'))
                    <a class="dropdown-item text-danger" href="javascript:void(0)"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit()">
                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @else
                    <a class="dropdown-item text-danger" href="javascript:void(0)">
                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                    </a>
                    @endif
                </li>
            </ul>
        </div>

    </div>

</header>
