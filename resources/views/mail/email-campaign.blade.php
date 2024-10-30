<x-mail::message>
{!! $body !!}

{{ __('Thanks') }},<br>

{{ config('app.name') }}

<img src="{{ route('tracking.openings', $mail) }}" style="display:none;" />
</x-mail::message>
