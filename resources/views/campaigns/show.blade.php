<x-layouts.app>
    <x-slot name="header">
        <x-h2> <a href="{{ route('campaigns.index') }}">{{ __('Campaigns') }}</a> > {{ $campaign->name }} > {{ __(str($what)->title()->toString) }}</x-h2>
    </x-slot>

    <x-card>
        <x-tabs :tabs="[
            __('Statistics') => route('campaigns.show', ['campaign' => $campaign->id, 'what' => 'statistics']),
            __('Open') => route('campaigns.show', ['campaign' => $campaign->id, 'what' => 'open']),
            __('Clicked') => route('campaigns.show', ['campaign' => $campaign->id, 'what' => 'clicked']),
        ]">
            @include('campaigns.show._' . $what)
        </x-tabs>
    </x-card>
</x-layouts.app>
