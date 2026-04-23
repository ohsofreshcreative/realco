@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';

if (!empty($background) && $background !== 'none') {
$sectionClass .= ' ' . $background;
}
@endphp

<!--- map -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-map relative -spt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative">
		<p data-gsap-element="title" class="title-p">{{ $g_map['title'] }}</p>
		<div class="__col grid grid-cols-1 lg:grid-cols-2  gap-10 mt-2">
			<h4 data-gsap-element="header" class="">{{ $g_map['header'] }}</h4>

			<div data-gsap-element="txt" class="mt-2">
				{!! $g_map['txt'] !!}
			</div>

		</div>

		<div data-gsap-element="map" class="rounded-3xl overflow-hidden mt-8">
			{!! $g_map['code'] !!}
		</div>

	
		<x-button data-gsap-element="btn" class="second-btn btn2 m-btn align-self-bottom text-center !flex mx-auto" href="https://www.google.com/maps/dir/?api=1&origin=Current+Location&destination=Torowa+20,+05-500+Nowa+Iwiczna" target="_blank" style="display:flex !important;">
			Sprawdź dojazd
		</x-button>

</section>