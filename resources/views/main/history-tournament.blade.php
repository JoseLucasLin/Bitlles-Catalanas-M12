<div class="text-center mt-20 mb-20 flex items-center justify-center gap-2">
    <p class="text-4xl main-text font-bold">Historial</p>
    
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 main-text">
        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
    </svg>            
</div>

<!-- Slider de imágenes -->
<div class="slider-container mx-auto w-full max-w-4xl">
    <div class="slider relative overflow-hidden">
        <div class="slider-images flex transition-transform duration-500">
            <img src="{{ asset('main-img/ejemplo-torneo.jpg') }}" alt="Torneo 1" class="slider-image">
            <img src="{{ asset('main-img/ejemplo-torneo.jpg') }}" alt="Torneo 2" class="slider-image">
            <img src="{{ asset('main-img/ejemplo-torneo.jpg') }}" alt="Torneo 3" class="slider-image">
            <img src="{{ asset('main-img/ejemplo-torneo.jpg') }}" alt="Torneo 4" class="slider-image">
        </div>

        <!-- Botones de navegación -->
        <button class="prev absolute top-1/2 left-4 transform -translate-y-1/2 bg-gray-500 text-white px-4 py-2 rounded-full">Prev</button>
        <button class="next absolute top-1/2 right-4 transform -translate-y-1/2 bg-gray-500 text-white px-4 py-2 rounded-full">Next</button>
    </div>
</div>

<script>
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    const sliderImages = document.querySelector('.slider-images');
    let currentIndex = 0;
    
    const totalImages = sliderImages.children.length;

    function updateSliderPosition() {
        const offset = -currentIndex * 100;
        sliderImages.style.transform = `translateX(${offset}%)`;
    }

    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex === 0) ? totalImages - 1 : currentIndex - 1;
        updateSliderPosition();
    });

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex === totalImages - 1) ? 0 : currentIndex + 1;
        updateSliderPosition();
    });
</script>
