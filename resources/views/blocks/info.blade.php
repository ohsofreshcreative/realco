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

<!--- info -->

{{-- Dodajemy x-data do głównego kontenera sekcji, aby zarządzać stanem modala --}}
<section x-data="infoBlock()" data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-info relative -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main relative z-10">

		<div class="w-full md:w-1/2">
			<p data-gsap-element="title" class="m-title title-p">{{ $g_info['title'] }}</p>
			<h4 data-gsap-element="header" class="">{{ $g_info['header'] }}</h4>
		</div>

		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-20 mt-8">
			@if (!empty($g_info['image']))
			<div data-gsap-element="img" class="__img h-full order1">
				<img class="object-cover w-full h-full radius-img" src="{{ $g_info['image']['url'] }}" alt="{{ $g_info['image']['alt'] ?? '' }}">
			</div>
			@endif

			<div class="__info order2 lg:py-10">
				<div data-gsap-element="txt" class="__txt mt-2">
					{!! $g_info['txt'] !!}
				</div>

				@if (!empty($g_info['typy_domow']))
<div class="mt-8">
    <h5 class="text-xl font-bold mb-4">Dostępne typy domów:</h5>
    {{-- Dodajemy klasę, na której będzie działać baguetteBox --}}
    <div class="flex flex-col gap-4 lightbox-gallery"> 
        @foreach ($g_info['typy_domow'] as $typ)
        <div class="flex items-center gap-4">
            @if (!empty($typ['image']))
            {{-- Link musi otaczać obrazek, href wskazuje na dużą wersję --}}
            <a href="{{ $typ['image']['url'] }}" data-caption="{{ $typ['title'] }}">
                <img src="{{ $typ['image']['sizes']['thumbnail'] }}" alt="{{ $typ['image']['alt'] ?? $typ['title'] }}" class="w-16 h-16 rounded-full object-cover border-2 border-white shadow-md">
            </a>
            @endif
            
            @if (!empty($typ['title']))
            <span class="font-semibold">{{ $typ['title'] }}</span>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endif

				@if (!empty($g_info['button']))
				<a data-gsap-element="btn" class="second-btn m-btn align-self-bottom" href="{{ $g_info['button']['url'] }}">{{ $g_info['button']['title'] }}</a>
				@endif

			</div>
		</div>

		<div class="bg-light rounded-3xl p-4 sm:p-10 mt-12">
			@if (!empty($r_info))
			@php
			$unique_id = uniqid('table-filters-');
			@endphp

			<div id="{{ $unique_id }}" class="__filters bg-white rounded-3xl flex flex-col gap-y-6 w-full p-6 sm:p-10 mb-8">
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
					{{-- Filtr: Powierzchnia działki --}}
					<div class="hidden">
						<label class="block text-h6 mb-3">Powierzchnia działki (m²)</label>
						<div class="flex items-center gap-2">
							<input type="number" id="filter-dzialka-od" placeholder="od" class="filter-input w-full">
							<input type="number" id="filter-dzialka-do" placeholder="do" class="filter-input w-full">
						</div>
					</div>

					{{-- Filtr: Typ domu (jako checkboxy) --}}
					<!-- <div>
						<label class="block text-h6 mb-3">Typ domu</label>
						<div class="flex flex-col gap-2">
							<label class="flex items-center gap-2 cursor-pointer">
								<input type="checkbox" value="szerokie-blizniaki" class="filter-typ-domu-checkbox">
								<span>Domy typu bliźniak</span>
							</label>
							<label class="flex items-center gap-2 cursor-pointer">
								<input type="checkbox" value="segmenty" class="filter-typ-domu-checkbox">
								<span>Segmenty</span>
							</label>
							<label class="flex items-center gap-2 cursor-pointer">
								<input type="checkbox" value="domy-jednorodzinne" class="filter-typ-domu-checkbox">
								<span>Domy jednorodzinne</span>
							</label>
						</div>
					</div> -->

					{{-- Filtr: Status (jako checkboxy) --}}
					<div>
						<label class="block text-h6 mb-3">Status</label>
						<div class="flex flex-col md:flex-row gap-2">
							<label class="flex items-center gap-2 cursor-pointer">
								<input type="checkbox" value="a" class="filter-status-checkbox">
								<span>Dostępny</span>
							</label>
							<label class="flex items-center gap-2 cursor-pointer">
								<input type="checkbox" value="b" class="filter-status-checkbox">
								<span>Zarezerwowany</span>
							</label>
							<label class="flex items-center gap-2 cursor-pointer">
								<input type="checkbox" value="c" class="filter-status-checkbox">
								<span>Sprzedany</span>
							</label>
						</div>
					</div>
				</div>
				{{-- Przycisk resetowania --}}
				<div class="mt-0">
					<button type="button" id="filter-reset-button" class="reset-button">Wyczyść filtry</button>
				</div>
			</div>

			{{-- 2. TABELA Z DANYMI --}}
			<div class="__table-wrapper">
				{{-- Nagłówki tabeli --}}
				<div class="__thead hidden lg:grid grid-cols-7 gap-4 px-4">
					<div class="__th text-h7 font-header">Dom</div>
					<div class="__th text-h7 font-header">Cena</div>
					<div class="__th text-h7 font-header">Metraż</div>
					<div class="__th text-h7 font-header">Działka</div>
					<!-- <div class="__th text-h7 font-header">Typ domu</div> -->
					<div class="__th text-h7 font-header">Status</div>
					<div class="__th text-h7 font-header">Karta</div>
					<div class="__th text-h7 font-header">Kontakt</div>
				</div>
				{{-- Wiersze tabeli --}}
				<div class="__tbody">
					@foreach ($r_info as $row)
					<div class="__tr"
						data-status="{{ $row['status'] }}"
						data-dzialka="{{ (float) preg_replace('/[^\d.]/', '', $row['dzialka']) }}"
						data-typ-domu="{{ $row['typ_domu'] }}">

						<div class="__td" data-label="Dom">
							<div class="flex flex-col">
								<span>{{ $row['dom'] }}</span>
								@if (!empty($row['prospekt']))
								<a href="{{ $row['prospekt']['url'] }}" target="_blank" class="table-link !underline">Prospekt</a>
								@endif
							</div>
						</div>
						<div class="__td" data-label="Cena">
							  @if (!empty($row['cena']))
        {{ $row['cena'] }} zł
        @if (!empty($row['metraz']))
            @php
            $numeric_cena = (float) str_replace(',', '.', preg_replace('/[^\d,.]/', '', $row['cena']));
            $numeric_metraz = (float) str_replace(',', '.', preg_replace('/[^\d,.]/', '', $row['metraz']));
            @endphp
            @if ($numeric_metraz > 0)
            <span class="block text-sm text-gray-500">
                ({{ number_format($numeric_cena / $numeric_metraz, 2, ',', ' ') }} zł/m²)
            </span>
            @endif
        @endif
    @endif
						</div>
						<div class="__td" data-label="Metraż">{{ $row['metraz'] }}  m²</div>
						<div class="__td" data-label="Działka">{{ $row['dzialka'] }}  m²</div>
					<!-- 	<div class="__td" data-label="Typ domu">{{ $row['typ_domu_label'] }}</div> -->
						<div class="__td" data-label="Status">
							<div class="flex items-center gap-2">
								<span class="status-label status-{{ $row['status'] }}">{{ $row['status'] == 'a' ? 'Dostępny' : ($row['status'] == 'b' ? 'Zarezerwowany' : 'Sprzedany') }}</span>
							</div>
						</div>
						<div class="__td" data-label="Karta">
							@if (!empty($row['karta']))
							<a href="{{ $row['karta']['url'] }}" target="_blank" class="table-link !underline">PDF</a>
							@endif
						</div>
						<div class="__td" data-label="Kontakt">
							<div class="flex flex-col items-start gap-2">
								<a href="#zapisz-sie" class="table-link !underline">Umów spotkanie</a>
								{{-- NOWY PRZYCISK OTWIERAJĄCY MODAL --}}
								<button @click="openModal('{{ $row['dom'] }}')" class="table-link !underline cursor-pointer text-left text-secondary">
    Zarezerwuj dom
</button>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			@endif
		</div>
	</div>

	{{-- NOWA SEKCJA: MODAL --}}
	<!-- Modal Panel -->
	<div
		x-show="modalOpen"
		@keydown.escape.window="modalOpen = false"
		x-transition:enter="transition ease-out duration-300"
		x-transition:enter-start="opacity-0"
		x-transition:enter-end="opacity-100"
		x-transition:leave="transition ease-in duration-200"
		x-transition:leave-start="opacity-100"
		x-transition:leave-end="opacity-0"
		class="info__modal fixed inset-0 z-200 flex items-start justify-end bg-black/50 bg-opacity-50"
		style="display: none;"
		aria-labelledby="modal-title"
		role="dialog"
		aria-modal="true">
		<!-- Panel -->
		<div
			@click.away="modalOpen = false"
			x-show="modalOpen"
			x-transition:enter="transition ease-out duration-300"
			x-transition:enter-start="transform translate-x-full"
			x-transition:enter-end="transform translate-x-0"
			x-transition:leave="transition ease-in duration-200"
			x-transition:leave-start="transform translate-x-0"
			x-transition:leave-end="transform translate-x-full"
			class="relative w-full max-w-md h-full bg-third-300 shadow-xl overflow-y-auto">
			<div class="p-8">
				<!-- Nagłówek modala -->
				<div class="flex items-center justify-between mb-6">
					<h5 id="modal-title" class="text-2xl font-bold">Rezerwacja: <span class="font-header" x-text="houseName"></span></h5>
					<button @click="modalOpen = false" class="p-2 -mr-2">
						<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
						</svg>
						<span class="sr-only">Zamknij</span>
					</button>
				</div>

				<!-- Treść modala (formularz) -->
				<div class="modal-content">
					{!! do_shortcode('[contact-form-7 id="e23f803" title="Rezerwacja"]') !!}
				</div>
			</div>
		</div>
	</div>
	
<script>
    function infoBlock() {
        return {
            modalOpen: false,
            houseName: '',
            openModal(name) {
                this.modalOpen = true;
                this.houseName = name;
                // Czekamy na wyrenderowanie modala przez Alpine
                this.$nextTick(() => {
                    const hiddenInput = document.querySelector('#house-name');
                    if (hiddenInput) {
                        hiddenInput.value = this.houseName;
                    }
                });
            }
        }
    }
</script>
</section>