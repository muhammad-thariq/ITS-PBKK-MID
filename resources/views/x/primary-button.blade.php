<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 text-black bg-white border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-black hover:text-white  hover:outline-none hover:ring-2 hover:ring-white hover:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
