<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-sky-950 rounded-md text-sky-50 text-xs font-light h-8 px-2 ml-1 md:text-sm 2xl:text-base md:h-12 transition ease-in-out']) }}>
    {{ $slot }}
</button>
