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
         <h1 class="font-bold text-center text-3xl text-yellow-400">Laporan Pengguna Terdaftar</h1>
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">
                     {{-- Table Template --}}
                     <div class="w-full mt-3 overflow-hidden rounded-lg shadow-xs">
                         <div class="w-full overflow-x-auto">
                             <table class="w-full whitespace-no-wrap">
                                 <thead>
                                     <tr
                                         class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50 ">
                                         <th class="px-4 py-3">Nama</th>
                                         {{-- <th class="px-4 py-3">Buku Dipinjam</th> --}}
                                         <th class="px-4 py-3">Role</th>
                                         <th class="px-4 py-3">Email</th>
                                         <th class="px-4 py-3">Terdaftar</th>
                                     </tr>
                                 </thead>
                                 <tbody class="bg-white divide-y ">
                                     @foreach ($users as $user)
                                         <tr class="text-gray-700 ">
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
                                                         <p class="text-xs text-gray-600 ">
                                                             {{-- 10x Developer --}}
                                                         </p>
                                                     </div>
                                                 </div>
                                             </td>
                                             {{-- <td class="px-4 py-3 text-sm">
                                                $ 863.45
                                            </td> --}}
                                             <td class="px-4 py-3 text-sm">
                                                 {{ $user->role->name }}
                                             </td>
                                             <td class="px-4 py-3 text-sm">
                                                 {{ $user->email }}
                                             </td>
                                             <td class="px-4 py-3 text-sm">
                                                 {{ $user->created_at }}
                                             </td>
                                             <td class="px-4 py-3 text-sm">

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
