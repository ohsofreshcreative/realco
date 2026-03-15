@php
$sectionClass = '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<!-- connect -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-connect relative overflow-hidden section-wrapper radius bg-third py-16 -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="c-main grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-0 items-center relative z-10">

		<div class="__content relative z-10 w-full md:w-3/4 lg:w-2/3 py-0 md:py-20 m-0 md:m-auto">
			<h4 data-gsap-element="header" class="">{{ $bottom['header'] }}</h4>
			<div data-gsap-element="txt" class="mt-2">
				{!! $bottom['address'] !!}
			</div>

			<div data-gsap-element="data" class="__data flex flex-col gap-2 mt-4">
				<a href="tel:{{ preg_replace('/\s+/', '', $bottom['phone']) }}" class="__phone flex items-center w-max">{{ $bottom['phone'] }}</a>
				<a href="mailto:{{ $bottom['mail'] }}" class="__mail flex items-center w-max">{{ $bottom['mail'] }}</a>
			</div>

			<div data-gsap-element="social" class="__socials flex items-center gap-4 mt-6">
				<a target="_blank" href="https://www.facebook.com/realco.deweloper/"><img src="/wp-content/uploads/2026/01/fb.svg" /></a>
				<a target="_blank" href="https://www.instagram.com/realco_property/"><img src="/wp-content/uploads/2026/01/ig.svg" /></a>
			</div>

			<div data-gsap-element="social" class="__service mt-10">
				<img class="aspect-square rounded-full w-36" src="{{ $bottom['image']['url'] }}" />
				<div class="__txt mt-2">
					{!! $bottom['service'] !!}
				</div>
			</div>
		</div>

		<div data-gsap-element="form" class="__form">
			<h4 data-gsap-element="header" class="mb-6">{{ $bottom['title'] }}</h4>
			{!! do_shortcode($bottom['shortcode']) !!}
		</div>

	</div>

	<img data-gsap-element="img" class="__bg scale-140 absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 pointer-events-none" src="/wp-content/uploads/2026/01/contact-bg.svg" />

	</div>
</section>