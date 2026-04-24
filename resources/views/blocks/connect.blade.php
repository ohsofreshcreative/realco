@php
$sectionClass = '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<!-- connect -->


	<p class="c-main text-center font-header text-lg text-third-800 pt-10">Wszystkie wizualizacje mają charakter poglądowy. Elementy techniczne (np. jednostki zewnętrzne pomp ciepła) mogą nie być na nich uwzględnione.</p>


<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-connect relative overflow-hidden section-wrapper radius bg-third py-16 !mt-10 {{ $sectionClass }} {{ $section_class }}">
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

<div class="c-main">
	
	<div class="flex flex-col md:flex-row gap-8 mt-16">
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 items-center gap-8">
			<img style="width:200px;" src="/wp-content/uploads/2026/01/realco.png">
	
			<p>ul. Zielna 37, Budynek C, Piętro IV<br> 00-108 Warszawa</p>
	
			<p>+ 48 22 395 75 54 <br> biuro@realco.pl</p>
	
			<div class="flex gap-4">
				<img style="width:32px;" src="/wp-content/uploads/2026/01/fb.svg">
				<img style="width:32px;" src="/wp-content/uploads/2026/01/ig.svg">
			</div>
		</div>
	
		<img style="width:200px;" src="/wp-content/uploads/2026/03/image-1.png">
	</div>
	
	<p class="text-sm text-gray-400 mt-10">Całość treści prezentowanej na stronie internetowej stanowi własność Realco Property Investment and Development sp. z o.o. i jest chroniona jako utwór w rozumieniu ustawy z dnia 4 lutego 1994 r. o prawie autorskim i prawach pokrewnych (Dz.U. z 2022 r. poz. 2509). Jakiekolwiek rozpowszechnianie, kopiowanie lub wykorzystywanie jej części w jakiejkolwiek formie jest zabronione bez uprzedniej pisemnej zgody Realco Property Investment and Development sp. z o.o. Wszystkie wizualizacje przedstawione na stronie mają charakter poglądowy i nie stanowią oferty handlowej w rozumieniu art. 66 § 1 Kodeksu cywilnego oraz innych obowiązujących przepisów prawnych. Realco Property Investment and Development sp. z o.o. zastrzega sobie prawo do wprowadzania zmian w wizualizacjach przedstawionych na stronie.</p>
</div>