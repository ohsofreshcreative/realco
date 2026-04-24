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

<!--- overlap --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-overlap relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative z-10">
		<div class="__content order2">
			<div class="__txt w-full md:w-1/2 mx-auto">
				<h3 data-gsap-element="header" class="text-center m-header">{{ $g_overlap['title'] }}</h3>

				<div data-gsap-element="header" class="text-center">
					{!! $g_overlap['content'] !!}
				</div>
			</div>

			<div class="grid grid-cols-1 gap-8 mt-14">
				@foreach ($r_overlap as $item)
				<div class="gsap__cards __cards sticky top-20 mt-4">
					<div class="gsap__card __card b-border p-8 rounded-4xl" style="background-image:url({{ $item['r_image']['url'] }}); background-size: cover; background-position: center;">
						<div class="__box bg-lighter rounded-3xl w-full md:w-1/2 gap-4 p-6 md:p-10 my-30 mx-0 md:mx-20">
							<img src="{{ $item['icon']['url'] }}" alt="{{ $item['icon']['alt'] }}" class="w-12 mb-4">
							<h5 class="secondary !text-[20px] md:text-h5">{{ $item['r_header'] }}</h5>
							<div class="">{!! $item['r_txt'] !!}</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>


		</div>
	</div>

	<!-- <img data-gsap-element="bg" class="__bg absolute w-[400px] -left-60 top-32 pointer-events-none" src="/wp-content/uploads/2025/12/sign_small.svg" /> -->
</section>