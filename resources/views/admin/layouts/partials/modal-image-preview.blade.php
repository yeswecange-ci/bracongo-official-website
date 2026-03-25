{{-- Modale partagée pour prévisualiser les images uploadées --}}
<div class="modal fade" id="modalPreviewImage" tabindex="-1" aria-labelledby="modalPreviewImageLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header py-2">
				<h5 class="modal-title small" id="modalPreviewImageLabel">Aperçu</h5>
				<button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body text-center p-4">
				<img id="modalPreviewImageSrc" src="" alt="" class="img-fluid rounded" style="max-height:70vh;object-fit:contain;">
			</div>
		</div>
	</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
	document.addEventListener('change', function(e) {
		if (!e.target.matches || !e.target.matches('input.image-upload-input[type="file"]')) return;
		var field = e.target.closest('.image-upload-field');
		if (!field) return;
		var filenameEl = field.querySelector('.image-upload-filename');
		var previewEl = field.querySelector('.image-upload-preview');
		var placeholderEl = field.querySelector('.image-upload-placeholder');
		if (e.target.files && e.target.files[0]) {
			filenameEl.textContent = e.target.files[0].name;
			var reader = new FileReader();
			reader.onload = function(ev) {
				if (!previewEl.querySelector('img')) {
					previewEl.innerHTML = '<img src="" alt="Prévisualisation" style="height:60px;max-width:120px;object-fit:contain;border:1px solid #dee2e6;border-radius:8px;padding:4px;background:#f8f9fa;"><span class="badge badge-primary position-absolute top-0 end-0 translate-middle" style="font-size:10px;">Prévisualiser</span>';
					previewEl.setAttribute('data-bs-toggle', 'modal');
					previewEl.setAttribute('data-bs-target', '#modalPreviewImage');
					previewEl.style.cursor = 'pointer';
					previewEl.classList.add('position-relative');
				}
				previewEl.querySelector('img').src = ev.target.result;
				previewEl.classList.remove('d-none');
				if (placeholderEl) placeholderEl.classList.add('d-none');
			};
			reader.readAsDataURL(e.target.files[0]);
		} else {
			filenameEl.textContent = 'Aucun fichier sélectionné';
		}
	});
	document.addEventListener('click', function(e) {
		var preview = e.target.closest('.image-upload-preview');
		if (preview) {
			var img = preview.querySelector('img');
			var modalSrc = document.getElementById('modalPreviewImageSrc');
			if (img && modalSrc) { modalSrc.src = img.src; modalSrc.alt = img.alt || 'Aperçu'; }
		}
		var thumb = e.target.closest('.img-thumb-preview');
		if (thumb && thumb.dataset.src) {
			var modalSrc = document.getElementById('modalPreviewImageSrc');
			if (modalSrc) { modalSrc.src = thumb.dataset.src; modalSrc.alt = thumb.dataset.alt || ''; }
		}
	});
	document.querySelectorAll('.img-thumb-preview').forEach(function(el) {
		el.addEventListener('mouseenter', function() { var i = this.querySelector('img'); if (i) i.style.borderColor = '#E30613'; });
		el.addEventListener('mouseleave', function() { var i = this.querySelector('img'); if (i) i.style.borderColor = 'transparent'; });
	});
});
</script>
