@props([
    'href' => null,
    'variant' => 'primary',
    'tag' => null,
    'target' => null, // Dodajemy nową właściwość 'target'
])

@php
    // Logika wyboru tagu: jeśli jest 'href', to na 99% chcemy link <a>.
    // W przeciwnym wypadku to będzie przycisk <button>.
    $tag = $tag ?? ($href ? 'a' : 'button');

    // Dynamiczne budowanie listy klas CSS
    $classes = 'btn btn-' . $variant;
@endphp

@if ($tag === 'a')
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => $classes]) }}
        @if ($target) target="{{ $target }}" @endif>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif