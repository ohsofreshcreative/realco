@php
$sectionClass = '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<!-- hero --->
@if (!empty($r_hero))
<section
    data-gsap-anim="section"
    @if(!empty($section_id)) id="{{ $section_id }}" @endif
    class="b-hero relative overflow-hidden h-[calc(100vh-104px)] md:h-full {{ $sectionClass }} {{ $section_class }}">

    <!-- Swiper -->
    <div class="swiper hero-slider h-full">
        <div class="swiper-wrapper">
            @foreach ($r_hero as $slide)
            <div class="swiper-slide">
                <div class="__wrapper grid items-center relative z-20 py-10 h-full">
                    <div class="__content c-main mx-auto relative z-20 py-0 md:py-30 order-2 lg:order-1">
                        <div class="w-full md:w-1/2 lg:w-2/3">
                            <img data-gsap-element="img" src="/wp-content/uploads/2026/03/logo-white.svg" />
                            <h1 data-gsap-element="header" class="m-header text-h2 text-white mt-2">
                                {{ $slide['title'] }}
                            </h1>
                            <div data-gsap-element="txt" class="text-white text-[32px]">
                                {!! $slide['txt'] !!}
                            </div>
                            @if (!empty($slide['button1']))
                            <div class="inline-buttons m-btn">
                                <a data-gsap-element="button" class="main-btn left-btn"
                                    href="{{ $slide['button1']['url'] }}"
                                    target="{{ $slide['button1']['target'] }}">
                                    {{ $slide['button1']['title'] }}
                                </a>
                                @if (!empty($slide['button2']))
                                <a data-gsap-element="button" class="second-btn"
                                    href="{{ $slide['button2']['url'] }}"
                                    target="{{ $slide['button2']['target'] }}">
                                    {{ $slide['button2']['title'] }}
                                </a>
                                @endif
                            </div>
                            @endif

                        </div>
                    </div>

                    @if ($slide['image'])
                    <div class="__img __bg absolute inset-0 w-full h-full order-1 lg:order-2">
                        <img class="object-cover w-full h-full" src="{{ $slide['image']['url'] }}" alt="{{ $slide['image']['alt'] ?? '' }}">
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination-wrapper c-main">
            <div class="swiper-pagination !relative !bottom-auto"></div>
        </div>
    </div>
</section>
@endif