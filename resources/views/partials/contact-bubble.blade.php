@php
    $bubble = get_field('bubble', 'option');
    $position = get_field('position', 'option') ?: 'bottom-right';
@endphp

<section data-gsap-anim="section">
    <div data-gsap-element="bubble" 
        x-data="{ isMinimized: false }"
        x-transition
        :class="{ '!-right-[244px]': isMinimized }"
        class="fixed bottom-12 right-6 md:right-12 z-50 w-[320px] transition-all duration-500 ease-in-out">
        <div class="__sidebar relative bg-white dashed-p-3 radius h-max p-8 shadow-xl">

            <!-- Przycisk zamknij (X) - teraz minimalizuje -->
            <button 
                x-show="!isMinimized"
                @click="isMinimized = true" 
                class="absolute -top-4 right-4 bg-primary hover:bg-primary-400 hover:cursor-pointer transition-all duration-500 rounded-full text-white" 
                aria-label="Minimalizuj">
                <svg xmlns="http://www.w3.org/2000/svg" class="p-[4px] h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Przycisk rozwiń (strzałka w lewo) - pokazuje się gdy zminimalizowane -->
            <button 
                x-show="isMinimized"
                @click="isMinimized = false"
                class="absolute top-1/2 -translate-y-1/2 left-4 bg-primary hover:bg-primary-400 hover:cursor-pointer transition-all duration-500 rounded-full text-white p-2 shadow-lg animate-pulse"
                aria-label="Rozwiń">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div x-show="!isMinimized" x-transition>
                <h6 class="">
                    {!! $bubble['header'] ?? 'Potrzebujesz pomocy?' !!}
                </h6>
                
                @if(!empty($bubble['image']))
                    <img class="my-8" src="{{ $bubble['image']['url'] }}" alt="{{ $bubble['image']['alt'] ?? '' }}" />
                @else
                    <img class="my-8" src="/wp-content/uploads/2025/11/photos.png" alt="" />
                @endif
                
                <p class="">
                    {!! $bubble['txt'] ?? 'Nasi doradcy pomogą Ci znaleźć odpowiedni produkt' !!}
                </p>

                @if(!empty($bubble['button']))
                    <a class="main-btn m-btn mt-6 block" 
                       href="{{ $bubble['button']['url'] ?? '/kontakt' }}" 
                       @click="isMinimized = true"
                       @if(!empty($bubble['button']['target'])) target="{{ $bubble['button']['target'] }}" @endif>
                        {!! $bubble['button']['title'] ?? 'Zapytaj eksperta' !!}
                    </a>
                @else
                    <a class="main-btn m-btn mt-6 block" 
                       href="/kontakt"
                       @click="isMinimized = true">
                        Zapytaj eksperta
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>