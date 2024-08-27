      <div>
          <x-input.richtext name="body" :value="old('body')" />
          <x-input-error :messages="$errors->get('body')" class="mt-2" />
      </div>
