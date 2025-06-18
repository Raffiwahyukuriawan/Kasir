<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <div>
        <div class="content">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
                    <!-- BEGIN: General Report -->
                    <div class="col-span-12 mt-8">
                        <div class="intro-y flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                General Report
                            </h2>
                            <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw"
                                    class="w-4 h-4 mr-3"></i> Reload Data </a>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="credit-card" class="report-box__icon text-theme-10"></i>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6">Rp.
                                            {{ number_format($salesTodays), 0, ',', '.' }}</div>
                                        <div class="text-base text-gray-600 mt-1">Penjualan Hari Ini</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="calendar" class="report-box__icon text-theme-11"></i>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6">Rp.
                                            {{ number_format($salesThisMonth), 0, ',', '.' }}</div>
                                        <div class="text-base text-gray-600 mt-1">Penjualan Bulan Ini</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="bar-chart" class="report-box__icon text-theme-12"></i>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6">Rp.
                                            {{ number_format($salesThisMonth), 0, ',', '.' }}</div>
                                        <div class="text-base text-gray-600 mt-1">Penjualan Tahun Ini</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="box" class="report-box__icon text-theme-9"></i>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6">
                                            {{ $bestSellingProduct->total_sold ?? 0 }} Terjual</div>
                                        <div class="text-base text-gray-600 mt-1">Produk Terlaris</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: General Report -->
                    <!-- BEGIN: Sales Report -->
                    <div class="col-span-12 lg:col-span-6 mt-8">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Laporan Penjualan Bulanan
                            </h2>
                            <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700">
                                <i data-feather="calendar"
                                    class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                                <input type="text" data-daterange="true"
                                    class="datepicker input w-full sm:w-56 box pl-10" style="pointer-events: none">
                            </div>
                        </div>
                        <div class="intro-y box p-5 mt-12 sm:mt-5">
                            <div class="flex flex-col xl:flex-row xl:items-center">
                                <div class="flex">
                                    <div>
                                        <div class="text-gray-600 text-lg xl:text-xl font-medium last-month">$0</div>
                                        <div class="text-gray-600">Bulan lalu</div>
                                    </div>
                                    <div class="w-px h-12 border border-r border-dashed border-gray-300 mx-4 xl:mx-6">
                                    </div>
                                    <div>
                                        <div class="text-theme-20 text-lg xl:text-xl font-bold this-month">$0</div>
                                        <div class="text-gray-600">Bulan ini</div>
                                    </div>
                                </div>
                                <div class="dropdown relative xl:ml-auto mt-5 xl:mt-0">

                                </div>
                            </div>
                            <div class="overflow-x-auto overflow-y-auto max-h-[400px]">
                                <canvas id="myChart" height="160" class="mt-6"></canvas>
                            </div>

                        </div>
                    </div>
                    <!-- END: Sales Report -->
                    <!-- BEGIN: Weekly Top Seller -->
                    <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                        <div class="intro-y flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Laporan Produk Terlaris
                            </h2>
                        </div>
                        <div class="mt-5">
                            <div class="intro-y">
                                @foreach ($listProduk as $produk)
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                            <img alt="Midone Tailwind HTML Admin Template"
                                                src="/dist/images/profile-6.jpg">
                                        </div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">{{ $produk->nama_produk }}</div>
                                            <div class="text-gray-600 text-xs">{{ $produk->created_at }}</div>
                                        </div>
                                        <div
                                            class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">
                                            {{ $produk->total_sold }} Sales</div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                        <div class="intro-y flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Laporan Transaksi Hari Ini
                            </h2>
                        </div>
                        <div class="mt-5">
                            <div class="intro-y">
                                @foreach ($transaksis as $transaksi)
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                            <img alt="Midone Tailwind HTML Admin Template"
                                                src="/dist/images/profile-6.jpg">
                                        </div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">{{ $transaksi->no_nota }}</div>
                                            <div class="text-gray-600 text-xs">{{ $transaksi->created_at }}</div>
                                        </div>
                                        <div
                                            class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">
                                            Rp.{{ number_format($transaksi->total_harga), 0, ',', '.' }}</div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <!-- END: Weekly Top Seller -->

                    <!-- chart tahunan -->
                    <div class="col-span-12 lg:col-span-6 mt-8">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Laporan Penjualan Tahunan
                            </h2>
                            <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700">
                                <i data-feather="calendar"
                                    class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                                <input type="text" data-daterange="true"
                                    class="datepicker input w-full sm:w-56 box pl-10" style="pointer-events: none">
                            </div>
                        </div>

                        <div class="intro-y box p-5 mt-12 sm:mt-5">
                            <div class="flex flex-col xl:flex-row xl:items-center">
                                <div class="flex">
                                    <div>
                                        <!-- Total penjualan tahun lalu -->
                                        <div class="text-gray-600 text-lg xl:text-xl font-medium last-year">Rp. 0</div>
                                        <div class="text-gray-600">Tahun Lalu</div>
                                    </div>
                                    <div class="w-px h-12 border border-r border-dashed border-gray-300 mx-4 xl:mx-6">
                                    </div>
                                    <div>
                                        <!-- Total penjualan tahun ini -->
                                        <div class="text-theme-20 text-lg xl:text-xl font-bold this-year">Rp. 0</div>
                                        <div class="text-gray-600">Tahun Ini</div>
                                    </div>
                                </div>
                                <div class="dropdown relative xl:ml-auto mt-5 xl:mt-0"></div>
                            </div>

                            <!-- Grafik penjualan tahunan -->
                            <div class="overflow-x-auto overflow-y-auto max-h-[400px]">
                                <canvas id="myChartYear" height="160" class="mt-6"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- stok tersedikit --}}
                    <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                        <div class="intro-y flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Laporan Stok Tersedikit
                            </h2>
                        </div>
                        <div class="mt-5">
                            <div class="intro-y">
                                @foreach ($stok_produks as $stok)
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                            <img alt="Midone Tailwind HTML Admin Template"
                                                src="/dist/images/profile-6.jpg">
                                        </div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">{{ $stok->nama_produk }}</div>
                                            <div class="text-gray-600 text-xs">{{ $stok->barcode }}</div>
                                        </div>
                                        <div
                                            class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">
                                            {{ $stok->stok }} Stok</div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    {{-- daftar transaksi --}}
                    <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                        <div class="intro-y flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Daftar Pengelola Toko
                            </h2>
                        </div>
                        <div class="mt-5">
                            <div class="intro-y">
                                @foreach ($pengguna as $data)
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                            <img alt="Midone Tailwind HTML Admin Template"
                                                src="/dist/images/profile-6.jpg">
                                        </div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">{{ $data->nama }}</div>
                                            <div class="text-gray-600 text-xs">{{ $data->no_telp }}</div>
                                        </div>
                                        <div
                                            class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">
                                            {{ $data->role }}</div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    {{-- chart harian --}}
                    <div class="col-span-12 lg:col-span-6 mt-8">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Laporan Penjualan Harian
                            </h2>
                            <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700">
                                <i data-feather="calendar"
                                    class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                                <input type="text" data-daterange="true"
                                    class="datepicker input w-full sm:w-56 box pl-10" style="pointer-events: none">
                            </div>
                        </div>

                        <div class="intro-y box p-5 mt-12 sm:mt-5">
                            <div class="flex flex-col xl:flex-row xl:items-center">
                                <div class="flex">
                                    <div>
                                        <!-- Total penjualan tahun lalu -->
                                        <div class="text-gray-600 text-lg xl:text-xl font-medium last-year">Rp. 0</div>
                                        <div class="text-gray-600">Kemarin</div>
                                    </div>
                                    <div class="w-px h-12 border border-r border-dashed border-gray-300 mx-4 xl:mx-6">
                                    </div>
                                    <div>
                                        <!-- Total penjualan tahun ini -->
                                        <div class="text-theme-20 text-lg xl:text-xl font-bold this-year">Rp. 0</div>
                                        <div class="text-gray-600">Hari Ini</div>
                                    </div>
                                </div>
                                <div class="dropdown relative xl:ml-auto mt-5 xl:mt-0"></div>
                            </div>

                            <!-- Grafik penjualan tahunan -->
                            <div class="overflow-x-auto overflow-y-auto max-h-[400px]">
                                <canvas id="myChartDaily" height="160" class="mt-6"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- stok terbanyak --}}
                    <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                        <div class="intro-y flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Laporan Stok Terbanyak
                            </h2>
                        </div>
                        <div class="mt-5">
                            <div class="intro-y">
                                @foreach ($produk_terbanyak as $stok)
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                            <img alt="Midone Tailwind HTML Admin Template"
                                                src="/dist/images/profile-6.jpg">
                                        </div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">{{ $stok->nama_produk }}</div>
                                            <div class="text-gray-600 text-xs">{{ $stok->barcode }}</div>
                                        </div>
                                        <div
                                            class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">
                                            {{ $stok->stok }} Stok</div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                        <div class="intro-y flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Kasir Yang Melakukan Trasaksi
                            </h2>
                        </div>
                        <div class="mt-5">
                            <div class="intro-y">
                                @foreach ($transaksi_kasir as $transaksi)
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                            <img alt="Midone Tailwind HTML Admin Template"
                                                src="/dist/images/profile-6.jpg">
                                        </div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">{{ $transaksi->nama_kasir }}</div>
                                            <div class="text-gray-600 text-xs">{{ $transaksi->created_at }}</div>
                                        </div>
                                        <div
                                            class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">
                                            {{ $transaksi->total_transaksi }} Transaksi</div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <!-- END: Official Store -->

                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $.ajax({
            url: "{{ route('manager.chart.data') }}",
            method: 'GET',
            success: function(response) {
                console.log(response); // Debugging: Pastikan data masuk

                let months = response.map(item => `Bulan ${item.month}`);
                let totals = response.map(item => parseFloat(item.total_harga) || 0);

                // Ambil bulan ini & bulan lalu dari response
                let thisMonth = new Date().getMonth() + 1; // Bulan saat ini (1-12)
                let lastMonth = thisMonth - 1; // Bulan sebelumnya

                let thisMonthData = response.find(item => item.month == thisMonth);
                let lastMonthData = response.find(item => item.month == lastMonth);

                let thisMonthTotal = thisMonthData ? thisMonthData.total_harga : 0;
                let lastMonthTotal = lastMonthData ? lastMonthData.total_harga : 0;

                // Masukkan nilai ke dalam elemen HTML
                $(".this-month").text(`Rp. ${parseInt(thisMonthTotal).toLocaleString()}`);
                $(".last-month").text(`Rp. ${parseInt(lastMonthTotal).toLocaleString()}`);

                // Warna biru segar
                let freshBlue = 'rgba(30, 144, 255, 0.7)'; // DodgerBlue
                let freshBlueBorder = 'rgba(30, 144, 255, 1)';

                // Tampilkan Grafik
                let ctx = document.getElementById('myChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Total Penjualan',
                            data: totals,
                            backgroundColor: freshBlue,
                            borderColor: freshBlueBorder,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp. ' + value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error mengambil data:", error);
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    {{-- bulanan --}}
    <script>
        $(document).ready(function() {
            // Ambil tanggal awal (bulan lalu) dan tanggal akhir (bulan ini)
            let startDate = moment().subtract(1, 'months').startOf('month').format('YYYY-MM-DD');
            let endDate = moment().endOf('month').format('YYYY-MM-DD');

            // Set default value pada input datepicker
            $('.datepicker').val(startDate + ' - ' + endDate);

            // Inisialisasi datepicker (sesuaikan jika pakai plugin lain)
            $('.datepicker').daterangepicker({
                startDate: startDate,
                endDate: endDate,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
        });
    </script>

    {{-- tahunan --}}
    <script>
        $.ajax({
            url: "{{ route('manager.chart.data.year') }}", // Ambil data tahunan
            method: 'GET',
            success: function(response) {
                console.log(response); // Debugging: Pastikan data masuk

                // Pastikan response.data adalah array
                if (!response.data || !Array.isArray(response.data)) {
                    console.error("Data tidak valid:", response);
                    return;
                }

                // Ubah untuk tahun
                let years = response.data.map(item => item.year);
                let totals = response.data.map(item => parseFloat(item.total_harga) || 0);

                // Ambil tahun ini & tahun lalu dari response
                let thisYear = new Date().getFullYear(); // Tahun saat ini
                let lastYear = thisYear - 1; // Tahun sebelumnya

                let thisYearData = response.data.find(item => item.year == thisYear);
                let lastYearData = response.data.find(item => item.year == lastYear);

                let thisYearTotal = thisYearData ? thisYearData.total_harga : 0;
                let lastYearTotal = lastYearData ? lastYearData.total_harga : 0;

                // Masukkan nilai ke dalam elemen HTML
                $(".this-year").text(`Rp. ${parseInt(thisYearTotal).toLocaleString()}`);
                $(".last-year").text(`Rp. ${parseInt(lastYearTotal).toLocaleString()}`);

                // Periksa apakah elemen canvas ada
                let canvas = document.getElementById('myChartYear');
                if (!canvas) {
                    console.error("Elemen canvas myChartYear tidak ditemukan.");
                    return;
                }

                // Warna biru segar untuk batang grafik
                let colors = [
                    'rgba(54, 162, 235, 0.7)', // Biru segar 1
                    'rgba(0, 123, 255, 0.7)', // Biru segar 2
                    'rgba(0, 153, 255, 0.7)', // Biru segar 3
                    'rgba(51, 102, 204, 0.7)', // Biru segar 4
                    'rgba(102, 178, 255, 0.7)', // Biru segar 5
                ];

                let borderColors = colors.map(color => color.replace('0.7', '1')); // Ubah transparansi border

                let ctx = canvas.getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: years,
                        datasets: [{
                            label: 'Total Penjualan Tahunan',
                            data: totals,
                            backgroundColor: colors.slice(0, totals
                            .length), // Ambil warna sesuai jumlah data
                            borderColor: borderColors.slice(0, totals.length),
                            borderWidth: 1,
                            maxBarThickness: 50 // Maksimum ketebalan batang
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp. ' + value.toLocaleString();
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let value = context.raw || 0;
                                        return `Rp. ${value.toLocaleString()}`;
                                    }
                                }
                            }
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error mengambil data:", error);
            }
        });
    </script>

    {{-- harian --}}
    <script>
        $.ajax({
            url: "{{ route('manager.chart.data.daily') }}", // Ganti URL ke data harian
            method: 'GET',
            success: function(response) {
                console.log(response); // Debugging: Pastikan data masuk

                // Pastikan response berupa array
                if (!response || !Array.isArray(response)) {
                    console.error("Data tidak valid:", response);
                    return;
                }

                // Ambil tanggal & total harga dari response
                let dates = response.map(item => item.date);
                let totals = response.map(item => parseFloat(item.total_harga) || 0);

                // Pastikan ada maksimal 30 batang, kalau lebih buang yang lama
                if (dates.length > 30) {
                    dates = dates.slice(-30);
                    totals = totals.slice(-30);
                }

                // Masukkan nilai total bulan ini ke dalam elemen HTML
                let thisMonthTotal = totals.reduce((a, b) => a + b, 0);
                $(".this-month").text(`Rp. ${parseInt(thisMonthTotal).toLocaleString()}`);

                // Periksa apakah elemen canvas ada
                let canvas = document.getElementById('myChartDaily');
                if (!canvas) {
                    console.error("Elemen canvas myChartDaily tidak ditemukan.");
                    return;
                }

                // Warna biru segar untuk batang grafik
                let colors = [
                    'rgba(54, 162, 235, 0.7)', // Biru segar 1
                    'rgba(0, 123, 255, 0.7)', // Biru segar 2
                    'rgba(0, 153, 255, 0.7)', // Biru segar 3
                    'rgba(51, 102, 204, 0.7)', // Biru segar 4
                    'rgba(102, 178, 255, 0.7)', // Biru segar 5
                ];

                let backgroundColors = [];
                let borderColors = [];

                for (let i = 0; i < totals.length; i++) {
                    let colorIndex = i % colors.length;
                    backgroundColors.push(colors[colorIndex]);
                    borderColors.push(colors[colorIndex].replace('0.7', '1')); // Border lebih tajam
                }

                let ctx = canvas.getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: dates, // Gunakan tanggal sebagai label
                        datasets: [{
                            label: 'Total Penjualan Harian',
                            data: totals,
                            backgroundColor: backgroundColors,
                            borderColor: borderColors,
                            borderWidth: 1,
                            maxBarThickness: 20 // Batasi ukuran batang
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp. ' + value.toLocaleString();
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let value = context.raw || 0;
                                        return `Rp. ${value.toLocaleString()}`;
                                    }
                                }
                            }
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error mengambil data:", error);
            }
        });
    </script>



</x-layout>
