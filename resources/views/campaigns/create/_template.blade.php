<div>
    <x-input.richtext name="body" :value="old('body', $data['body'])" />
    <x-input-error :messages="$errors->get('body')" class="mt-2" />
</div>
