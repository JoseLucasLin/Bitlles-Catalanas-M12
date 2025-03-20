<div class="text-center mt-20 mb-20 flex items-center justify-center gap-2">
    <p class="text-4xl main-text font-bold">{{__('main.active_tournament')}}</p>
    
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 main-text">
        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
      </svg>            
</div>

<div class="m-2 flex flex-col items-center active-tournament-border rounded-xl p-2 w-fit mx-auto">
    <img src="{{ asset('main-img/ejemplo-torneo.jpg') }}" alt="imagen torneo" class="rounded-xl active-tournament-img">
    <p class="mt-5 mb-5 text-center text-2xl main-text transition-all duration-300"><a href="" class="main-link font-bold transition-all duration-300">{{__('main.view_table')}}</a> {{__('main.of_tournament')}}</p>
</div>

<div class="mt-24 border-b-4 main-border"></div>



