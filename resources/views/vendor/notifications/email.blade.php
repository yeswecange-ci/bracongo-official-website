<x-mail::message>
{{-- Accroche --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# Oups !
@else
# Bonjour,
@endif
@endif

{{-- Corps --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Bouton d’action --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Texte après le bouton --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Formule de politesse --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Cordialement,<br>
{{ config('app.name') }}
@endif

{{-- Lien de secours (français uniquement) --}}
@isset($actionText)
<x-slot:subcopy>
Si le bouton « {{ $actionText }} » ne répond pas, copiez-collez l’adresse suivante dans la barre d’adresse de votre navigateur&nbsp;:
<span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
