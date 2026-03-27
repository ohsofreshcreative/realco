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

<!--- content -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-content relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative z-10">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-20">
			@if (!empty($g_content['image']))
			<div data-gsap-element="img" class="__img h-full order1">
				<img class="object-cover w-full h-full aspect-auto lg:aspect-square radius-img" src="{{ $g_content['image']['url'] }}" alt="{{ $g_content['image']['alt'] ?? '' }}">
			</div>
			@endif

			<div class="__content order2 lg:py-10">
				@if (!empty($g_content['logo']))
				<img data-gsap-element="logo" class="max-h-26" src="{{ $g_content['logo']['url'] }}" alt="{{ $g_content['logo']['alt'] ?? '' }}">
				@endif
				<h2 data-gsap-element="header" class="m-header">{{ $g_content['header'] }}</h2>

				<div data-gsap-element="txt" class="__txt mt-2">
					{!! $g_content['txt'] !!}
				</div>

				@if (!empty($g_content['button']))
				<a data-gsap-element="btn" class="second-btn m-btn align-self-bottom" href="{{ $g_content['button']['url'] }}">{{ $g_content['button']['title'] }}</a>
				@endif

			</div>

		</div>
	</div>

	<img data-gsap-element="bg" class="__bg absolute top-1/2 -translate-y-1/2 -right-1/6 opacity-30 pointer-events-none" src="{{ $g_content['bg']['url'] ?? '' }}" />
</section>