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

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-info relative -smt {{ $sectionClass }} {{ $section_class }}">

    <div class="__wrapper c-main relative z-10">

        <div class="w-full md:w-1/2">
            <p data-gsap-element="title" class="m-title title-p">{{ $g_info['title'] }}</p>
            <h4 data-gsap-element="header" class="">{{ $g_info['header'] }}</h4>
        </div>

        <div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-20 mt-8">
            @if (!empty($g_info['image']))
            <div data-gsap-element="img" class="__img h-full order1">
                <img class="object-cover w-full img-md aspect-auto lg:aspect-square radius-img" src="{{ $g_info['image']['url'] }}" alt="{{ $g_info['image']['alt'] ?? '' }}">
            </div>
            @endif

            <div class="__info order2 lg:py-10">
                <div data-gsap-element="txt" class="__txt mt-2">
                    {!! $g_info['txt'] !!}
                </div>

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

        <div id="{{ $unique_id }}" class="__filters bg-white rounded-3xl flex flex-col gap-y-6 w-full max-w-max p-6 sm:p-10 mb-8">

    <div class="flex flex-col md:flex-row gap-8">
        {{-- Filtr: Powierzchnia działki --}}
        <div>
            <label class="block text-h6 mb-3">Powierzchnia działki (m²)</label>
            <div class="flex items-center gap-2">
                <input type="number" id="filter-dzialka-od" placeholder="od" class="filter-input w-full">
                <input type="number" id="filter-dzialka-do" placeholder="do" class="filter-input w-full">
            </div>
        </div>
        {{-- Filtr: Status (jako checkboxy) --}}
        <div>
            <label class="block text-h6 mb-3">Status</label>
            <div class="flex gap-x-6 gap-y-2 flex-wrap">
                <div class="flex flex-col">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="a" class="filter-status-checkbox">
                        <span>Dostępny</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" value="b" class="filter-status-checkbox">
                        <span>Zarezerwowany</span>
                    </label>
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" value="c" class="filter-status-checkbox">
                    <span>Sprzedany</span>
                </label>
            </div>
        </div>
    </div>
    {{-- Przycisk resetowania --}}
    <div class="mt-2">
        <button type="button" id="filter-reset-button" class="reset-button">Wyczyść filtry</button>
    </div>
</div>

            {{-- 2. TABELA Z DANYMI --}}
            <div class="__table-wrapper">
                {{-- Nagłówki tabeli (widoczne tylko na desktopie) --}}
                <div class="__thead hidden lg:grid grid-cols-7 gap-4 px-4">
                    <div class="__th text-h7 font-header">Dom</div>
                    <div class="__th text-h7 font-header">Cena</div>
                    <div class="__th text-h7 font-header">Metraż</div>
                    <div class="__th text-h7 font-header">Działka</div>
                    <div class="__th text-h7 font-header">Status</div>
                    <div class="__th text-h7 font-header">Karta</div>
                    <div class="__th text-h7 font-header">Kontakt</div>
                </div>
                {{-- Wiersze tabeli --}}
                <div class="__tbody">
                    @foreach ($r_info as $row)
                    <div class="__tr"
                        data-status="{{ $row['status'] }}"
                        data-dzialka="{{ (float) preg_replace('/[^\d.]/', '', $row['dzialka']) }}">
                        
                        <div class="__td" data-label="Dom">
                            <div class="flex flex-col">
                                <span>{{ $row['dom'] }}</span>
                                @if (!empty($row['prospekt']))
                                <a href="{{ $row['prospekt']['url'] }}" target="_blank" class="table-link">Prospekt</a>
                                @endif
                            </div>
                        </div>
                        <div class="__td" data-label="Cena">
                            {{ $row['cena'] }}
                            @if (!empty($row['cena']) && !empty($row['metraz']))
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
                        </div>
                        <div class="__td" data-label="Metraż">{{ $row['metraz'] }}</div>
                        <div class="__td" data-label="Działka">{{ $row['dzialka'] }}</div>
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
                            <a href="#zapisz-sie" class="table-link !underline">Umów spotkanie</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>