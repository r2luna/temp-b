  <div class="flex flex-col gap-4">

      <x-alert success :title="__('Your campaign is ready to be send!')" />

      <div class="space-y-2">
          <div>{{ __('From') }}: {{ config('mail.from.address') }}</div>
          <div>{{ __('To') }}: <x-badge>{{ $countEmails }} Emails</x-badge></div>
          <div>{{ __('Subject') }}: {{ $data['subject'] }}</div>
          <div>{{ __('Template') }}: <x-badge>{{ $template }}</x-badge></div>
      </div>

      <hr class="my-3 opacity-20" />

      <div x-data="{ show: '{{ data_get($data, 'send_when', 'now') }}' }">
          <x-input-label :value="__('Schedule Delivery')" />
          <div class="flex flex-col gap-2 mt-2">
              <x-input.radio id="send_now" name="send_when" value="now" x-model="show">{{ __('Send Now') }}</x-input.radio>
              <x-input.radio id="send_later" name="send_when" value="later" x-model="show">{{ __('Send Later') }}</x-input.radio>
          </div>
          <div x-show="show == 'later'">
              <x-input.text id="send_at" class="block mt-1 w-full" type="date" name="send_at" :value="old('send_at', $data['send_at'])" autofocus />
              <x-input-error :messages="$errors->get('send_at')" class="mt-2" />
          </div>
      </div>
  </div>
