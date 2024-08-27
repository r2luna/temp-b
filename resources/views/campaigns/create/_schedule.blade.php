  <div class="grid grid-cols-2 gap-4">

      <div>
          <x-input-label for="sent_at" :value="__('Sent at')" />
          <x-input.text id="sent_at" class="block mt-1 w-full" type="date" name="sent_at" :value="old('sent_at', $data['sent_at'])" autofocus />
          <x-input-error :messages="$errors->get('sent_at')" class="mt-2" />
      </div>
  </div>
