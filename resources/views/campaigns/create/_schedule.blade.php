  <div class="grid grid-cols-2 gap-4">

      <div>
          <x-input-label for="send_at" :value="__('Send at')" />
          <x-input.text id="send_at" class="block mt-1 w-full" type="date" name="send_at" :value="old('send_at', $data['send_at'])" autofocus />
          <x-input-error :messages="$errors->get('send_at')" class="mt-2" />
      </div>
  </div>
