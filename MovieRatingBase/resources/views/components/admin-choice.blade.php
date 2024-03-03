<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-sky-700 rounded-md content-center w-40 h-12 m-2 text-sky-50 text-extrabold text-lg transition ease-in-out hover:bg-sky-500']) }}>
    {{ $slot }}
</button>
