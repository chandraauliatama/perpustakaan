<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aturan Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('status'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)">
                            <div class="text-green-500 font-bold mb-4">{{ session('status') }}</div>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('pimpinan.storeLendingRules') }}">
                        @csrf

                        @if ($errors->any())
                            <div class="text-red-500">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Nama Lengkap -->
                        <div>
                            <x-label for="day_limit" :value="__('Batas Hari Peminjaman')" />

                            <x-input id="day_limit" class="block mt-1 w-full" type="number" name="day_limit"
                                :value="$rules->day_limit" required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="fine" :value="__('Denda(Rupiah)')" />

                            <x-input id="fine" class="block mt-1 w-full" type="number" name="fine"
                                :value="$rules->fine" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Ubah Aturan') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
