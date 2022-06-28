<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-auth-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <div>
            <div class="p-6 bg-white border-b border-gray-200 text-center">
                <h1 class="font-bold text-blue-500">{{ __('Harap Masuk Terlebih Dahulu') }}</h1>
                <div class="mt-10 justify-center">
                    <a href="{{ route('login') }}"
                        class="w-full mb-6 inline-flex justify-center items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Login') }}</a>
                    <a href="{{ route('register') }}"
                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Register') }}</a>
                </div>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
