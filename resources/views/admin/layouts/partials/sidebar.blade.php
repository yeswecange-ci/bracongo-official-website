<div class="deznav">
	<div class="deznav-scroll">
		<ul class="metismenu" id="menu">
			<li class="menu-title">CMS</li>
			<li class="{{ ($currentPage ?? '') === 'dashboard' ? 'mm-active' : '' }}">
				<a href="{{ route('admin.dashboard') }}">
					<i class="flaticon-381-home"></i><span class="nav-text">Dashboard</span>
				</a>
			</li>
			<li class="{{ in_array($currentPage ?? '', ['pages', 'page-edit']) ? 'mm-active' : '' }}">
				<a class="has-arrow" href="javascript:void(0);" aria-expanded="{{ in_array($currentPage ?? '', ['pages', 'page-edit']) ? 'true' : 'false' }}">
					<i class="flaticon-381-file"></i><span class="nav-text">Pages</span>
				</a>
				<ul aria-expanded="{{ in_array($currentPage ?? '', ['pages', 'page-edit']) ? 'true' : 'false' }}">
					<li class="{{ ($currentPage ?? '') === 'pages' ? 'mm-active' : '' }}">
						<a href="{{ route('admin.pages.index') }}">Liste des pages</a>
					</li>
					<li class="{{ ($currentPage ?? '') === 'page-edit' ? 'mm-active' : '' }}">
						<a href="{{ route('admin.pages.create') }}">Éditer une page</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>
