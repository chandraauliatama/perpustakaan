<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 grid place-items-center">
                    {{-- Statistik --}}
                    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs ">
                            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full 0">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 ">
                                    Total Pengguna
                                </p>
                                <p class="text-lg font-semibold text-gray-700 ">
                                    {{ $totalUsers }}
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs ">
                            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 ">
                                    Pengguna Baru Bulan Ini
                                </p>
                                <p class="text-lg font-semibold text-gray-700 ">
                                    {{ $newUserThisWeek }}
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs ">
                            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 ">
                                    Total Buku
                                </p>
                                <p class="text-lg font-semibold text-gray-700 ">
                                    {{ $totalBooks }}
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs ">
                            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                                    <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 ">
                                    Total Buku Dipinjam
                                </p>
                                <p class="text-lg font-semibold text-gray-700 ">
                                    {{ $borrowedBooks }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Chart --}}
                    <div class="w-17 sm:w-1/3 p-4 bg-white rounded-lg shadow-xs ">
                        <h4 class="mb-4 font-semibold text-gray-800 ">
                            Statistik Pengguna
                        </h4>
                        <canvas id="myChart"></canvas>
                        <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 ">
                            <!-- Chart legend -->
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 bg-teal-500 rounded-full"></span>
                                <span>Admin</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 bg-blue-600 rounded-full"></span>
                                <span>Pimpinan</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                                <span>Operator</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 bg-yellow-400 rounded-full"></span>
                                <span>Anggota</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Chart Script --}}
    <script type="module">
        /**
         * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
         */
        const pieConfig = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [{{ "$admin, $pimpinan, $operator, $anggota" }}],
                    /**
                     * These colors come from Tailwind CSS palette
                     * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
                     */
                    backgroundColor: ['#0694a2', '#1c64f2', '#7e3af2', '#FFD700'],
                    label: 'Dataset 1',
                }, ],
                //labels: ['Shoes', 'Shirts', 'Bags'],
            },
            options: {
                responsive: true,
                cutoutPercentage: 80,
                animation: {
                    animateRotate: true,
                    loop: true,
                    duration: 2700
                },
                /**
                 * Default legends are ugly and impossible to style.
                 * See examples in charts.html to add your own legends
                 *  */
                legend: {
                    display: false,
                },
            },
        }

        // change this to the id of your chart element in HMTL
        const pieCtx = document.getElementById('myChart')
        window.myPie = new Chart(pieCtx, pieConfig)
    </script>
</x-app-layout>
