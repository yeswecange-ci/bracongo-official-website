<div class="ic-sidenav">
	<div class="ic-sidenav-scroll">
		<ul class="metismenu" id="menu">

			{{-- Dashboard --}}
			<li class="{{ request()->routeIs('admin.dashboard') ? 'mm-active' : '' }}">
				<a href="{{ route('admin.dashboard') }}" class="ai-icon" aria-expanded="false">
					<i class="flaticon-home"></i>
					<span class="nav-text">Dashboard</span>
				</a>
			</li>

			<li class="menu-title mt-2">Contenu des Pages</li>

			{{-- Page Welcome --}}
			<li class="{{ request()->routeIs('admin.pages.welcome.*') ? 'mm-active' : '' }}">
				<a href="{{ route('admin.pages.welcome.edit') }}" class="ai-icon" aria-expanded="false">
					<i class="flaticon-file"></i>
					<span class="nav-text">Page Welcome</span>
				</a>
			</li>

			{{-- Page Accueil --}}
			<li class="{{ request()->routeIs('admin.pages.accueil.*') || request()->routeIs('admin.hero-slides.*') ? 'mm-active' : '' }}">
				<a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->routeIs('admin.pages.accueil.*') || request()->routeIs('admin.hero-slides.*') ? 'true' : 'false' }}">
					<i class="flaticon-cms"></i>
					<span class="nav-text">Page Accueil</span>
				</a>
				<ul aria-expanded="{{ request()->routeIs('admin.pages.accueil.*') || request()->routeIs('admin.hero-slides.*') ? 'true' : 'false' }}">
					<li class="{{ request()->routeIs('admin.pages.accueil.*') ? 'mm-active' : '' }}">
						<a href="{{ route('admin.pages.accueil.edit') }}">Sections</a>
					</li>
					<li class="{{ request()->routeIs('admin.hero-slides.*') ? 'mm-active' : '' }}">
						<a href="{{ route('admin.hero-slides.index') }}">Hero Slides</a>
					</li>
				</ul>
			</li>

			{{-- Page Histoire --}}
			<li class="{{ request()->routeIs('admin.pages.histoire.*') || request()->routeIs('admin.valeurs.*') ? 'mm-active' : '' }}">
				<a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->routeIs('admin.pages.histoire.*') || request()->routeIs('admin.valeurs.*') ? 'true' : 'false' }}">
					<i class="flaticon-blog"></i>
					<span class="nav-text">Notre Histoire</span>
				</a>
				<ul aria-expanded="{{ request()->routeIs('admin.pages.histoire.*') || request()->routeIs('admin.valeurs.*') ? 'true' : 'false' }}">
					<li class="{{ request()->routeIs('admin.pages.histoire.*') ? 'mm-active' : '' }}">
						<a href="{{ route('admin.pages.histoire.edit') }}">Sections</a>
					</li>
					<li class="{{ request()->routeIs('admin.valeurs.*') ? 'mm-active' : '' }}">
						<a href="{{ route('admin.valeurs.index') }}">Valeurs PREMIERS</a>
					</li>
				</ul>
			</li>

			{{-- Carrière --}}
			<li class="{{ request()->routeIs('admin.pages.carriere.*') || request()->routeIs('admin.offres-emploi.*') ? 'mm-active' : '' }}">
				<a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->routeIs('admin.pages.carriere.*') || request()->routeIs('admin.offres-emploi.*') ? 'true' : 'false' }}">
					<i class="flaticon-user"></i>
					<span class="nav-text">Carrière</span>
				</a>
				<ul aria-expanded="{{ request()->routeIs('admin.pages.carriere.*') || request()->routeIs('admin.offres-emploi.*') ? 'true' : 'false' }}">
					<li class="{{ request()->routeIs('admin.pages.carriere.*') ? 'mm-active' : '' }}">
						<a href="{{ route('admin.pages.carriere.edit') }}">Page Carrière</a>
					</li>
					<li class="{{ request()->routeIs('admin.offres-emploi.*') ? 'mm-active' : '' }}">
						<a href="{{ route('admin.offres-emploi.index') }}">Offres d'emploi</a>
					</li>
				</ul>
			</li>

			{{-- Contact --}}
			<li class="{{ request()->routeIs('admin.pages.contact.*') || request()->routeIs('admin.messages.*') ? 'mm-active' : '' }}">
				<a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->routeIs('admin.pages.contact.*') || request()->routeIs('admin.messages.*') ? 'true' : 'false' }}">
					<i class="flaticon-phone-book"></i>
					<span class="nav-text">Contact</span>
				</a>
				<ul aria-expanded="{{ request()->routeIs('admin.pages.contact.*') || request()->routeIs('admin.messages.*') ? 'true' : 'false' }}">
					<li class="{{ request()->routeIs('admin.pages.contact.*') ? 'mm-active' : '' }}">
						<a href="{{ route('admin.pages.contact.edit') }}">Page Contact</a>
					</li>
					<li class="{{ request()->routeIs('admin.messages.*') ? 'mm-active' : '' }}">
						<a href="{{ route('admin.messages.index') }}">
							Messages
							@php $nonLus = \App\Models\MessageContact::where('lu', false)->count(); @endphp
							@if($nonLus > 0)
								<span class="badge badge-xs badge-danger ml-1">{{ $nonLus }}</span>
							@endif
						</a>
					</li>
				</ul>
			</li>

			{{-- Bracongo Pro --}}
			<li class="{{ request()->routeIs('admin.pages.pro.*') ? 'mm-active' : '' }}">
				<a href="{{ route('admin.pages.pro.edit') }}" class="ai-icon" aria-expanded="false">
					<i class="flaticon-approved"></i>
					<span class="nav-text">Bracongo Pro</span>
				</a>
			</li>

			<li class="menu-title mt-2">Catalogue</li>

		{{-- Marques & Boissons --}}
		<li class="{{ request()->routeIs('admin.marques.*') || request()->routeIs('admin.boissons.*') ? 'mm-active' : '' }}">
			<a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->routeIs('admin.marques.*') || request()->routeIs('admin.boissons.*') ? 'true' : 'false' }}">
				<i class="flaticon-approved"></i>
				<span class="nav-text">Marques & Boissons</span>
			</a>
			<ul aria-expanded="{{ request()->routeIs('admin.marques.*') || request()->routeIs('admin.boissons.*') ? 'true' : 'false' }}">
				<li class="{{ request()->routeIs('admin.marques.*') ? 'mm-active' : '' }}">
					<a href="{{ route('admin.marques.index') }}">Marques</a>
				</li>
				<li class="{{ request()->routeIs('admin.boissons.*') ? 'mm-active' : '' }}">
					<a href="{{ route('admin.boissons.index') }}">Boissons</a>
				</li>
			</ul>
		</li>

		{{-- News --}}
		<li class="{{ request()->routeIs('admin.news.*') ? 'mm-active' : '' }}">
			<a href="{{ route('admin.news.index') }}" class="ai-icon" aria-expanded="false">
				<i class="flaticon-blog"></i>
				<span class="nav-text">News & Actualités</span>
			</a>
		</li>

		{{-- Produits (goodies - backend only) --}}
		<li class="{{ request()->routeIs('admin.produits.*') ? 'mm-active' : '' }}">
			<a href="{{ route('admin.produits.index') }}" class="ai-icon" aria-expanded="false">
				<i class="flaticon-store"></i>
				<span class="nav-text">Produits <small class="text-muted">(backend)</small></span>
			</a>
		</li>

		<li class="menu-title mt-2">Site Global</li>

			{{-- Navigation --}}
			<li class="{{ request()->routeIs('admin.navigation.*') ? 'mm-active' : '' }}">
				<a href="{{ route('admin.navigation.index') }}" class="ai-icon" aria-expanded="false">
					<i class="flaticon-registration"></i>
					<span class="nav-text">Navigation</span>
				</a>
			</li>

			{{-- Footer --}}
			<li class="{{ request()->routeIs('admin.footer.*') || request()->routeIs('admin.footer-gallery.*') || request()->routeIs('admin.reseaux-sociaux.*') ? 'mm-active' : '' }}">
				<a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->routeIs('admin.footer.*') || request()->routeIs('admin.footer-gallery.*') || request()->routeIs('admin.reseaux-sociaux.*') ? 'true' : 'false' }}">
					<i class="flaticon-grid"></i>
					<span class="nav-text">Footer</span>
				</a>
				<ul aria-expanded="{{ request()->routeIs('admin.footer.*') || request()->routeIs('admin.footer-gallery.*') || request()->routeIs('admin.reseaux-sociaux.*') ? 'true' : 'false' }}">
					<li class="{{ request()->routeIs('admin.footer.edit') || request()->routeIs('admin.footer.update') ? 'mm-active' : '' }}">
						<a href="{{ route('admin.footer.edit') }}">Infos Footer</a>
					</li>
					<li class="{{ request()->routeIs('admin.footer-gallery.*') ? 'mm-active' : '' }}">
						<a href="{{ route('admin.footer-gallery.index') }}">Galerie</a>
					</li>
					<li class="{{ request()->routeIs('admin.reseaux-sociaux.*') ? 'mm-active' : '' }}">
						<a href="{{ route('admin.reseaux-sociaux.index') }}">Réseaux sociaux</a>
					</li>
				</ul>
			</li>

			{{-- Paramètres --}}
			<li class="{{ request()->routeIs('admin.parametres.*') ? 'mm-active' : '' }}">
				<a href="{{ route('admin.parametres.edit') }}" class="ai-icon" aria-expanded="false">
					<i class="flaticon flaticon-app"></i>
					<span class="nav-text">Paramètres</span>
				</a>
			</li>

		</ul>
	</div>
</div>
