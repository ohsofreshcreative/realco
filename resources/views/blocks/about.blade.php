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

			<div data-gsap-element="img" class="__photos h-full order1">
				<img class="__img1 object-cover w-full img-3xl __img rounded-xl md:rounded-3xl" src="{{ $g_about['image']['url'] }}" alt="{{ $g_about['image']['alt'] ?? '' }}">
			</div>
			@endif

			<div class="__content order2">
				<p data-gsap-element="title" class="m-title title-p">{{ $g_about['title'] }}</p>
				<h3 data-gsap-element="header" class="m-header">{{ $g_about['header'] }}</h3>

				<div data-gsap-element="txt" class="__txt mt-2">
					{!! $g_about['txt'] !!}
				</div>

				@if (!empty($g_about['button']))
				<a data-gsap-element="btn" class="main-btn m-btn align-self-bottom" href="{{ $g_about['button']['url'] }}">{{ $g_about['button']['title'] }}</a>
				@endif

			</div>

		</div>
	</div>

	<img data-gsap-element="bg" class="__bg absolute left-5/12 -translate-x-1/2 top-20 pointer-events-none" src="/wp-content/uploads/2026/03/shape-bg.svg" />
</section>