<!--- image --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-image relative section-wrapper !mt-6">

	<div class="__wrapper items-center gap-8">
		<img data-gsap-element="image" class="" src="{{ $g_image['image']['url'] }}" alt="{{ $g_image['image']['alt'] ?? '' }}">
	</div>

</section>