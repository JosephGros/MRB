@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-inter font-medium text-sm text-sky-50 dark:text-sky-50']) }}>
    {{ $value ?? $slot }}
</label>
