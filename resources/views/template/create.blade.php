<x-layouts.app>
    <x-slot name="header">
        <x-h2> {{ __('Templates') }} > {{ __('Create') }}</x-h2>
    </x-slot>

    <x-card>
        <x-form :action="route('template.store')" post>
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-input.text id="name" class="block mt-1 w-full" name="name" :value="old('name')" autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="body" :value="__('Body')" />
                <x-input.text id="body" class="block mt-1 w-full" name="body" :value="old('body')" autofocus />
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
            </div>

            <div class="flex items-center space-x-4">
                <x-button.link secondary :href="route('template.index')">
                    {{ __('Cancel') }}
                </x-button.link>
                <x-button type="submit">
                    {{ __('Save') }}
                </x-button>
            </div>
        </x-form>
    </x-card>
</x-layouts.app>
