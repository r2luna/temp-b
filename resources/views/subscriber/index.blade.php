<x-layouts.app>
    <x-slot name="header">
        <x-h2> {{ __('Email List') }} > {{ $emailList->title }} > {{ __('Subscribers') }}</x-h2>
    </x-slot>

    <x-card class="space-y-4">
        <div class="flex justify-between">
            <x-button.link :href="route('subscribers.create', $emailList)">
                {{ __('Add a new subscriber') }}
            </x-button.link>

            <x-form :action="route('subscribers.index', $emailList)" x-data x-ref="form" class="w-3/5 flex space-x-4 items-center" flat>
                <x-input.checkbox value="1" name="showTrash" :label="__('Show Deleted Records')" @click="$refs.form.submit()" :checked="$showTrash" />
                <x-input.text name="search" :placeholder="__('Search')" :value="$search" class="w-full" />
            </x-form>
        </div>

        <x-table :headers="['#', __('Name'), __('Email'), __('Actions')]">
            <x-slot name="body">
                @foreach ($subscribers as $subscriber)
                    <tr>
                        <x-table.td>{{ $subscriber->id }}</x-table.td>
                        <x-table.td>{{ $subscriber->name }}</x-table.td>
                        <x-table.td>{{ $subscriber->email }}</x-table.td>
                        <x-table.td>
                            @unless ($subscriber->trashed())
                                <x-form :action="route('subscribers.destroy', [$emailList, $subscriber])" delete flat onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                    <x-button.secondary type="submit">Delete</x-button.secondary>
                                </x-form>
                            @else
                                <x-badge danger>{{ __('Deleted') }}</x-badge>
                            @endunless
                        </x-table.td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>

        {{ $subscribers->links() }}
    </x-card>
</x-layouts.app>
