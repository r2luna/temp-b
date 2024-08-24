@props([
    'danger' => null,
])

<button
    {{ $attributes
        ->merge(['type' => 'button'])
        ->class([
            'inline-flex items-center px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150',
            'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-500 text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-indigo-500 disabled:opacity-25 ' => !$danger,
             'bg-white dark:bg-gray-800 border-red-300 dark:border-red-500 text-red-700 dark:text-red-300 shadow-sm hover:bg-red-50 dark:hover:bg-gray-700 focus:ring-red-500 disabled:opacity-25 ' => $danger,
        ]),
     }}>
    {{ $slot }}
</button>
