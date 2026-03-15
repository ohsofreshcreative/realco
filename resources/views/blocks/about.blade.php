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

<!--- about -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-about relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative z-10">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-20 md:gap-10">
			@if (!empty($g_about['image']))

			<div data-gsap-element="img" class="__photos h-full">
				@if (!empty($g_about_2['image1']))
				<div data-gsap-element="image" class="__img2">
					<img class="rounded-xl md:rounded-3xl" src="{{ $g_about_2['image1']['url'] }}" alt="{{ $g_about_2['image1']['alt'] ?? '' }}">
				</div>
				@endif
				@if (!empty($g_about_2['image2']))
				<div data-gsap-element="image" class="__img3">
					<img class="rounded-xl md:rounded-3xl" src="{{ $g_about_2['image2']['url'] }}" alt="{{ $g_about_2['image2']['alt'] ?? '' }}">
				</div>
				@endif
				@if (!empty($g_about_2['image3']))
				<div data-gsap-element="image" class="__img4">
					<img class="rounded-xl md:rounded-3xl" src="{{ $g_about_2['image3']['url'] }}" alt="{{ $g_about_2['image3']['alt'] ?? '' }}">
				</div>
				@endif
				<img class="__img1 object-cover w-full img-3xl __img rounded-xl md:rounded-3xl" src="{{ $g_about['image']['url'] }}" alt="{{ $g_about['image']['alt'] ?? '' }}">
			</div>
			@endif

			<div class="__content order2 w-full md:w-2/3 mx-auto">
				<h2 data-gsap-element="header" class="m-header">{{ $g_about['header'] }}</h2>

				<div data-gsap-element="txt" class="__txt mt-2">
					{!! $g_about['txt'] !!}
				</div>

				@if (!empty($g_about['button']))
				<a data-gsap-element="btn" class="main-btn m-btn align-self-bottom" href="{{ $g_about['button']['url'] }}">{{ $g_about['button']['title'] }}</a>
				@endif

			</div>

		</div>
	</div>

	<img data-gsap-element="bg" class="__bg absolute h-[800px] -left-[400px] -top-1/2 translate-y-1/2 pointer-events-none" src="/wp-content/uploads/2026/01/shape-3.svg" />

	<img data-gsap-element="bg" class="__bg absolute h-[904px] -right-[400px] -bottom-100 pointer-events-none" src="/wp-content/uploads/2026/01/circle.svg" />
</section>