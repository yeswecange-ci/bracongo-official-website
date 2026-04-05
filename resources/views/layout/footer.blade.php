<div class="w-full">
    @if(isset($reseaux) && $reseaux->isNotEmpty())
    <div class="bg-bracongo py-4 px-6 flex items-center justify-center gap-6 text-white">
        <span class="text-xl font-medium">Suivez nous</span>
        <div class="flex items-center gap-4">
            @foreach($reseaux as $rs)
            <a href="{{ $rs->url }}" target="_blank" rel="noopener" class="hover:opacity-80 transition-opacity">
                @if($rs->platform === 'facebook')
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                @elseif($rs->platform === 'instagram')
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                @elseif($rs->platform === 'twitter' || $rs->platform === 'x')
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                @elseif($rs->platform === 'youtube')
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                @elseif($rs->platform === 'linkedin')
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                @else
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.418 0-8-3.582-8-8s3.582-8 8-8 8 3.582 8 8-3.582 8-8 8z"/></svg>
                @endif
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if(isset($footerGallery) && $footerGallery->isNotEmpty())
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 w-full h-64 md:h-80 overflow-hidden">
        @foreach($footerGallery as $img)
        <img src="{{ asset($img->image) }}" alt="{{ $img->alt }}" class="w-full h-full object-cover">
        @endforeach
    </div>
    @endif

    <footer class="bg-white pt-16 pb-8 border-t border-gray-100 font-sans">
        <div class="container mx-auto px-4 lg:px-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16 items-start">
                <div class="space-y-6">
                    <img src="{{ asset($parametres->logo ?? 'img/LOGO BRACONGO copie 1.png') }}" alt="Bracongo Logo" class="h-20 w-auto object-contain">
                    <p class="text-gray-800 text-sm font-bold leading-relaxed max-w-xs">
                        {{ $footerConfig->mission_texte ?? '« Assurer une qualité et une disponibilité constantes de nos produits au meilleur prix »' }}
                    </p>
                </div>

                @if(isset($navItems) && $navItems->isNotEmpty())
                @foreach($navItems->take(2) as $item)
                <div class="space-y-6">
                    <h4 class="text-xl font-bold text-bracongo">{{ $item->label }}</h4>
                    @if($item->enfants->isNotEmpty())
                    <ul class="space-y-3 text-gray-800 text-sm font-medium">
                        @foreach($item->enfants as $enfant)
                        <li><a href="{{ $enfant->url }}" class="hover:text-bracongo transition-colors">{{ $enfant->label }}</a></li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                @endforeach
                @else
                <div class="space-y-6">
                    <h4 class="text-xl font-bold text-bracongo">Bracongo SA</h4>
                    <ul class="space-y-3 text-gray-800 text-sm font-medium">
                        <li><a href="{{ route('histoire') }}" class="hover:text-bracongo transition-colors">Notre historique</a></li>
                        <li><a href="{{ route('histoire') }}#valeurs" class="hover:text-bracongo transition-colors">Nos valeurs</a></li>
                        <li><a href="{{ route('histoire') }}#rse" class="hover:text-bracongo transition-colors">Nos engagements RSE</a></li>
                        <li><a href="{{ route('histoire') }}#presence" class="hover:text-bracongo transition-colors">Présence nationale</a></li>
                    </ul>
                </div>
                <div class="space-y-6">
                    <h4 class="text-xl font-bold text-bracongo">Nos marques</h4>
                    <ul class="space-y-3 text-gray-800 text-sm font-medium">
                        <li><a href="{{ route('bieres') }}" class="hover:text-bracongo transition-colors">Bières</a></li>
                        <li><a href="#" class="hover:text-bracongo transition-colors">Boissons gazeuses</a></li>
                        <li><a href="#" class="hover:text-bracongo transition-colors">Eaux</a></li>
                        <li><a href="#" class="hover:text-bracongo transition-colors">Boissons énergisantes</a></li>
                    </ul>
                </div>
                @endif

                <div class="space-y-8">
                    <div class="space-y-4">
                        <h4 class="text-xl font-bold text-bracongo">Nos contacts</h4>
                        <div class="text-gray-800 text-sm font-medium leading-relaxed">
                            <p>{{ $footerConfig->adresse ?? 'Avenue des Brasseries, N° 7666, Kingabwa, Limete, Kinshasa, RDC' }}</p>
                            <p class="mt-4 font-bold text-lg">{{ $footerConfig->telephone ?? '+243 815 586 874' }}</p>
                            <p class="font-bold">{{ $footerConfig->email ?? 'bracongo.contact@castel-afrique.com' }}</p>
                        </div>
                    </div>
                    @if($footerConfig->certification_image ?? null)
                    <div class="pt-4">
                        <img src="{{ asset($footerConfig->certification_image) }}" alt="Certification" class="h-16 w-auto object-contain">
                    </div>
                    @endif
                </div>
            </div>

            <div class="pt-8 border-t border-gray-200 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4 text-gray-600 text-xs font-medium">
                <p>&copy; Copyright {{ $footerConfig->copyright_debut_annee ?? 1996 }} - {{ date('Y') }} | BRACONGO S.A. | All Rights Reserved | Designed by <span class="text-bracongo font-bold">YESWECANGE</span></p>
            </div>
        </div>
    </footer>
</div>
