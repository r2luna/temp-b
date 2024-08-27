  <div class="grid grid-cols-2 gap-4">

      <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-input.text id="name" class="block mt-1 w-full" name="name" :value="old('name')" autofocus />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>
      <div>
          <x-input-label for="subject" :value="__('Subject')" />
          <x-input.text id="subject" class="block mt-1 w-full" name="subject" :value="old('subject')" autofocus />
          <x-input-error :messages="$errors->get('subject')" class="mt-2" />
      </div>
      <div>
          <x-input-label for="email_list_id" :value="__('Email List')" />
          <x-input.text id="email_list_id" class="block mt-1 w-full" name="email_list_id" :value="old('email_list_id')" autofocus />
          <x-input-error :messages="$errors->get('email_list_id')" class="mt-2" />
      </div>
      <div>
          <x-input-label for="template_id" :value="__('Template')" />
          <x-input.text id="template_id" class="block mt-1 w-full" name="template_id" :value="old('template_id')" autofocus />
          <x-input-error :messages="$errors->get('template_id')" class="mt-2" />
      </div>
  </div>
