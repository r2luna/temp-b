@props([
    'post' => null,
])

@php
    $method = $post ? 'POST' : 'GET';
@endphp

<form {{ $attributes->class(['gap-4 flex flex-col']) }} method="{{ $method }}">
    @csrf

    {{ $slot }}
</form>
