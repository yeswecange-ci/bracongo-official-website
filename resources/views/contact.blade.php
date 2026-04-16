@extends('layout.app')

@section('title', $contact->hero_titre ?? 'Nos Contacts')

@section('content')
    @php
        $brandIcon = asset($parametres->logo ?? 'img/Group.png');
    @endphp
    <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
        <img src="{{ asset($contact->hero_image ?? 'img/usine-bracongo-2.jpg') }}" alt="Nos Contacts Banner" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-center uppercase tracking-widest">
               {{ $contact->hero_titre ?? 'Nos Contacts' }}
            </h1>
        </div>
    </div>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            @if(session('success'))
            <div class="mb-8 bg-green-50 border border-green-200 rounded-2xl p-4 text-green-800 font-medium text-center">
                {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
                
                <div class="space-y-8">
                    <div class="bg-[#F8F8F8] rounded-[2.5rem] p-10 md:p-16 space-y-10">
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $brandIcon }}" alt="Icon" class="h-6 w-auto">
                                <h3 class="text-2xl font-bold text-gray-900">Dénomination sociale</h3>
                            </div>
                            <p class="text-gray-700 font-medium leading-relaxed">
                                {!! nl2br(e($contact->denomination ?? '')) !!}
                            </p>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $brandIcon }}" alt="Icon" class="h-6 w-auto">
                                <h3 class="text-2xl font-bold text-gray-900">Adresse :</h3>
                            </div>
                            <p class="text-gray-700 font-medium leading-relaxed">
                                {!! nl2br(e($contact->adresse ?? '')) !!}
                                @if($contact->bp ?? null)
                                <br><span class="font-bold">{{ $contact->bp }}</span>
                                @endif
                            </p>
                        </div>

                        <div class="space-y-6">
                            <div class="flex items-center gap-3">
                                <img src="{{ $brandIcon }}" alt="Icon" class="h-6 w-auto">
                                <h3 class="text-2xl font-bold text-gray-900">Contact :</h3>
                            </div>
                            <div class="space-y-4">
                                <p class="text-gray-700 font-medium">Email: <a href="mailto:{{ $contact->email }}" class="hover:text-bracongo transition-colors">{{ $contact->email }}</a></p>
                                
                                @if($contact->tel_consommateurs ?? null)
                                <div class="space-y-2">
                                    <h4 class="text-xl font-bold text-gray-900">Réponse aux consommateurs :</h4>
                                    <p class="text-lg font-bold text-gray-900">{{ $contact->tel_consommateurs }}</p>
                                </div>
                                @endif

                                <div class="space-y-1">
                                    @if($contact->tel_fetes ?? null)<p class="text-gray-900 font-bold text-lg">Service fêtes : <span class="font-bold">{{ $contact->tel_fetes }}</span></p>@endif
                                    @if($contact->tel_fournisseurs ?? null)<p class="text-gray-900 font-bold text-lg">Fournisseurs : <span class="font-bold">{{ $contact->tel_fournisseurs }}</span></p>@endif
                                    @if($contact->tel_cle_chateaux ?? null)<p class="text-gray-900 font-bold text-lg">Clé des Châteaux : <span class="font-bold">{{ $contact->tel_cle_chateaux }}</span></p>@endif
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 space-y-4">
                            <div class="flex items-center gap-6">
                                <h3 class="text-3xl font-bold text-gray-900">Suivez-nous</h3>
                                <div class="flex items-center gap-4">
                                    <a href="#" class="text-bracongo hover:opacity-80 transition-opacity">
                                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </a>
                                    <a href="#" class="text-bracongo hover:opacity-80 transition-opacity">
                                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                    </a>
                                    <a href="#" class="text-bracongo hover:opacity-80 transition-opacity">
                                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ $contact->devenir_client_lien ?? '#' }}" class="flex items-center justify-between w-full px-8 py-4 bg-bracongo text-white rounded-full font-bold hover:opacity-90 transition-opacity shadow-lg group">
                        <span>Devenir client Bracongo</span>
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="space-y-12">
                    <div class="flex items-center gap-3">
                        <img src="{{ $brandIcon }}" alt="Icon" class="h-8 w-auto">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $contact->form_titre ?? 'Nous contacter' }}</h2>
                    </div>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-4">
                            <input type="text" id="contact-name" name="name" placeholder="Nom et prénoms" required value="{{ old('name') }}" class="w-full px-8 py-4 rounded-full border border-gray-200 focus:outline-none focus:border-bracongo text-gray-700 bg-white shadow-sm transition-colors @error('name') border-red-400 @enderror">
                            <input type="email" id="contact-email" name="email" placeholder="Email" required value="{{ old('email') }}" class="w-full px-8 py-4 rounded-full border border-gray-200 focus:outline-none focus:border-bracongo text-gray-700 bg-white shadow-sm transition-colors @error('email') border-red-400 @enderror">
                            <input type="tel" id="contact-phone" name="phone" placeholder="Téléphone" value="{{ old('phone') }}" class="w-full px-8 py-4 rounded-full border border-gray-200 focus:outline-none focus:border-bracongo text-gray-700 bg-white shadow-sm transition-colors">
                            <input type="text" id="contact-subject" name="subject" placeholder="Objet de la demande" value="{{ old('subject') }}" class="w-full px-8 py-4 rounded-full border border-gray-200 focus:outline-none focus:border-bracongo text-gray-700 bg-white shadow-sm transition-colors">
                            <div class="relative">
                                <textarea id="contact-message" name="message" placeholder="Message" rows="8" required class="w-full px-8 py-6 rounded-[2rem] border border-gray-200 focus:outline-none focus:border-bracongo text-gray-700 bg-white shadow-sm transition-colors resize-none @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
                            </div>
                        </div>

                        @php
                            $whatsAppUrl = filled($contact->whatsapp_url ?? null) && ($contact->whatsapp_url ?? '#') !== '#'
                                ? $contact->whatsapp_url
                                : 'https://wa.me/243841622222?text=Bonjour%20BRACONGO';
                            $whatsAppLabel = filled($contact->whatsapp_label ?? null)
                                ? $contact->whatsapp_label
                                : 'Discutons sur WhatsApp';
                        @endphp
                        <div class="pt-4 flex flex-wrap items-center gap-4">
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 px-10 py-4 min-w-[180px]
                                       border border-bracongo text-bracongo rounded-full font-bold
                                       hover:bg-bracongo hover:text-white
                                       transition-all duration-300 group">
                                <span>{{ $contact->submit_label ?? 'Envoyer' }}</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>

                            <a href="{{ $whatsAppUrl }}"
                               id="contact-whatsapp-link"
                               data-whatsapp-url="{{ $whatsAppUrl }}"
                               target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center justify-center gap-3 px-10 py-4 min-w-[220px]
                                      rounded-full font-bold text-white
                                      shadow-lg hover:scale-[1.03]
                                      transition-all duration-300 group"
                               style="background: linear-gradient(90deg, #25D366 0%, #1ebe5d 100%); box-shadow: 0 12px 24px rgba(37, 211, 102, 0.35);">
                                @if(file_exists(public_path('img/whatsapp-svgrepo-com.svg')))
                                    <img src="{{ asset('img/whatsapp-svgrepo-com.svg') }}" alt="" class="w-5 h-5 shrink-0" width="20" height="20" loading="lazy">
                                @else
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M12.03 2C6.49 2 2 6.4 2 11.83c0 1.89.56 3.73 1.62 5.31L2 22l5.03-1.56a10.14 10.14 0 0 0 5 1.31h.01c5.54 0 10.03-4.4 10.03-9.83S17.58 2 12.03 2zm0 17.96h-.01a8.4 8.4 0 0 1-4.29-1.17l-.31-.18-2.98.93.97-2.89-.2-.3a8.15 8.15 0 0 1-1.3-4.42c0-4.5 3.7-8.16 8.23-8.16a8.2 8.2 0 0 1 8.23 8.16 8.2 8.2 0 0 1-8.24 8.03z"/>
                                    </svg>
                                @endif
                                <span>{{ $whatsAppLabel }}</span>
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const waLink = document.getElementById('contact-whatsapp-link');
    if (!waLink) return;

    waLink.addEventListener('click', function () {
        const name = (document.getElementById('contact-name')?.value || '').trim();
        const email = (document.getElementById('contact-email')?.value || '').trim();
        const phone = (document.getElementById('contact-phone')?.value || '').trim();
        const subject = (document.getElementById('contact-subject')?.value || '').trim();
        const message = (document.getElementById('contact-message')?.value || '').trim();

        const lines = [
            'Bonjour 👋',
            '',
            'Je vous écris depuis le site BRACONGO.',
            'Je m\'appelle ' + (name || '[Nom non renseigné]') + ', mon e-mail est ' + (email || '[Email non renseigné]') + ' 📧 et mon numéro est ' + (phone || '[Téléphone non renseigné]') + ' 📱.',
            'L\'objet de ma demande est : ' + (subject || '[Objet non renseigné]') + ' 📝',
            '',
            'Le message que j’aimerais vous transmettre est le suivant 💬 :',
            message || '[Message non renseigné]',
            '',
            'Merci beaucoup pour votre aide 🙏',
            'Excellente journée à vous ✨',
        ].filter(Boolean);

        const sourceUrl = waLink.dataset.whatsappUrl || waLink.href;
        const parsedUrl = new URL(sourceUrl, window.location.origin);
        parsedUrl.searchParams.set('text', lines.join('\n'));
        waLink.href = parsedUrl.toString();
    });
});
</script>
@endpush
