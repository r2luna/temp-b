<x-layouts.app>
    <x-slot name="header">
        <x-h2> {{ __('Email List') }} > {{ __('Create new list') }}</x-h2>
    </x-slot>

    <x-card>
        <x-form :action="route('email-list.store')" post>
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" name="title" :value="old('title')" autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="file" :value="__('File List')" />
                <x-text-input id="file" class="block mt-1 w-full" type="file" name="file" autofocus />
                <x-input-error :messages="$errors->get('file')" class="mt-2" />
            </div>

            <div class="flex items-center space-x-4">
                <x-secondary-button type="reset">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-primary-button type="submit">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </x-form>
    </x-card>
</x-layouts.app>
