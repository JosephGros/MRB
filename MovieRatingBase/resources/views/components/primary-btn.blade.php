<button {{ $attributes->merge(['type' => 'submit', 'class' => 'rounded-md text-sky-50 text-xs font-light bg-sky-950 h-10 w-[140px] px-2 md:h-16 md:text-base md:bg-sky-700 transition ease-in-out duration-150 tracking-widest']) }}>
    {{ $slot }}
</button>
