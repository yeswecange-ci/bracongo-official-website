<div class="row g-3">
	<div class="col-12">
		<x-admin.image-upload name="image" label="Image" :value="isset($footerGallery) ? $footerGallery->image : null" :required="true" help="PNG, JPG, GIF — max 2 Mo" />
	</div>
</div>
