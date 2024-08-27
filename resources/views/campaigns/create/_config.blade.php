  <div class="grid grid-cols-2 gap-4">
      <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-input.text id="name" class="block mt-1 w-full" name="name" :value="old('name', $data['name'])" autofocus />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>
      <div>
          <x-input-label for="subject" :value="__('Subject')" />
          <x-input.text id="subject" class="block mt-1 w-full" name="subject" :value="old('subject', $data['subject'])" autofocus />
          <x-input-error :messages="$errors->get('subject')" class="mt-2" />
      </div>
      <div>
          <x-input-label for="email_list_id" :value="__('Email List')" />
          <x-input.text id="email_list_id" class="block mt-1 w-full" name="email_list_id" :value="old('email_list_id', $data['email_list_id'])" autofocus />
          <x-input-error :messages="$errors->get('email_list_id')" class="mt-2" />
      </div>
      <div>
          <x-input-label for="template_id" :value="__('Template')" />
          <x-input.text id="template_id" class="block mt-1 w-full" name="template_id" :value="old('template_id', $data['template_id'])" autofocus />
          <x-input-error :messages="$errors->get('template_id')" class="mt-2" />
      </div>

      <div>
          <x-input-label for="track_click" :value="__('Track Click')" />
          <x-input.text id="track_click" class="block mt-1 w-full" name="track_click" :value="old('track_click', $data['track_click'])" autofocus />
          <x-input-error :messages="$errors->get('track_click')" class="mt-2" />
      </div>
      <div>
          <x-input-label for="track_open" :value="__('Track Open')" />
          <x-input.text id="track_open" class="block mt-1 w-full" name="track_open" :value="old('track_open', $data['track_open'])" autofocus />
          <x-input-error :messages="$errors->get('track_open')" class="mt-2" />
      </div>
  </div>
