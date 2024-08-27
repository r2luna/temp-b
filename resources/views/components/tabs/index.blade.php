@props(['tabs' => []])
<div class="w-full">
    <div class="flex gap-2 overflow-x-auto border-b border-slate-300 dark:border-slate-700">
        @foreach ($tabs as $title => $route)
            @php

                $selected = request()->getUri() == $route;
            @endphp
            <a @class([
                'h-min px-4 py-2 text-sm',
                'font-bold text-blue-700 border-b-2 border-blue-700 dark:border-blue-600 dark:text-blue-600' => $selected,
                'text-slate-700 font-medium dark:text-slate-300 dark:hover:border-b-slate-300 dark:hover:text-white hover:border-b-2 hover:border-b-slate-800 hover:text-black' => !$selected,
            ]) href="{{ $route }}">{{ $title }}</a>
        @endforeach

    </div>
    <div class="px-2 py-4 text-slate-700 dark:text-slate-300">
        {{ $slot }}
    </div>
</div>
