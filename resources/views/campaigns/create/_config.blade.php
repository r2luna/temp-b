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
          <x-select id="email_list_id" name="email_list_id">
              <option value="" @if (blank(old('email_list_id', $data['email_list_id']))) selected @endif></option>
              @foreach ($emailLists as $list)
                  <option value="{{ $list->id }}" @if (old('email_list_id', $data['email_list_id']) == $list->id) selected @endif>
                      {{ $list->title }}
                  </option>
              @endforeach
          </x-select>
          <x-input-error :messages="$errors->get('email_list_id')" class="mt-2" />
      </div>
      <div>
          <x-input-label for="template_id" :value="__('Template')" />
          <x-select id="template_id" name="template_id">
              <option value="" @if (blank(old('template_id', $data['template_id']))) selected @endif></option>
              @foreach ($templates as $template)
                  <option value="{{ $template->id }}" @if (old('template_id', $data['template_id']) == $template->id) selected @endif>
                      {{ $template->name }}
                  </option>
              @endforeach
          </x-select>
          <x-input-error :messages="$errors->get('template_id')" class="mt-2" />
      </div>

      <div>
          <x-input.checkbox id="track_click" name="track_click" autofocus value="1" :isCheckedWhen="old('track_click', $data['track_click'])" :label="__('Track Click')" />
          <x-input-error :messages="$errors->get('track_click')" class="mt-2" />
      </div>
      <div>
          <x-input.checkbox id="track_open" name="track_open" autofocus value="1" :isCheckedWhen="old('track_open', $data['track_open'])" :label="__('Track Open')" />
          <x-input-error :messages="$errors->get('track_open')" class="mt-2" />
      </div>
  </div>
