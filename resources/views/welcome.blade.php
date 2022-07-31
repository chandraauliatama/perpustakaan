<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-auth-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <div>
            <div class="p-6 bg-white border-b border-gray-200 text-center dark:bg-gray-800">
                <h1 class="font-bold text-blue-500 dark:text-blue-400">{{ __('Harap Masuk Terlebih Dahulu') }}</h1>
                <div class="mt-10 justify-center">
                    <x-button ahref href="{{ route('login') }}" class="w-full mb-6 justify-center">{{ __('Masuk') }}
                    </x-button>
                    <x-button ahref href="{{ route('register') }}" class="w-full mb-6 justify-center">
                        {{ __('Registrasi') }}
                    </x-button>
                </div>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
