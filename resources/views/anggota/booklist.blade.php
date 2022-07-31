<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Buku Tersedia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" x-data="{ open: false }">
                    {{-- Scan Toogle --}}
                    <div x-show="open" id="reader" width="500px"></div>
                    <x-button x-on:click="open = ! open">Cari
                        dengan QRCODE</x-button>
                    <form action="{{ route('anggota.booklist') }}" class="mb-4">
                        <x-input id="search" class="mt-1 w-3/4 md:w-1/2" type="text" name="search"
                            placeholder="Masukan Kata Kunci Pencarian..." value="{{ request('search') }}" />
                        <x-button class="mb-3 font-bold">Cari </x-button>
                    </form>
                    {{-- Status --}}
                    @if (session('status') || session('delete'))
                        <x-session-message></x-session-message>
                    @endif
                    {{-- Grid --}}
                    <div class="grid gap-6 mb-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        {{-- Looping --}}
                        @forelse ($books as $book)
                            @if ($loop->iteration % 3 == 0)
                                <x-book-card3 :book="$book"></x-book-card3>
                            @elseif(in_array($loop->iteration, [2, 5, 8, 11]))
                                <x-book-card2 :book="$book"></x-book-card2>
                            @else
                                <x-book-card1 :book="$book"></x-book-card1>
                            @endif
                        @empty
                            <div class="col-span-2">
                                <h1 class="col-span-3 text-red-600 text-center text-xl font-bold">
                                    Buku dengan judul tersebut tidak ditemukan
                                </h1>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scan Barcode --}}
    <script type="module">
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            window.location.href = "{{ URL::current() }}?search=" + decodedText;
            //console.log(`Code matched = ${decodedText}`, decodedResult);
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        let config = {
            fps: 10,
            qrbox: {
                width: 700,
                height: 700
            },
            rememberLastUsedCamera: true,
            formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE],
            // Only support camera scan type.
            supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_FILE, Html5QrcodeScanType.SCAN_TYPE_CAMERA]
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", config,
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</x-app-layout>
