<!DOCTYPE html>
<html lang="fr">

<head>
	<title>BRACONGO — @yield('title', 'Admin')</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="BRACONGO">
	<meta name="robots" content="noindex, nofollow">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="shortcut icon" type="image/png" href="{{ asset('admin/images/favicon.png') }}">
	<link href="{{ asset('admin/vendor/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet">

	@stack('styles')

	<link class="main-css" href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

	<style>
		:root {
			--primary: #E30613;
			--primary-hover: #c70511;
			--primary-light: rgba(227, 6, 19, 0.1);
		}

		.content-body .container-fluid {
			padding-top: 10px;
		}

		@media (max-width: 576px) {
			.content-body .container-fluid {
				padding-top: 6px;
			}
		}

		body.bracongo-no-sidebar [data-sidebar-style] .content-body,
		body.bracongo-no-sidebar .content-body {
			margin-left: 0 !important;
		}

		body.bracongo-no-sidebar .content-body .container-fluid {
			padding-left: 24px;
			padding-right: 24px;
		}

		@media (max-width: 576px) {
			body.bracongo-no-sidebar .content-body .container-fluid {
				padding-left: 16px;
				padding-right: 16px;
			}
		}

		.nav-header .brand-logo .logo-abbr rect:first-child {
			fill: #E30613;
		}
	</style>
</head>

<body class="@yield('body-class')">
	<div id="preloader">
		<div class="loading-wave">
			<div class="loading-bar"></div>
			<div class="loading-bar"></div>
			<div class="loading-bar"></div>
			<div class="loading-bar"></div>
		</div>
	</div>

	<div id="main-wrapper" class="show">
		@include('admin.layouts.partials.nav-header')

		@yield('header')

		@hasSection('sidebar')
			@yield('sidebar')
		@endif

		<div class="content-body">
			<div class="container-fluid">
				@yield('content')
			</div>
		</div>

		@include('admin.layouts.partials.footer')
	</div>

	<script src="{{ asset('admin/vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('admin/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
	@stack('scripts-vendor')
	<script src="{{ asset('admin/js/custom.min.js') }}"></script>
	<script src="{{ asset('admin/js/ic-sidenav-init.js') }}"></script>
	@stack('scripts')
</body>

</html>
