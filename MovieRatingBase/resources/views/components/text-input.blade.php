@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'font-inter font-medium border-gray-300 dark:border-gray-700 bg-sky-50 text-sky-950 dark:bg-sky-950 dark:text-sky-50 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}>
