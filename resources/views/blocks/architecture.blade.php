@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $nolist ? ' no-list' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';

if (!empty($background) && $background !== 'none') {
$sectionClass .= ' ' . $background;
}
@endphp

<!--- architecture -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-architecture relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative z-10">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-20">
			@if (!empty($g_architecture['gallery']))
			<div class="__img h-full order1">
				<div class="swiper architecture-slider">
					<div class="swiper-wrapper">
						@foreach ($g_architecture['gallery'] as $image)
						<div class="swiper-slide">
							<img class="object-cover w-full h-full aspect-auto lg:aspect-square radius-img" src="{{ $image['url'] }}" alt="{{ $image['alt'] ?? '' }}">
						</div>
						@endforeach
					</div>
					<div class="swiper-button-prev cursor-pointer !w-20 !h-20 bg-white rounded-full flex items-center justify-center overflow-hidden p-[28px]">
						<svg xmlns="http://www.w3.org/2000/svg" width="23" height="11" viewBox="0 0 23 11" fill="none">
							<path d="M0.263523 4.87207C0.263792 4.8718 0.264017 4.87149 0.264332 4.87123L4.95885 0.25832C5.31054 -0.0872489 5.87938 -0.0859629 6.22946 0.261336C6.57949 0.60859 6.57814 1.17026 6.22645 1.51587L3.07455 4.6129H22.1016C22.5978 4.6129 23 5.01006 23 5.5C23 5.98994 22.5978 6.3871 22.1016 6.3871H3.0746L6.22641 9.48413C6.5781 9.82975 6.57944 10.3914 6.22941 10.7387C5.87934 11.086 5.31045 11.0872 4.9588 10.7417L0.264286 6.12877C0.264017 6.12851 0.263792 6.1282 0.263477 6.12793C-0.0883961 5.78117 -0.0872726 5.21768 0.263523 4.87207Z" fill="#554838" />
						</svg>
					</div>
					<div class="swiper-button-next cursor-pointer !w-20 !h-20 bg-white rounded-full flex items-center justify-center overflow-hidden p-[28px]">
						<svg xmlns="http://www.w3.org/2000/svg" width="23" height="11" viewBox="0 0 23 11" fill="none">
							<path d="M22.7365 4.87207C22.7362 4.8718 22.736 4.87149 22.7357 4.87123L18.0412 0.25832C17.6895 -0.0872489 17.1206 -0.0859629 16.7705 0.261336C16.4205 0.60859 16.4219 1.17026 16.7736 1.51587L19.9254 4.6129H0.898437C0.40223 4.6129 0 5.01006 0 5.5C0 5.98994 0.40223 6.3871 0.898437 6.3871H19.9254L16.7736 9.48413C16.4219 9.82975 16.4206 10.3914 16.7706 10.7387C17.1207 11.086 17.6896 11.0872 18.0412 10.7417L22.7357 6.12877C22.736 6.12851 22.7362 6.1282 22.7365 6.12793C23.0884 5.78117 23.0873 5.21768 22.7365 4.87207Z" fill="#554838" />
						</svg>
					</div>
				</div>
			</div>
			@endif

			<div class="__architecture order2 lg:py-10">
				@if (!empty($g_architecture['logo']))
				<img data-gsap-element="logo" class="max-h-26" src="{{ $g_architecture['logo']['url'] }}" alt="{{ $g_architecture['logo']['alt'] ?? '' }}">
				@endif
				<h2 data-gsap-element="header" class="m-header">{{ $g_architecture['header'] }}</h2>

				<div data-gsap-element="txt" class="__txt mt-2">
					{!! $g_architecture['txt'] !!}
				</div>

				@if (!empty($g_architecture['button']))
				<a data-gsap-element="btn" class="second-btn m-btn align-self-bottom" href="{{ $g_architecture['button']['url'] }}">{{ $g_architecture['button']['title'] }}</a>
				@endif

			</div>

		</div>
	</div>

	<img data-gsap-element="bg" class="__bg absolute top-1/2 -translate-y-1/2 -right-1/6 opacity-30 pointer-events-none" src="{{ $g_architecture['bg']['url'] ?? '' }}" />
</section>