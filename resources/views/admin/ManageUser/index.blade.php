<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Kelola User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="border-b border-gray-200 bg-white p-6 dark:border-black dark:bg-gray-800">
                    <x-button ahref href="{{ route('admin.user.create') }}">{{ __('+ Buat User') }}</x-button>
                    <x-button ahref href="{{ route('admin.printAllUsers') }}" target="_blank">{{ __('Cetak PDF') }}
                    </x-button>
                    <form action="{{ route('admin.user.index') }}">
                        <x-input id="search" class="mt-1 w-1/2" type="text" name="search"
                            placeholder="Masukan Nama" :value="request('search')" />
                        <x-button class="mb-3 font-bold">Cari </x-button>
                    </form>
                    {{-- Table Template --}}
                    @if (session('status') || session('delete'))
                        <x-session-message></x-session-message>
                    @endif
                    <div class="shadow-xs mt-3 w-full overflow-hidden rounded-lg">
                        <div class="w-full overflow-x-auto">
                            <table class="whitespace-no-wrap w-full">
                                <thead>
                                    <tr
                                        class="border-b bg-gray-50 text-left text-xs font-bold uppercase tracking-wide text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                        <th class="px-4 py-3">Nama</th>
                                        {{-- <th class="px-4 py-3">Buku Dipinjam</th> --}}
                                        <th class="px-4 py-3">Role</th>
                                        <th class="px-4 py-3">Email</th>
                                        <th class="px-4 py-3">Terdaftar</th>
                                        <th class="px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y bg-white dark:bg-gray-800">
                                    @forelse ($users as $user)
                                        <tr class="text-gray-700 dark:border-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <!-- Avatar with inset shadow -->
                                                    {{-- <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                    <img class="object-cover w-full h-full rounded-full"
                                                        src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=200&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                                                        alt="" loading="lazy">
                                                    <div class="absolute inset-0 rounded-full shadow-inner"
                                                        aria-hidden="true"></div>
                                                </div> --}}
                                                    <div>
                                                        <p class="font-semibold">{{ $user->name }}</p>
                                                        <p class="text-xs text-gray-600">
                                                            {{-- 10x Developer --}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td class="px-4 py-3 text-sm">
                                                $ 863.45
                                            </td> --}}
                                            <td class="px-4 py-3 text-xs">
                                                @php
                                                    if ($user->role_id == 1) {
                                                        $color = 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100';
                                                    } elseif ($user->role_id == 2) {
                                                        $color = 'text-red-700 bg-red-100 dark:text-red-100 dark:bg-red-700';
                                                    } elseif ($user->role_id == 3) {
                                                        $color = 'text-orange-700 bg-orange-100 dark:text-white dark:bg-orange-600';
                                                    } else {
                                                        $color = 'text-gray-700 bg-gray-100 dark:text-gray-100 dark:bg-gray-700';
                                                    }
                                                @endphp
                                                <span
                                                    class="{{ $color }} rounded-full px-2 py-1 font-semibold leading-tight">
                                                    {{ $user->role->name }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $user->created_at }}
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center space-x-4 text-sm">
                                                    <form action="{{ route('admin.user.edit', $user) }}"
                                                        method="get">
                                                        <button
                                                            class="focus:shadow-outline-gray flex items-center justify-between rounded-lg px-2 py-2 text-sm font-medium leading-5 text-purple-600 hover:text-purple-900 focus:outline-none"
                                                            aria-label="Edit">
                                                            <svg class="h-5 w-5" aria-hidden="true" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path
                                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.user.destroy', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="focus:shadow-outline-gray flex items-center justify-between rounded-lg px-2 py-2 text-sm font-medium leading-5 text-red-600 hover:text-red-900 focus:outline-none"
                                                            aria-label="Delete">
                                                            <svg class="h-5 w-5" aria-hidden="true" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <h1 class="text-lg font-bold text-red-700"> Data tidak ditemukan</h1>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
