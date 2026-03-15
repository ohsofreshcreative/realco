@php
$sectionClass = '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<!-- hero --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	class="b-hero bg-third section-wrapper radius relative overflow-hidden {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main grid grid-cols-1 lg:grid-cols-2 gap-8 items-center relative z-20 py-10">
		<div class="__content relative z-20 py-0 md:py-30 order-2 lg:order-1">

			<h1 data-gsap-element="header" class="m-header">
				{{ $g_hero['title'] }}
			</h1>
			<div data-gsap-element="txt" class="">
				{!! $g_hero['txt'] !!}
			</div>
			@if (!empty($g_hero['button1']))
			<div class="inline-buttons m-btn">
				<a data-gsap-element="button" class="main-btn left-btn"
					href="{{ $g_hero['button1']['url'] }}"
					target="{{ $g_hero['button1']['target'] }}">
					{{ $g_hero['button1']['title'] }}
				</a>
				@if (!empty($g_hero['button2']))
				<a data-gsap-element="button" class="second-btn"
					href="{{ $g_hero['button2']['url'] }}"
					target="{{ $g_hero['button2']['target'] }}">
					{{ $g_hero['button2']['title'] }}
				</a>
				@endif
			</div>
			@endif
		</div>

		@if ($g_hero['image'])
		<div class="__img relative radius-img overflow-hidden order-1 lg:order-2">
			<img data-gsap-element="image" class="absolute mix-blend-overlay opacity-50 bottom-10 left-10 w-24 md:w-max z-20" src="/wp-content/uploads/2026/01/shape-2.svg" />
			<img data-gsap-element="image" class="object-cover rounded-3xl md:rounded-[104] w-full h-[200px] sm:h-full" src="{{ $g_hero['image']['url'] }}" alt="{{ $g_hero['image']['alt'] ?? '' }}">
		</div>
		@endif
	</div>

	<img data-gsap-element="image" class="absolute opacity-20 -left-40 -top-10 md:-bottom-20" src="/wp-content/uploads/2026/01/shape.svg" />

</section>