<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-red-700 rounded-md content-center w-24 h-9 mr-2 text-sky-50 text-extrabold text-sm transition ease-in-out hover:bg-red-500']) }}>
    {{ $slot }}
</button>
