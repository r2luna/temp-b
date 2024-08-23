@props([
    'post' => null,
    'put' => null,
    'delete' => null,
    'flat' => false,
])

@php
    $method = ($post or $put or $delete) ? 'POST' : 'GET';
@endphp

<form {{ $attributes->class(['gap-4 flex flex-col' => !$flat]) }} method="{{ $method }}">
    @if ($method != 'GET')
        @csrf
    @endif

    @if ($put)
        @method('PUT')
    @endif

    @if ($delete)
        @method('DELETE')
    @endif

    {{ $slot }}
</form>
