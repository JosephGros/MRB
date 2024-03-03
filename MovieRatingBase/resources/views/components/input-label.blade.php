@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium font-inter text-sm text-sky-950 dark:text-sky-50']) }}>
    {{ $value ?? $slot }}
</label>
