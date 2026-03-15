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

<!--- values --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-content relative section-wrapper radius -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative z-10">

		<h3 data-gsap-element="header" class="m-header text-center w-full md:w-1/2 m-auto">{{ strip_tags($g_values['header']) }}</h3>

		@if (!empty($r_values))

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8 mt-10">
			@foreach ($r_values as $item)
			<div data-gsap-element="image" class="__card relative overflow-hidden bg-white radius px-10 pt-14 pb-36">
				@if (!empty($item['title']))
				<h6 class="text-h7 mb-2">{{ $item['title'] }}</h6>
				@endif
				@if (!empty($item['text']))
				<p class="">{{ $item['text'] }}</p>
				@endif

				@if (!empty($item['image']['url']))
				<img class="absolute -bottom-3" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
				@endif
			</div>
			@endforeach
		</div>
		@endif

	</div>

	<img data-gsap-element="bg" class="__bg absolute h-[800px] left-20 top-1/2 -translate-y-1/2 opacity-60 pointer-events-none" src="/wp-content/uploads/2026/01/shape-white.svg" />
</section>