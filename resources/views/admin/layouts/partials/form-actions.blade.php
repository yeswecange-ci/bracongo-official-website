@props(['cancelUrl'])
<div {{ $attributes->merge(['class' => 'a-form-actions mt-4 pt-3 border-top d-flex flex-wrap gap-2 justify-content-end align-items-center']) }}>
    <a href="{{ $cancelUrl }}" class="btn btn-outline-secondary">
        <i class="bi bi-x-lg me-1"></i>Annuler
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check2 me-1"></i>Enregistrer
    </button>
</div>
