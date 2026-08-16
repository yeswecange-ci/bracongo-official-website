@php $iconeCourante = old('icone', $section->icone ?? \App\Models\FaqSection::ICONE_DEFAUT); @endphp

<div class="row g-3">
	<div class="col-12">
		<label class="form-label fw-semibold">Titre de la rubrique <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre"
			value="{{ old('titre', $section->titre ?? '') }}" placeholder="Ex. : Commandes &amp; distribution">
		@error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
		<div class="form-text">C'est l'intertitre affiché sur la page FAQ, au-dessus du groupe de questions.</div>
	</div>

	<div class="col-12">
		<label class="form-label fw-semibold">Icône <span class="text-danger">*</span></label>
		@error('icone')<div class="text-danger small mb-1">{{ $message }}</div>@enderror
		<div class="d-flex flex-wrap gap-2">
			@foreach(\App\Models\FaqSection::ICONES as $cle => $icone)
			<label class="a-icon-choice d-flex align-items-center gap-2 border rounded px-3 py-2 {{ $iconeCourante === $cle ? 'border-primary bg-primary-subtle' : '' }}" style="cursor:pointer">
				<input type="radio" class="form-check-input mt-0" name="icone" value="{{ $cle }}" {{ $iconeCourante === $cle ? 'checked' : '' }}>
				<svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icone['path'] }}"/>
				</svg>
				<span class="small">{{ $icone['label'] }}</span>
			</label>
			@endforeach
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
	var choix = document.querySelectorAll('.a-icon-choice');
	choix.forEach(function (label) {
		label.addEventListener('click', function () {
			choix.forEach(function (autre) { autre.classList.remove('border-primary', 'bg-primary-subtle'); });
			label.classList.add('border-primary', 'bg-primary-subtle');
		});
	});
});
</script>
