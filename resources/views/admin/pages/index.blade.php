@extends('admin.layouts.app')

@section('title', 'Pages (CMS)')

@push('styles')
<link href="{{ asset('admin/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/vendor/datatables/responsive/responsive.css') }}" rel="stylesheet">
<link href="{{ asset('admin/vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">
<style>
	.dataTables_wrapper .dataTables_paginate {
		display: flex;
		justify-content: flex-end;
		align-items: center;
		gap: 8px;
		flex-wrap: wrap;
	}
	.dataTables_wrapper .dataTables_paginate .paginate_button {
		white-space: nowrap;
		word-break: normal;
		overflow-wrap: normal;
		min-width: unset;
	}
	.dataTables_wrapper .dataTables_paginate .ellipsis {
		white-space: nowrap;
	}
</style>
@endpush

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pages</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Pages du site (CMS)</h6>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header d-flex flex-wrap gap-2 justify-content-between align-items-center">
				<h5 class="mb-0">Pages du site (CMS)</h5>
				<div class="d-flex flex-wrap gap-2">
					<a href="{{ route('admin.pages.create') }}" class="btn btn-primary btn-sm">Créer / éditer</a>
					<button type="button" class="btn btn-outline-secondary btn-sm" id="btnRefresh">Rafraîchir</button>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="pagesTable" class="display" style="min-width: 845px">
						<thead>
							<tr>
								<th>Page</th>
								<th>Slug</th>
								<th>Statut</th>
								<th>Dernière modif.</th>
								<th class="text-end">Actions</th>
							</tr>
						</thead>
						<tbody id="pagesTbody">
						</tbody>
					</table>
				</div>
				<div class="mt-3 text-muted">
					<small>
						Remarque : aujourd'hui c'est un mock JS. Plus tard, la table sera alimentée par la BD (Laravel).
					</small>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('admin/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/responsive/responsive.js') }}"></script>
<script>
	const mockPages = [
		{ title: "Accueil", slug: "home", status: "Publié", updatedAt: "2026-03-18 10:12" },
		{ title: "Actualités", slug: "actualites", status: "Publié", updatedAt: "2026-03-14 09:00" },
		{ title: "Nos produits", slug: "produits", status: "Brouillon", updatedAt: "2026-03-10 16:45" },
		{ title: "Notre engagement", slug: "engagement", status: "Publié", updatedAt: "2026-02-28 08:30" },
		{ title: "Carrière", slug: "carriere", status: "Brouillon", updatedAt: "2026-02-20 13:20" },
		{ title: "Contact", slug: "contact", status: "Publié", updatedAt: "2026-02-01 11:05" },
	];

	function badge(status) {
		if (status === "Publié") return '<span class="a-status a-status--published">Publié</span>';
		if (status === "Brouillon") return '<span class="a-status a-status--draft">Brouillon</span>';
		return '<span class="a-status a-status--inactive">' + status + '</span>';
	}

	function renderRows() {
		const tbody = document.getElementById("pagesTbody");
		tbody.innerHTML = mockPages.map(p => `
			<tr>
				<td>${p.title}</td>
				<td><code>${p.slug}</code></td>
				<td>${badge(p.status)}</td>
				<td>${p.updatedAt}</td>
				<td class="text-end">
					<a class="btn btn-sm btn-outline-primary" href="{{ route('admin.pages.create') }}?slug=${encodeURIComponent(p.slug)}">Éditer</a>
				</td>
			</tr>
		`).join("");
	}

	renderRows();

	if (window.jQuery && jQuery.fn.DataTable) {
		jQuery("#pagesTable").DataTable({
			pageLength: 10,
			responsive: true,
			language: { paginate: { previous: "<<", next: ">>" } }
		});
	}

	document.getElementById("btnRefresh").addEventListener("click", () => { renderRows(); });
</script>
@endpush
