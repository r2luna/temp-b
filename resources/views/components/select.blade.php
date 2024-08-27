<select
    {{ $attributes->class(['w-full appearance-none rounded-md border border-gray-300 bg-gray-100 px-4 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75 dark:border-gray-700 dark:bg-gray-900 dark:focus-visible:outline-blue-600']) }}>
    {{ $slot }}
</select>
