@props(['id'])

<div class="flex items-center justify-start gap-2 font-medium text-slate-700 has-[:disabled]:opacity-75 dark:text-slate-300">
    <input id="{{ $id }}" type="radio"
        class="before:content[''] relative h-4 w-4 appearance-none rounded-full border border-slate-300 bg-slate-100 before:invisible before:absolute before:left-1/2 before:top-1/2 before:h-1.5 before:w-1.5 before:-translate-x-1/2 before:-translate-y-1/2 before:rounded-full before:bg-slate-100 checked:border-blue-700 checked:bg-blue-700 checked:before:visible focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-slate-800 checked:focus:outline-blue-700 disabled:cursor-not-allowed dark:border-slate-700 dark:bg-slate-800 dark:before:bg-slate-100 dark:checked:border-blue-600 dark:checked:bg-blue-600 dark:focus:outline-slate-300 dark:checked:focus:outline-blue-600"
        {{ $attributes }}>
    <label for="{{ $id }}" class="text-sm">{{ $slot }}</label>
</div>
