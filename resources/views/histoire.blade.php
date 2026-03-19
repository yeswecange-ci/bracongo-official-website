@extends('layout.app')

@section('title', 'Notre Histoire')

@section('content')
    <section class="w-full">
        <div class="w-full h-[500px] md:h-[600px] overflow-hidden">
            <img src="{{ asset('img/bracongo.jpg') }}" alt="Usine Bracongo" class="w-full h-full object-cover">
        </div>

        <div class="container mx-auto px-4 py-16 max-w-5xl">
            <div class="flex items-center justify-center gap-3 mb-12">
                <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="Icon" class="h-8 w-auto">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Notre histoire</h1>
            </div>

            <div class="space-y-8 text-center text-gray-700 leading-relaxed max-w-6xl mx-auto font-medium">
                <p>
                    Lorem ipsum dolor sit amet consectetur. Sapien fusce scelerisque condimentum iaculis viverra aliquam varius. Senectus tristique dapibus aliquet faucibus semper euismod nibh mauris leo. Sed adipiscing faucibus cursus scelerisque non turpis pellentesque. Turpis enim in in lorem ac curabitur. Quam magna risus augue malesuada consequat orci amet mi. Arcu vitae scelerisque molestie risus elementum ridiculus vitae in. Viverra amet pulvinar tincidunt magna. Arcu sit a lobortis id cras in euismod. Amet amet nec scelerisque adipiscing at nibh et turpis. Purus auctor et est malesuada quam. Lorem et id eget enim donec nibh sed urna in.
                </p>

                <p>
                    Lorem ipsum dolor sit amet consectetur. Sapien fusce scelerisque condimentum iaculis viverra aliquam varius. Senectus tristique dapibus aliquet faucibus semper euismod nibh mauris leo. Sed adipiscing faucibus cursus scelerisque non turpis pellentesque. Turpis enim in in lorem ac curabitur. Quam magna risus augue malesuada consequat orci amet mi. Arcu vitae scelerisque molestie risus elementum ridiculus vitae in. Viverra amet pulvinar tincidunt magna. Arcu sit a lobortis id cras in euismod. Amet amet nec scelerisque adipiscing at nibh et turpis. Purus auctor et est malesuada quam. Lorem et id eget enim donec nibh sed urna in.
                </p>

                <p>
                    Lorem ipsum dolor sit amet consectetur. Sapien fusce scelerisque condimentum iaculis viverra aliquam varius. Senectus tristique dapibus aliquet faucibus semper euismod nibh mauris leo. Sed adipiscing faucibus cursus scelerisque non turpis pellentesque. Turpis enim in in lorem ac curabitur. Quam magna risus augue malesuada consequat orci amet mi. Arcu vitae scelerisque molestie risus elementum ridiculus vitae in. Viverra amet pulvinar tincidunt magna. Arcu sit a lobortis id cras in euismod. Amet amet nec scelerisque adipiscing at nibh et turpis. Purus auctor et est malesuada quam. Lorem et id eget enim donec nibh sed urna in.
                </p>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 py-16 max-w-6xl">
        <div class="grid grid-cols-1 gap-6 mb-20">
            <div class="rounded-[2rem] overflow-hidden h-[300px] md:h-[400px]">
                <img src="{{ asset('img/Frame-115.png') }}" alt="Brasserie" class="w-full h-full object-cover">
            </div>
        </div>

        <div id="valeurs" class="text-center mb-24">
            <div class="flex items-center justify-center gap-3 mb-12">
                <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-8 w-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Nos valeurs</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 max-w-5xl mx-auto">
                <div class="bg-bracongo text-white p-8 rounded-2xl flex flex-col items-center justify-center min-h-[220px] transition-transform hover:scale-105">
                    <span class="text-5xl font-bold mb-4">P</span>
                    <p class="text-lg font-medium leading-tight">Parler vrai</p>
                </div>
                <div class="bg-bracongo text-white p-8 rounded-2xl flex flex-col items-center justify-center min-h-[220px] transition-transform hover:scale-105">
                    <span class="text-5xl font-bold mb-4">R</span>
                    <p class="text-lg font-medium leading-tight">Réussir en équipe</p>
                </div>
                <div class="bg-bracongo text-white p-8 rounded-2xl flex flex-col items-center justify-center min-h-[220px] transition-transform hover:scale-105">
                    <span class="text-5xl font-bold mb-4">E</span>
                    <p class="text-lg font-medium leading-tight">Etre optimiste et audacieux</p>
                </div>
                <div class="bg-bracongo text-white p-8 rounded-2xl flex flex-col items-center justify-center min-h-[220px] transition-transform hover:scale-105">
                    <span class="text-5xl font-bold mb-4">M</span>
                    <p class="text-lg font-medium leading-tight">Maitriser le stress</p>
                </div>
                <div class="bg-bracongo text-white p-6 rounded-2xl flex flex-col items-center justify-center min-h-[220px] transition-transform hover:scale-105">
                    <span class="text-5xl font-bold mb-4">I</span>
                    <p class="text-base font-medium leading-tight px-2">Intégrer les enjeux à moyen et long termes</p>
                </div>
                <div class="bg-bracongo text-white p-8 rounded-2xl flex flex-col items-center justify-center min-h-[220px] transition-transform hover:scale-105">
                    <span class="text-5xl font-bold mb-4">E</span>
                    <p class="text-lg font-medium leading-tight">Etre exemplaire</p>
                </div>
                <div class="bg-bracongo text-white p-8 rounded-2xl flex flex-col items-center justify-center min-h-[220px] transition-transform hover:scale-105">
                    <span class="text-5xl font-bold mb-4">R</span>
                    <p class="text-lg font-medium leading-tight">Respecter son environnement</p>
                </div>
                <div class="bg-bracongo text-white p-8 rounded-2xl flex flex-col items-center justify-center min-h-[220px] transition-transform hover:scale-105">
                    <span class="text-5xl font-bold mb-4">S</span>
                    <p class="text-lg font-medium leading-tight">Savoir décider</p>
                </div>
            </div>
        </div>

        <div id="rse" class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center py-12">
            <div class="space-y-8">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-8 w-auto">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Nos engagements RSE</h2>
                </div>

                <div class="lg:hidden">
                    <div class="rounded-[2rem] overflow-hidden shadow-xl h-[350px]">
                        <img src="{{ asset('img/Frame 33.png') }}" alt="Engagements RSE" class="w-full h-full object-cover">
                    </div>
                </div>

                <p class="text-gray-700 leading-relaxed font-medium">
                    Lorem ipsum dolor sit amet consectetur. Ultricies nulla at tincidunt orci et. Adipiscing risus dictum ullamcorper massa sit mattis suspendisse orci netus. Ultricies facilisis in amet nibh nisl. In iaculis pellentesque non egestas volutpat volutpat consectetur. Placerat faucibus ultrices sem cras molestie purus netus.
                </p>
                <div class="pt-4">
                    <a href="#" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-bracongo text-bracongo rounded-full font-bold hover:bg-bracongo hover:text-white transition-all duration-300">
                        <span>En savoir plus sur nos engagements RSE</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="hidden lg:block">
                <div class="rounded-[2rem] overflow-hidden shadow-xl h-[450px]">
                    <img src="{{ asset('img/Frame 33.png') }}" alt="Engagements RSE" class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <div id="presence" class="py-24">
            <div class="flex items-center justify-center gap-3 mb-12 text-center">
                <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-8 w-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 uppercase tracking-widest">Notre présence nationale</h2>
            </div>

            <div class="relative bg-white rounded-xl overflow-hidden shadow-2xl border border-gray-200">
                <div class="bg-[#455A64] text-white px-4 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <h3 class="font-medium text-lg">Centres de distribution Bracongo</h3>
                        <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    </div>
                    <div class="flex items-center gap-4">
                        <svg class="w-5 h-5 cursor-pointer hover:text-gray-300 transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92c0-1.61-1.31-2.92-2.92-2.92z"/></svg>
                        <svg class="w-5 h-5 cursor-pointer hover:text-gray-300 transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"/></svg>
                    </div>
                </div>

                <div class="w-full h-[500px] bg-[#E5E3DF] relative">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3978.508544403328!2d15.352467376045353!3d-4.332304995641773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a6a33f44498394b%3A0xf6396e9803277785!2sBracongo!5e0!3m2!1sfr!2scd!4v1710680000000!5m2!1sfr!2scd" 
                        class="w-full h-full border-0 grayscale-[0.2]" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <div class="absolute bottom-10 left-4 flex flex-col gap-0 shadow-lg border border-gray-300 rounded overflow-hidden">
                        <button class="bg-white p-2 hover:bg-gray-100 text-gray-700 font-bold border-b border-gray-200">+</button>
                        <button class="bg-white p-2 hover:bg-gray-100 text-gray-700 font-bold">-</button>
                    </div>

                    <div class="absolute bottom-4 left-20">
                        <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png" class="h-6 opacity-80" alt="Google">
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center text-gray-600 text-sm font-medium italic">
                * Cliquez sur la carte pour explorer nos différents centres de distribution à travers le pays.
            </div>
        </div>
    </section>
@endsection
