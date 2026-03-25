@extends('layout.app')

@section('title', 'Notre Histoire')

@section('content')
    <section class="w-full">
        <div class="w-full h-[500px] md:h-[600px] overflow-hidden">
            <img src="{{ asset($histoire->hero_image ?? 'img/bracongo.jpg') }}" alt="Usine Bracongo" class="w-full h-full object-cover">
        </div>

        <div class="container mx-auto px-4 py-16 max-w-5xl">
            <div class="flex items-center justify-center gap-3 mb-12">
                <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="Icon" class="h-8 w-auto">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $histoire->titre ?? 'Notre histoire' }}</h1>
            </div>

            <div class="space-y-8 text-center text-gray-700 leading-relaxed max-w-6xl mx-auto font-medium">
                @if($histoire->paragraphe_1 ?? null)
                <p>{{ $histoire->paragraphe_1 }}</p>
                @endif
                @if($histoire->paragraphe_2 ?? null)
                <p>{{ $histoire->paragraphe_2 }}</p>
                @endif
                @if($histoire->paragraphe_3 ?? null)
                <p>{{ $histoire->paragraphe_3 }}</p>
                @endif
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 py-16 max-w-6xl">
        <div class="grid grid-cols-1 gap-6 mb-20">
            <div class="rounded-[2rem] overflow-hidden h-[300px] md:h-[400px]">
                <img src="{{ asset($histoire->image_brasserie ?? 'img/Frame-115.png') }}" alt="Brasserie" class="w-full h-full object-cover">
            </div>
        </div>

        <div id="valeurs" class="text-center mb-24">
            <div class="flex items-center justify-center gap-3 mb-12">
                <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-8 w-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $histoire->valeurs_titre ?? 'Nos valeurs' }}</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 max-w-5xl mx-auto">
                @foreach($valeurs as $valeur)
                <div class="bg-bracongo text-white p-8 rounded-2xl flex flex-col items-center justify-center min-h-[220px] transition-transform hover:scale-105">
                    <span class="text-5xl font-bold mb-4">{{ $valeur->lettre }}</span>
                    <p class="text-lg font-medium leading-tight px-2">{{ $valeur->description }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <div id="rse" class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center py-12">
            <div class="space-y-8">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-8 w-auto">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $histoire->rse_titre ?? 'Nos engagements RSE' }}</h2>
                </div>

                <div class="lg:hidden">
                    <div class="rounded-[2rem] overflow-hidden shadow-xl h-[350px]">
                        <img src="{{ asset($histoire->rse_image ?? 'img/Frame 33.png') }}" alt="Engagements RSE" class="w-full h-full object-cover">
                    </div>
                </div>

                <p class="text-gray-700 leading-relaxed font-medium">
                    {{ $histoire->rse_texte ?? '' }}
                </p>
                <div class="pt-4">
                    <a href="{{ $histoire->rse_cta_lien ?? '#' }}" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-bracongo text-bracongo rounded-full font-bold hover:bg-bracongo hover:text-white transition-all duration-300">
                        <span>{{ $histoire->rse_cta_texte ?? 'En savoir plus sur nos engagements RSE' }}</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="hidden lg:block">
                <div class="rounded-[2rem] overflow-hidden shadow-xl h-[450px]">
                    <img src="{{ asset($histoire->rse_image ?? 'img/Frame 33.png') }}" alt="Engagements RSE" class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <div id="presence" class="py-24">
            <div class="flex items-center justify-center gap-3 mb-12 text-center">
                <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-8 w-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 uppercase tracking-widest">{{ $histoire->presence_titre ?? 'Notre présence nationale' }}</h2>
            </div>

            <div class="relative bg-white rounded-xl overflow-hidden shadow-2xl border border-gray-200">
                <div class="bg-[#455A64] text-white px-4 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <h3 class="font-medium text-lg">{{ $histoire->carte_panel_titre ?? 'Centres de distribution Bracongo' }}</h3>
                    </div>
                </div>

                <div class="w-full h-[500px] bg-[#E5E3DF] relative">
                    <iframe
                        src="{{ $histoire->maps_embed_url ?? '' }}"
                        class="w-full h-full border-0 grayscale-[0.2]"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="mt-8 text-center text-gray-600 text-sm font-medium italic">
                {{ $histoire->presence_note ?? '' }}
            </div>
        </div>
    </section>
@endsection
