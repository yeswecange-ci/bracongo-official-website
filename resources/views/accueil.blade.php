@extends('layout.app')

@section('title', 'Accueil')

@section('content')
    <section class="relative w-full overflow-hidden group">
        <div id="hero-carousel" class="relative w-full h-[500px] md:h-[900px]">
            <div class="carousel-item absolute inset-0 transition-opacity duration-1000 opacity-100">
                <img src="{{ asset('img/coverhome.jpg') }}" alt="Beaufort Hero" class="w-full h-full object-cover">
            </div>
            <div class="carousel-item absolute inset-0 transition-opacity duration-1000 opacity-0">
                <img src="{{ asset('img/banniere.jpg') }}" alt="Tembo Hero" class="w-full h-full object-cover">
            </div>
        </div>

        <div class="py-4 flex justify-center items-center gap-4">
            <button id="prev-hero" class="w-6 h-6 rounded-full border border-bracongo flex items-center justify-center text-bracongo hover:bg-bracongo hover:text-white transition-all cursor-pointer">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <div class="flex items-center gap-2" id="carousel-indicators">
                <span class="indicator w-6 h-1 bg-bracongo rounded-full cursor-pointer transition-all"></span>
                <span class="indicator w-6 h-1 bg-gray-300 rounded-full cursor-pointer transition-all"></span>
            </div>

            <button id="next-hero" class="w-6 h-6 rounded-full border border-bracongo flex items-center justify-center text-bracongo hover:bg-bracongo hover:text-white transition-all cursor-pointer">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const items = document.querySelectorAll('.carousel-item');
                const indicators = document.querySelectorAll('.indicator');
                const prevBtn = document.getElementById('prev-hero');
                const nextBtn = document.getElementById('next-hero');
                let currentIndex = 0;
                let interval;

                function showSlide(index) {
                    items.forEach((item, i) => {
                        item.classList.remove('opacity-100');
                        item.classList.add('opacity-0');
                        indicators[i].classList.remove('bg-bracongo');
                        indicators[i].classList.add('bg-gray-300');
                    });

                    items[index].classList.remove('opacity-0');
                    items[index].classList.add('opacity-100');
                    indicators[index].classList.remove('bg-gray-300');
                    indicators[index].classList.add('bg-bracongo');
                    currentIndex = index;
                }

                function nextSlide() {
                    let next = (currentIndex + 1) % items.length;
                    showSlide(next);
                }

                function prevSlide() {
                    let prev = (currentIndex - 1 + items.length) % items.length;
                    showSlide(prev);
                }

                function startAutoPlay() {
                    interval = setInterval(nextSlide, 5000);
                }

                function stopAutoPlay() {
                    clearInterval(interval);
                }

                nextBtn.addEventListener('click', () => {
                    nextSlide();
                    stopAutoPlay();
                    startAutoPlay();
                });

                prevBtn.addEventListener('click', () => {
                    prevSlide();
                    stopAutoPlay();
                    startAutoPlay();
                });

                indicators.forEach((indicator, i) => {
                    indicator.addEventListener('click', () => {
                        showSlide(i);
                        stopAutoPlay();
                        startAutoPlay();
                    });
                });

                startAutoPlay();
            });
        </script>
    </section>

    <div class="container mx-auto px-4 py-16">
        <div class="flex items-center justify-center gap-4 mb-12">
            <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-10 w-auto">
            <h1 class="text-3xl font-bold text-gray-900 uppercase tracking-widest">Dernière actualités</h1>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-[#F8F8F8] rounded-[2rem] overflow-hidden flex flex-col h-full shadow-sm">
                <div class="h-64 overflow-hidden">
                    <img src="{{ asset('img/lumumba.png') }}" alt="Rencontre avec Lumumba" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow justify-between">
                    <h3 class="text-gray-900 font-bold text-sm">Rencontre avec Lumumba</h3>
                    <div class="flex justify-end mt-4">
                        <div class="text-bracongo">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>     
            </div>

            <div class="bg-[#F8F8F8] rounded-[2rem] overflow-hidden flex flex-col h-full shadow-sm">
                <div class="h-64 overflow-hidden">
                    <img src="{{ asset('img/influ.png') }}" alt="Rencontre des influenceurs" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow justify-between">
                    <h3 class="text-gray-900 font-bold text-sm">Rencontre des influenceurs</h3>
                    <div class="flex justify-end mt-4">
                        <div class="text-bracongo">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>     
            </div>

            <div class="bg-[#F8F8F8] rounded-[2rem] overflow-hidden flex flex-col h-full shadow-sm">
                <div class="h-64 overflow-hidden">
                    <img src="{{ asset('img/champ.png') }}" alt="Rencontre des influenceurs" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow justify-between">
                    <h3 class="text-gray-900 font-bold text-sm">Rencontre des influenceurs</h3>
                    <div class="flex justify-end mt-4">
                        <div class="text-bracongo">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>     
            </div>

            <div class="bg-[#F8F8F8] rounded-[2rem] overflow-hidden flex flex-col h-full shadow-sm">
                <div class="h-64 overflow-hidden">
                    <img src="{{ asset('img/bièrre.png') }}" alt="Rencontre des influenceurs" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow justify-between">
                    <h3 class="text-gray-900 font-bold text-sm">Rencontre des influenceurs</h3>
                    <div class="flex justify-end mt-4">
                        <div class="text-bracongo">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>     
            </div>
        </div>

        <div class="flex justify-center mt-12">
            <a href="#" class="flex items-center gap-2 px-8 py-2 border border-bracongo rounded-full text-bracongo font-semibold hover:bg-bracongo hover:text-white transition-all duration-300">
                Voir plus
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>

    <section class="relative w-full h-[500px] mt-20 overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('img/brasserie.jpg') }}" alt="Brasserie Bracongo" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-4 max-w-4xl mx-auto">
            <div class="flex items-center gap-3 mb-6">
                <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-8 w-auto">
                <h2 class="text-white text-3xl md:text-5xl font-bold tracking-tight">Qui sommes-nous ?</h2>
            </div>
            
            <p class="text-gray-200 text-sm md:text-base leading-relaxed mb-10 font-medium">
                Lorem ipsum dolor sit amet consectetur. Nec augue tortor cursus vulputate ultricies mattis a. Bibendum gravida morbi urna at id dui vitae. Massa bibendum magna in quis amet neque neque diam eget. Tincidunt scelerisque mattis at habitant malesuada congue. Ut malesuada ac mauris amet non sit lobortis proin.
            </p>

            <a href="#" class="flex items-center gap-2 px-10 py-3 border border-white rounded-full text-white font-bold hover:bg-white hover:text-black transition-all duration-300 group/btn">
                Lire plus
                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </section>
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="Icon" class="h-6 w-auto">
                    <h2 class="text-3xl font-bold text-gray-900">Nos marques</h2>
                </div>
                <p class="text-gray-600 max-w-3xl mx-auto text-sm leading-relaxed">
                    Lorem ipsum dolor sit amet consectetur. Nec augue tortor cursus vulputate ultricies mattis a. Bibendum gravida morbi urna at id dui vitae. Lorem ipsum dolor sit amet consectetur. Nec augue tortor cursus.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-20 pt-16">
                <div class="relative bg-black rounded-[2rem] group h-[400px] flex flex-col items-center justify-end pb-10">
                    <div class="absolute top-10 left-0 right-0 flex justify-center opacity-40 pointer-events-none">
                        <img src="{{ asset('img/Group2.png') }}" alt="Logo Background" class="w-4/5 h-auto object-contain">
                    </div>
                    <div class="absolute -top-16 left-0 right-0 flex justify-center z-10 pointer-events-none">
                        <img src="{{ asset('img/marron.png') }}" alt="Bière" class="h-72 w-auto object-contain transform group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="relative z-20 text-center px-4">
                        <h3 class="text-white text-xl font-bold mb-6">Bières</h3>
                        <a href="#" class="inline-flex items-center gap-2 px-8 py-2 border border-white rounded-full text-white text-xs font-bold hover:bg-white hover:text-black transition-all">
                            Voir plus
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="relative bg-black rounded-[2rem] group h-[400px] flex flex-col items-center justify-end pb-10">
                    <div class="absolute top-10 left-0 right-0 flex justify-center opacity-40 pointer-events-none">
                        <img src="{{ asset('img/Group2.png') }}" alt="Logo Background" class="w-4/5 h-auto object-contain">
                    </div>
                    <div class="absolute -top-16 left-0 right-0 flex justify-center z-10 pointer-events-none">
                        <img src="{{ asset('img/gazeux.png') }}" alt="Boissons gazeuses" class="h-72 w-auto object-contain transform group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="relative z-20 text-center px-4">
                        <h3 class="text-white text-xl font-bold mb-6">Boissons gazeuses</h3>
                        <a href="#" class="inline-flex items-center gap-2 px-8 py-2 border border-white rounded-full text-white text-xs font-bold hover:bg-white hover:text-black transition-all">
                            Voir plus
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="relative bg-black rounded-[2rem] group h-[400px] flex flex-col items-center justify-end pb-10">
                    <div class="absolute top-10 left-0 right-0 flex justify-center opacity-40 pointer-events-none">
                        <img src="{{ asset('img/Group2.png') }}" alt="Logo Background" class="w-4/5 h-auto object-contain">
                    </div>
                    <div class="absolute -top-16 left-0 right-0 flex justify-center z-10 pointer-events-none">
                        <img src="{{ asset('img/eau.png') }}" alt="Eaux" class="h-72 w-auto object-contain transform group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="relative z-20 text-center px-4">
                        <h3 class="text-white text-xl font-bold mb-6">Eaux</h3>
                        <a href="#" class="inline-flex items-center gap-2 px-8 py-2 border border-white rounded-full text-white text-xs font-bold hover:bg-white hover:text-black transition-all">
                            Voir plus
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="relative bg-black rounded-[2rem] group h-[400px] flex flex-col items-center justify-end pb-10">
                    <div class="absolute top-10 left-0 right-0 flex justify-center opacity-40 pointer-events-none">
                        <img src="{{ asset('img/Group2.png') }}" alt="Logo Background" class="w-4/5 h-auto object-contain">
                    </div>
                    <div class="absolute -top-16 left-0 right-0 flex justify-center z-10 pointer-events-none">
                        <img src="{{ asset('img/energie.png') }}" alt="Boisson énergisante" class="h-72 w-auto object-contain transform group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="relative z-20 text-center px-4">
                        <h3 class="text-white text-xl font-bold mb-6">Boisson énergisante</h3>
                        <a href="#" class="inline-flex items-center gap-2 px-8 py-2 border border-white rounded-full text-white text-xs font-bold hover:bg-white hover:text-black transition-all">
                            Voir plus
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-20 bg-[#F9F9F9]">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="w-full lg:w-1/2">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="Icon" class="h-6 w-auto">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Rejoignez nous</h2>
                    </div>
                    
                    <p class="text-gray-700 text-base leading-relaxed mb-10 max-w-xl">
                        Employer et former les bonnes personnes pour le poste est la clé de notre succès. Notre aspiration est d'offrir le meilleur à nos clients et consommateurs et d'offrir des produits de qualité à des prix abordables. Si vous appréciez l'action, la qualité et l'intégrité, notre entreprise est l'endroit idéal pour vous
                    </p>

                    <a href="#" class="inline-flex items-center gap-2 px-8 py-3 border border-bracongo rounded-full text-bracongo font-bold hover:bg-bracongo hover:text-white transition-all duration-300 group">
                        Voir nos offres d'emploi
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="w-full lg:w-1/2">
                    <div class="rounded-[2rem] overflow-hidden shadow-2xl">
                        <img src="{{ asset('img/rejoignez.png') }}" alt="Rejoignez Bracongo" class="w-full h-auto object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
