  <div class="flex flex-col gap-4">

      <x-alert success :title="__('Your campaign is ready to be send!')" />

      <div>
          <div>De: ---@---.com</div>
          <div>Para: #count de emails do email_list_id</div>
          <div>Assunto: {{ $data['subject'] }}</div>
          <div>Template: #template</div>
      </div>
      <hr />

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
