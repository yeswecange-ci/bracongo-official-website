<x-mail::layout>
    {{-- En-tête --}}
    <x-slot:header>
        <x-mail::header :url="config('app.url')">
            {{ config('app.name') }}
        </x-mail::header>
    </x-slot:header>

    {{-- Corps --}}
    {{ $slot }}

    {{-- Sous-bloc --}}
    @isset($subcopy)
        <x-slot:subcopy>
            <x-mail::subcopy>
                {{ $subcopy }}
            </x-mail::subcopy>
        </x-slot:subcopy>
    @endisset

    {{-- Pied de page --}}
    <x-slot:footer>
        <x-mail::footer>
            © {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.
        </x-mail::footer>
    </x-slot:footer>
</x-mail::layout>
