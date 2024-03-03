<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-sky-700 rounded-md content-center w-24 h-9 mr-2 text-sky-50 text-extrabold text-sm transition ease-in-out hover:bg-sky-500']) }}>
    {{ $slot }}
</button>
