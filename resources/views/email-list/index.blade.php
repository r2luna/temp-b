<x-layouts.app>
    <x-slot name="header">
        <x-h2> {{ __('Email List') }} </x-h2>
    </x-slot>

    <x-card>
        @unless ($emailLists->isEmpty())
            <x-table :headers="['#', __('Email List'), __('# Subscribers'), __('Actions')]">
                <x-slot name="body">
                    @foreach ($emailLists as $list)
                        <tr>
                            <x-table.td>{{ $list->id }}</x-table.td>
                            <x-table.td>{{ $list->title }}</x-table.td>
                            <x-table.td>{{ $list->subscribers()->count() }}</x-table.td>
                            <x-table.td></x-table.td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        @else
            <div class="flex justify-center">
                <x-link-button :href="route('email-list.create')">
                    {{ __('Create your first email list') }}
                </x-link-button>
            </div>
        @endunless
    </x-card>
</x-layouts.app>
