@php
    $nonLus = \App\Models\MessageContact::where('lu', false)->count();
@endphp

<ul class="a-nav-list">

    {{-- Dashboard --}}
    <li>
        <a href="{{ route('admin.dashboard') }}"
           class="a-nav-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
            <i class="a-nav-icon bi bi-grid-1x2"></i>
            <span class="a-nav-text">Dashboard</span>
        </a>
    </li>

</ul>

<div class="a-nav-section">Contenu des Pages</div>

<ul class="a-nav-list">

    {{-- Page Welcome --}}
    <li>
        <a href="{{ route('admin.pages.welcome.edit') }}"
           class="a-nav-link {{ request()->routeIs('admin.pages.welcome.*') ? 'is-active' : '' }}">
            <i class="a-nav-icon bi bi-file-earmark-text"></i>
            <span class="a-nav-text">Page Welcome</span>
        </a>
    </li>

    {{-- Page Accueil --}}
    @php $accueilActive = request()->routeIs('admin.pages.accueil.*') || request()->routeIs('admin.hero-slides.*'); @endphp
    <li>
        <a href="javascript:void(0)"
           class="a-nav-link {{ $accueilActive ? 'is-active' : '' }}"
           data-sub="sub-accueil"
           aria-expanded="{{ $accueilActive ? 'true' : 'false' }}">
            <i class="a-nav-icon bi bi-house"></i>
            <span class="a-nav-text">Page Accueil</span>
            <i class="bi bi-chevron-down a-nav-arrow"></i>
        </a>
        <ul class="a-submenu a-nav-list" id="sub-accueil" style="{{ $accueilActive ? '' : 'display:none' }}">
            <li>
                <a href="{{ route('admin.pages.accueil.edit') }}"
                   class="a-nav-link {{ request()->routeIs('admin.pages.accueil.*') ? 'is-active' : '' }}">
                    <span class="a-nav-text">Sections</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.hero-slides.index') }}"
                   class="a-nav-link {{ request()->routeIs('admin.hero-slides.*') ? 'is-active' : '' }}">
                    <span class="a-nav-text">Hero Slides</span>
                </a>
            </li>
        </ul>
    </li>

    {{-- Notre Histoire --}}
    @php $histoireActive = request()->routeIs('admin.pages.histoire.*') || request()->routeIs('admin.valeurs.*'); @endphp
    <li>
        <a href="javascript:void(0)"
           class="a-nav-link {{ $histoireActive ? 'is-active' : '' }}"
           data-sub="sub-histoire"
           aria-expanded="{{ $histoireActive ? 'true' : 'false' }}">
            <i class="a-nav-icon bi bi-book"></i>
            <span class="a-nav-text">Notre Histoire</span>
            <i class="bi bi-chevron-down a-nav-arrow"></i>
        </a>
        <ul class="a-submenu a-nav-list" id="sub-histoire" style="{{ $histoireActive ? '' : 'display:none' }}">
            <li>
                <a href="{{ route('admin.pages.histoire.edit') }}"
                   class="a-nav-link {{ request()->routeIs('admin.pages.histoire.*') ? 'is-active' : '' }}">
                    <span class="a-nav-text">Sections</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.valeurs.index') }}"
                   class="a-nav-link {{ request()->routeIs('admin.valeurs.*') ? 'is-active' : '' }}">
                    <span class="a-nav-text">Valeurs PREMIERS</span>
                </a>
            </li>
        </ul>
    </li>

    {{-- Carrière --}}
    @php $carriereActive = request()->routeIs('admin.pages.carriere.*') || request()->routeIs('admin.offres-emploi.*'); @endphp
    <li>
        <a href="javascript:void(0)"
           class="a-nav-link {{ $carriereActive ? 'is-active' : '' }}"
           data-sub="sub-carriere"
           aria-expanded="{{ $carriereActive ? 'true' : 'false' }}">
            <i class="a-nav-icon bi bi-briefcase"></i>
            <span class="a-nav-text">Carrière</span>
            <i class="bi bi-chevron-down a-nav-arrow"></i>
        </a>
        <ul class="a-submenu a-nav-list" id="sub-carriere" style="{{ $carriereActive ? '' : 'display:none' }}">
            <li>
                <a href="{{ route('admin.pages.carriere.edit') }}"
                   class="a-nav-link {{ request()->routeIs('admin.pages.carriere.*') ? 'is-active' : '' }}">
                    <span class="a-nav-text">Page Carrière</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.offres-emploi.index') }}"
                   class="a-nav-link {{ request()->routeIs('admin.offres-emploi.*') ? 'is-active' : '' }}">
                    <span class="a-nav-text">Offres d'emploi</span>
                </a>
            </li>
        </ul>
    </li>

    {{-- Contact --}}
    @php $contactActive = request()->routeIs('admin.pages.contact.*') || request()->routeIs('admin.messages.*'); @endphp
    <li>
        <a href="javascript:void(0)"
           class="a-nav-link {{ $contactActive ? 'is-active' : '' }}"
           data-sub="sub-contact"
           aria-expanded="{{ $contactActive ? 'true' : 'false' }}">
            <i class="a-nav-icon bi bi-envelope"></i>
            <span class="a-nav-text">Contact</span>
            @if($nonLus > 0)<span class="a-badge">{{ $nonLus }}</span>@endif
            <i class="bi bi-chevron-down a-nav-arrow"></i>
        </a>
        <ul class="a-submenu a-nav-list" id="sub-contact" style="{{ $contactActive ? '' : 'display:none' }}">
            <li>
                <a href="{{ route('admin.pages.contact.edit') }}"
                   class="a-nav-link {{ request()->routeIs('admin.pages.contact.*') ? 'is-active' : '' }}">
                    <span class="a-nav-text">Page Contact</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.messages.index') }}"
                   class="a-nav-link {{ request()->routeIs('admin.messages.*') ? 'is-active' : '' }}">
                    <span class="a-nav-text">
                        Messages
                        @if($nonLus > 0)<span class="a-badge" style="margin-left:6px">{{ $nonLus }}</span>@endif
                    </span>
                </a>
            </li>
        </ul>
    </li>

    {{-- Bracongo Pro --}}
    <li>
        <a href="{{ route('admin.pages.pro.edit') }}"
           class="a-nav-link {{ request()->routeIs('admin.pages.pro.*') ? 'is-active' : '' }}">
            <i class="a-nav-icon bi bi-shield-check"></i>
            <span class="a-nav-text">Bracongo Pro</span>
        </a>
    </li>

</ul>

<div class="a-nav-section">Catalogue</div>

<ul class="a-nav-list">

    {{-- Marques & Boissons --}}
    @php $catalogueActive = request()->routeIs('admin.marques.*') || request()->routeIs('admin.boissons.*') || request()->routeIs('admin.pages.bieres.*') || request()->routeIs('admin.pages.categorie-boissons.*'); @endphp
    <li>
        <a href="javascript:void(0)"
           class="a-nav-link {{ $catalogueActive ? 'is-active' : '' }}"
           data-sub="sub-catalogue"
           aria-expanded="{{ $catalogueActive ? 'true' : 'false' }}">
            <i class="a-nav-icon bi bi-droplet"></i>
            <span class="a-nav-text">Marques & Boissons</span>
            <i class="bi bi-chevron-down a-nav-arrow"></i>
        </a>
        <ul class="a-submenu a-nav-list" id="sub-catalogue" style="{{ $catalogueActive ? '' : 'display:none' }}">
            <li>
                <a href="{{ route('admin.pages.bieres.edit') }}"
                   class="a-nav-link {{ request()->routeIs('admin.pages.bieres.*') ? 'is-active' : '' }}">
                    <span class="a-nav-text">Page Nos bières</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pages.categorie-boissons.edit', 'eaux') }}"
                   class="a-nav-link {{ request()->routeIs('admin.pages.categorie-boissons.edit') && request()->route('categorie') === 'eaux' ? 'is-active' : '' }}">
                    <span class="a-nav-text">Page Eaux</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pages.categorie-boissons.edit', 'gazeuses') }}"
                   class="a-nav-link {{ request()->routeIs('admin.pages.categorie-boissons.edit') && request()->route('categorie') === 'gazeuses' ? 'is-active' : '' }}">
                    <span class="a-nav-text">Page Boissons gazeuses</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pages.categorie-boissons.edit', 'energisantes') }}"
                   class="a-nav-link {{ request()->routeIs('admin.pages.categorie-boissons.edit') && request()->route('categorie') === 'energisantes' ? 'is-active' : '' }}">
                    <span class="a-nav-text">Page Boissons énergisantes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.marques.index') }}"
                   class="a-nav-link {{ request()->routeIs('admin.marques.*') ? 'is-active' : '' }}">
                    <span class="a-nav-text">Marques</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.boissons.index') }}"
                   class="a-nav-link {{ request()->routeIs('admin.boissons.*') ? 'is-active' : '' }}">
                    <span class="a-nav-text">Boissons</span>
                </a>
            </li>
        </ul>
    </li>

    {{-- News --}}
    <li>
        <a href="{{ route('admin.news.index') }}"
           class="a-nav-link {{ request()->routeIs('admin.news.*') ? 'is-active' : '' }}">
            <i class="a-nav-icon bi bi-newspaper"></i>
            <span class="a-nav-text">News & Actualités</span>
        </a>
    </li>

    {{-- Produits (backend only) --}}
    <li>
        <a href="{{ route('admin.produits.index') }}"
           class="a-nav-link {{ request()->routeIs('admin.produits.*') ? 'is-active' : '' }}">
            <i class="a-nav-icon bi bi-bag"></i>
            <span class="a-nav-text">
                Produits&nbsp;<small style="opacity:.55;font-size:.7em;font-weight:400">(backend)</small>
            </span>
        </a>
    </li>

</ul>

<div class="a-nav-section">Site Global</div>

<ul class="a-nav-list">

    {{-- Navigation --}}
    <li>
        <a href="{{ route('admin.navigation.index') }}"
           class="a-nav-link {{ request()->routeIs('admin.navigation.*') ? 'is-active' : '' }}">
            <i class="a-nav-icon bi bi-list-ul"></i>
            <span class="a-nav-text">Navigation</span>
        </a>
    </li>

    {{-- Footer --}}
    @php $footerActive = request()->routeIs('admin.footer.*') || request()->routeIs('admin.footer-gallery.*') || request()->routeIs('admin.reseaux-sociaux.*'); @endphp
    <li>
        <a href="javascript:void(0)"
           class="a-nav-link {{ $footerActive ? 'is-active' : '' }}"
           data-sub="sub-footer"
           aria-expanded="{{ $footerActive ? 'true' : 'false' }}">
            <i class="a-nav-icon bi bi-layout-bottom"></i>
            <span class="a-nav-text">Footer</span>
            <i class="bi bi-chevron-down a-nav-arrow"></i>
        </a>
        <ul class="a-submenu a-nav-list" id="sub-footer" style="{{ $footerActive ? '' : 'display:none' }}">
            <li>
                <a href="{{ route('admin.footer.edit') }}"
                   class="a-nav-link {{ request()->routeIs('admin.footer.edit') || request()->routeIs('admin.footer.update') ? 'is-active' : '' }}">
                    <span class="a-nav-text">Infos Footer</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.footer-gallery.index') }}"
                   class="a-nav-link {{ request()->routeIs('admin.footer-gallery.*') ? 'is-active' : '' }}">
                    <span class="a-nav-text">Galerie</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reseaux-sociaux.index') }}"
                   class="a-nav-link {{ request()->routeIs('admin.reseaux-sociaux.*') ? 'is-active' : '' }}">
                    <span class="a-nav-text">Réseaux sociaux</span>
                </a>
            </li>
        </ul>
    </li>

    {{-- Paramètres --}}
    <li>
        <a href="{{ route('admin.parametres.edit') }}"
           class="a-nav-link {{ request()->routeIs('admin.parametres.*') ? 'is-active' : '' }}">
            <i class="a-nav-icon bi bi-gear"></i>
            <span class="a-nav-text">Paramètres</span>
        </a>
    </li>

</ul>
