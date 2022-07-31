@props(['ahref' => false])
<{{ $ahref ? 'a' : 'button' }}
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 dark:bg-blue-500 dark:hover:bg-blue-700 dark:text-gray-800 dark:hover:text-gray-200']) }}>
    {{ $slot }}
    </{{ $ahref ? 'a' : 'button' }}>
