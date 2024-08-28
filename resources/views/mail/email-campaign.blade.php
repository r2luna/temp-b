<x-mail::message>
{!! $campaign->body !!}

{{ __('Thanks') }},<br>

{{ config('app.name') }}
</x-mail::message>
