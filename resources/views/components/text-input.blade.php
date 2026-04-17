@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-500/20 rounded-lg shadow-sm transition']) }}>
