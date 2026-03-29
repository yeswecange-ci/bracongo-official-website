@extends('layout.app')

@section('title', 'Carrière')

@section('content')
    <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
        <img src="{{ asset($carriere->hero_image ?? 'img/rejoins.png') }}" alt="Rejoignez-nous" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-center uppercase tracking-[0.2em]">
                {{ $carriere->hero_titre ?? 'Rejoignez-nous' }}
            </h1>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <p class="text-gray-800 text-sm md:text-base leading-relaxed font-medium">
                {{ $carriere->texte_intro ?? '' }}
            </p>
        </div>
    </section>

    <section class="pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-center gap-3 mb-16">
                <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-8 w-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $carriere->offres_titre ?? "Nos offres d'emploi" }}</h2>
            </div>

            @if($offres->isNotEmpty())
            <div id="offers-container">
                @foreach($offres as $index => $offre)
                <div class="job-page space-y-16 {{ $index > 0 ? 'hidden' : '' }}" data-page="{{ $index + 1 }}">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div class="rounded-[2rem] overflow-hidden shadow-xl border border-gray-100 h-[350px] md:h-[450px]">
                            <img src="{{ asset($offre->image ?? 'img/brasserie.jpg') }}" alt="{{ $offre->titre }}" class="w-full h-full object-cover">
                        </div>
                        <div class="space-y-6">
                            <h3 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">{{ $offre->titre }}</h3>
                            <div class="space-y-4 text-gray-700 text-sm md:text-base leading-relaxed">
                                {!! \App\Support\CmsHtmlSanitizer::sanitize($offre->description) !!}
                            </div>
                            <div class="pt-4">
                                <a href="{{ $offre->lien ?? '#' }}" class="inline-flex items-center gap-2 px-8 py-3 border border-bracongo text-bracongo rounded-full font-bold hover:bg-bracongo hover:text-white transition-all duration-300 group">
                                    Plus de détails sur l'offre
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($offres->count() > 1)
            <div class="flex items-center justify-center gap-4 mt-12" id="pagination-nav">
                @foreach($offres as $index => $offre)
                <span class="page-link {{ $index === 0 ? 'text-bracongo' : 'text-gray-400' }} font-bold text-sm cursor-pointer hover:text-bracongo transition-colors" data-target="{{ $index + 1 }}">{{ $index + 1 }}</span>
                @endforeach
                <div class="flex items-center text-bracongo cursor-pointer" id="next-page">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
            @endif

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const pages = document.querySelectorAll('.job-page');
                    const links = document.querySelectorAll('.page-link');
                    const nextBtn = document.getElementById('next-page');
                    let currentPage = 1;

                    function showPage(pageNumber) {
                        pages.forEach(page => {
                            page.classList.toggle('hidden', page.dataset.page != pageNumber);
                        });
                        links.forEach(link => {
                            link.classList.toggle('text-bracongo', link.dataset.target == pageNumber);
                            link.classList.toggle('text-gray-400', link.dataset.target != pageNumber);
                        });
                        currentPage = pageNumber;
                        window.scrollTo({ top: document.getElementById('offers-container').offsetTop - 100, behavior: 'smooth' });
                    }

                    links.forEach(link => {
                        link.addEventListener('click', () => showPage(parseInt(link.dataset.target)));
                    });

                    if (nextBtn) {
                        nextBtn.addEventListener('click', () => {
                            let next = (currentPage % pages.length) + 1;
                            showPage(next);
                        });
                    }
                });
            </script>
            @else
            <p class="text-center text-gray-500 py-8">Aucune offre disponible pour le moment.</p>
            @endif
        </div>
    </section>
@endsection
