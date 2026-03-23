<div class="deznav">
	<div class="deznav-scroll">
		<ul class="metismenu" id="menu">

			{{-- Dashboard --}}
			<li class="{{ request()->routeIs('admin.dashboard') ? 'mm-active' : '' }}">
				<a href="{{ route('admin.dashboard') }}">
					<i class="flaticon-381-home"></i><span class="nav-text">Dashboard</span>
				</a>
			</li>

			<li class="menu-title mt-2">Contenu des Pages</li>

			{{-- Page Welcome --}}
			<li class="{{ request()->routeIs('admin.pages.welcome.*') ? 'mm-active' : '' }}">
				<a href="{{ route('admin.pages.welcome.edit') }}">
					<i class="flaticon-381-id-card-4"></i><span class="nav-text">Page Welcome</span>
				</a>
			</li>

			{{-- Page Accueil --}}
			<li class="{{ request()->routeIs('admin.pages.accueil.*') || request()->routeIs('admin.hero-slides.*') ? 'mm-active' : '' }}">
				<a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->routeIs('admin.pages.accueil.*') || request()->routeIs('admin.hero-slides.*') ? 'true' : 'false' }}">
					<i class="flaticon-381-home-2"></i><span class="nav-text">Page Accueil</span>
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
					<i class="flaticon-381-notebook-5"></i><span class="nav-text">Notre Histoire</span>
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
					<i class="flaticon-381-user-7"></i><span class="nav-text">Carrière</span>
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
					<i class="flaticon-381-telephone-1"></i><span class="nav-text">Contact</span>
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
				<a href="{{ route('admin.pages.pro.edit') }}">
					<i class="flaticon-381-smartphone-4"></i><span class="nav-text">Bracongo Pro</span>
				</a>
			</li>

			<li class="menu-title mt-2">Site Global</li>

			{{-- Navigation --}}
			<li class="{{ request()->routeIs('admin.navigation.*') ? 'mm-active' : '' }}">
				<a href="{{ route('admin.navigation.index') }}">
					<i class="flaticon-381-menu-1"></i><span class="nav-text">Navigation</span>
				</a>
			</li>

			{{-- Footer --}}
			<li class="{{ request()->routeIs('admin.footer.*') || request()->routeIs('admin.footer-gallery.*') || request()->routeIs('admin.reseaux-sociaux.*') ? 'mm-active' : '' }}">
				<a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ request()->routeIs('admin.footer.*') || request()->routeIs('admin.footer-gallery.*') || request()->routeIs('admin.reseaux-sociaux.*') ? 'true' : 'false' }}">
					<i class="flaticon-381-layout-3"></i><span class="nav-text">Footer</span>
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
				<a href="{{ route('admin.parametres.edit') }}">
					<i class="flaticon-381-settings-2"></i><span class="nav-text">Paramètres</span>
				</a>
			</li>

		</ul>
	</div>
</div>
