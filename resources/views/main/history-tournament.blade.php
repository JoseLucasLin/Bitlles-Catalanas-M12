<div class="text-center mt-20 mb-20 flex items-center justify-center gap-2">
    <p class="text-4xl main-text font-bold">{{__('main.history')}}</p>
    
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 main-text">
        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
    </svg>            
</div>

<div class="w-full relative">
    <div class="swiper multiple-slide-carousel swiper-container relative">
        <div class="swiper-wrapper mb-16">
            
            <div class="swiper-slide">
                <div class="h-96 flex flex-col justify-start items-center p-4">
                    <div class="w-full h-64 overflow-hidden rounded-xl flex justify-center items-center">
                        <img src="{{ asset('main-img/ejemplo-torneo2.jpg') }}" alt="imagen torneo" class="w-full h-full object-contain">
                    </div>
                    <p class="text-lg font-bold mt-4 text-[var(--azul)]">Torneo de Pepe 1</p>
                    <p class="text-sm text-[var(--azul)]">15 de Marzo, 2025</p>
                    <a href="#" class="main-link font-bold transition-all duration-300">{{__('main.view_result')}}</a>
                </div>
            </div>
            
            <div class="swiper-slide">
                <div class="h-96 flex flex-col justify-start items-center p-4">
                    <div class="w-full h-64 overflow-hidden rounded-xl flex justify-center items-center">
                        <img src="{{ asset('main-img/ejemplo-torneo.jpg') }}" alt="imagen torneo" class="w-full h-full object-contain">
                    </div>
                    <p class="text-lg font-bold mt-4 text-[var(--azul)]">Torneo Ultro Pro</p>
                    <p class="text-sm text-[var(--azul)]">20 de Junio, 2025</p>
                    <a href="#" class="main-link font-bold transition-all duration-300">{{__('main.view_result')}}</a>
                </div>
            </div>
            
            <div class="swiper-slide">
                <div class="h-96 flex flex-col justify-start items-center p-4">
                    <div class="w-full h-64 overflow-hidden rounded-xl flex justify-center items-center">
                        <img src="{{ asset('main-img/ejemplo-torneo2.jpg') }}" alt="imagen torneo" class="w-full h-full object-contain">
                    </div>
                    <p class="text-lg font-bold mt-4 text-[var(--azul)]">Torneo "Las finales"</p>
                    <p class="text-sm text-[var(--azul)]">10 de Septiembre, 2025</p>
                    <a href="#" class="main-link font-bold transition-all duration-300">{{__('main.view_result')}}</a>
                </div>
            </div>
            
            <div class="swiper-slide">
                <div class="h-96 flex flex-col justify-start items-center p-4">
                    <div class="w-full h-64 overflow-hidden rounded-xl flex justify-center items-center">
                        <img src="{{ asset('main-img/ejemplo-torneo.jpg') }}" alt="imagen torneo" class="w-full h-full object-contain">
                    </div>
                    <p class="text-lg font-bold mt-4 text-[var(--azul)]">Torneo Pablo</p>
                    <p class="text-sm text-[var(--azul)]">5 de Diciembre, 2025</p>
                    <a href="#" class="main-link font-bold transition-all duration-300">{{__('main.view_result')}}</a>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="h-96 flex flex-col justify-start items-center p-4">
                    <div class="w-full h-64 overflow-hidden rounded-xl flex justify-center items-center">
                        <img src="{{ asset('main-img/ejemplo-torneo2.jpg') }}" alt="imagen torneo" class="w-full h-full object-contain">
                    </div>
                    <p class="text-lg font-bold mt-4 text-[var(--azul)]">Torneo "Las finales"</p>
                    <p class="text-sm text-[var(--azul)]">10 de Septiembre, 2025</p>
                    <a href="#" class="main-link font-bold transition-all duration-300">{{__('main.view_result')}}</a>
                </div>
            </div>
            
            <div class="swiper-slide">
                <div class="h-96 flex flex-col justify-start items-center p-4">
                    <div class="w-full h-64 overflow-hidden rounded-xl flex justify-center items-center">
                        <img src="{{ asset('main-img/ejemplo-torneo.jpg') }}" alt="imagen torneo" class="w-full h-full object-contain">
                    </div>
                    <p class="text-lg font-bold mt-4 text-[var(--azul)]">Torneo Pablo</p>
                    <p class="text-sm text-[var(--azul)]">5 de Diciembre, 2025</p>
                    <a href="#" class="main-link font-bold transition-all duration-300">{{__('main.view_result')}}</a>
                </div>
            </div>

        </div>
        <div class="absolute flex justify-center items-center m-auto left-0 right-0 w-fit bottom-12 z-10">
            <button id="slider-button-left" class="group flex justify-center items-center border border-solid border-[var(--azul)] w-12 h-12 transition-all duration-500 rounded-full hover:bg-[var(--rojo)] -translate-x-16 z-20" data-carousel-prev>
                <svg class="h-5 w-5 text-[var(--azul)] group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        
            <button id="slider-button-right" class="group flex justify-center items-center border border-solid border-[var(--azul)] w-12 h-12 transition-all duration-500 rounded-full hover:bg-[var(--rojo)] translate-x-16 z-20" data-carousel-next>
                <svg class="h-5 w-5 text-[var(--azul)] group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</div>