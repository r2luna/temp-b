@props(['secondary' => null])

<a
    {{ $attributes->class([
        'inline-flex items-center px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150',
        'bg-gray-800 dark:bg-gray-200 border-transparent text-white dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:ring-indigo-500 ' => !$secondary,
        'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-500 text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-indigo-500 disabled:opacity-25 ' => $secondary,
    ]) }}>
    {{ $slot }}
</a>
