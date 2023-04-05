 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Fonts -->
     {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

     <!-- Styles -->
     <link rel="stylesheet" href="{{ asset('css/app.css') }}">

     <!-- Scripts -->
     <script src="{{ asset('js/app.js') }}" defer></script>
 </head>

 <body>
     <div class="py-12">
         <h1 class="font-bold text-center text-3xl">Laporan Buku dan Stok</h1>
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">
                     {{-- Table Template --}}
                     @if (session())
                         <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)">
                             <div class="text-green-500 font-bold mb-4">{{ session('status') }}</div>
                             <div class="text-red-500 font-bold mb-4">{{ session('delete') }}</div>
                         </div>
                     @endif
                     <div class="w-full mt-3 overflow-hidden rounded-lg shadow-xs">
                         <div class="w-full overflow-x-auto">
                             <table class="w-full whitespace-no-wrap">
                                 <thead>
                                     <tr
                                         class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50 ">
                                         <th class="px-4 py-3">Judul</th>
                                         <th class="px-4 py-3">Penulis</th>
                                         <th class="px-4 py-3">Penerbit</th>
                                         <th class="px-4 py-3">Tahun Terbit</th>
                                         <th class="px-4 py-3">Stok</th>
                                         <th class="px-4 py-3">QRCODE</th>
                                     </tr>
                                 </thead>
                                 <tbody class="bg-white divide-y ">
                                     @foreach ($books as $book)
                                         <tr class="text-gray-700 ">
                                             <td class="px-4 py-3">
                                                 <div class="flex items-center text-sm">
                                                     <div>
                                                         <p class="font-semibold">{{ $book->title }}</p>
                                                         <p class="text-xs text-gray-600 ">
                                                         </p>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td class="px-4 py-3 text-sm">
                                                 {{ $book->author }}
                                             </td>
                                             <td class="px-4 py-3 text-sm">
                                                 {{ $book->publisher }}
                                             </td>
                                             <td class="px-4 py-3 text-sm">
                                                 {{ $book->year }}
                                             </td>
                                             <td class="px-4 py-3 text-sm">
                                                 {{ $book->stock }}
                                             </td>
                                             <td class="px-4 py-3 text-sm">
                                                 <img src="data:image/png;base64, {!! createQRCodeBook($book->title) !!}">
                                             </td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </body>

 </html>
