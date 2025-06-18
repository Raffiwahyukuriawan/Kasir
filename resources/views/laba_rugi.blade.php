<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <div>
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div>
                <!-- END: Top Bar -->
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                        <a class="button text-white bg-theme-1 shadow-md mr-2"
                            href="{{ route('keuangan') }}">Pendapatan</a>
                        <a class="button text-white bg-theme-1 shadow-md mr-2" href="{{ route('pengeluaran') }}">
                            Pengeluaran</a>
                        <a class="button text-white bg-theme-1 shadow-md mr-2" href="{{ route('laba.rugi') }}" ">Laba Rugi</a>
                        <a class="button text-white bg-theme-1 shadow-md mr-2" href="{{ route('arus.kas') }}"
                        >PDF</a>
                </div>
            </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <canvas id="keuanganChart"></canvas>
        </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ url('/api/laba-rugi') }}")
                .then(response => response.json())
                .then(data => {
                    let labels = data.map(item => item.bulan);
                    let pendapatan = data.map(item => item.total_pendapatan);
                    let pengeluaran = data.map(item => item.total_pengeluaran);
                    let labaRugi = data.map(item => item.laba_rugi);

                    let ctx = document.getElementById('keuanganChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                    label: 'Pendapatan',
                                    data: pendapatan,
                                    backgroundColor: 'green'
                                },
                                {
                                    label: 'Pengeluaran',
                                    data: pengeluaran,
                                    backgroundColor: 'red'
                                },
                                {
                                    label: 'Laba/Rugi',
                                    data: labaRugi,
                                    backgroundColor: 'blue'
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return 'Rp ' + value.toLocaleString();
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector("[data-target='#tambah']").addEventListener("click", function() {
                document.getElementById("tambah").classList.add("active");
            });
        });
    </script>

    {{-- delete pembelian --}}
    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                // Ambil id_user dari atribut data-id_user
                const no_pembelian = this.getAttribute('data-id');
                if (!no_pembelian) {
                    console.error('ID user tidak ditemukan!');
                    return;
                }
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim request delete menggunakan form
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action =
                            `/pembelian/delete/${no_pembelian}`; // Gunakan id_user dalam URL

                        const csrfField = document.createElement('input');
                        csrfField.type = 'hidden';
                        csrfField.name = '_token';
                        csrfField.value = `{{ csrf_token() }}`;

                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';

                        form.appendChild(csrfField);
                        form.appendChild(methodField);

                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
    {{-- end delete kategori --}}

    {{-- search --}}
    <script>
        document.getElementById('search-kategori').addEventListener('keyup', function() {
            const keyword = this.value;

            fetch(`/kategori/search?keyword=${keyword}`)
                .then(response => response.json())
                .then(kategories => {
                    const tbody = document.querySelector('#data-table tbody');
                    tbody.innerHTML = ''; // Kosongkan tabel

                    if (kategories.length === 0) {
                        tbody.innerHTML = `<tr><td colspan="7" class="text-center">No data found</td></tr>`;
                    } else {
                        kategories.forEach((kategori, index) => {
                            const row = `
                        <tr class="intro-x">
                            <td>${index + 1}</td>
                            <td class="">${kategori.kategori}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3 edit-button" data-toggle="modal" data-target="#modal-edit${kategori.id}" data-id="${kategori.id}"><i
                                                        class="fa-duotone fa-regular fa-pen-to-square"></i>  Edit </a>
                                    <a class="flex items-center text-theme-6 delete-button" data-id="${kategori.id}"><i
                                                        class="fa-regular fa-trash-can"></i> Delete </a>
                                </div>
                            </td>
                        </tr>`;
                            tbody.insertAdjacentHTML('beforeend', row);
                        });
                        attachEventListeners();
                    }
                })
                .catch(error => console.error('Error:', error));

            function attachEventListeners() {
                // Event listener untuk tombol Edit
                document.querySelectorAll('.edit-button').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        console.log(`Edit kategori dengan ID: ${id}`);
                        // Logika untuk membuka modal edit bisa ditambahkan di sini
                    });
                });

                // Event listener untuk tombol Delete
                document.querySelectorAll('.delete-button').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        Swal.fire({
                            title: 'Yakin ingin menghapus?',
                            text: "Data yang dihapus tidak dapat dikembalikan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Kirim request delete
                                const form = document.createElement('form');
                                form.method = 'POST';
                                form.action =
                                    `/kategori/${id}`; // Pastikan URL untuk delete sesuai

                                const csrfField = document.createElement('input');
                                csrfField.type = 'hidden';
                                csrfField.name = '_token';
                                csrfField.value = `{{ csrf_token() }}`;

                                const methodField = document.createElement('input');
                                methodField.type = 'hidden';
                                methodField.name = '_method';
                                methodField.value = 'DELETE';

                                form.appendChild(csrfField);
                                form.appendChild(methodField);
                                document.body.appendChild(form);
                                form.submit();
                            }
                        });
                    });
                });
            }
        });
    </script>
    {{-- end search --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("[data-toggle='modal']").forEach(btn => {
                btn.addEventListener("click", function() {
                    setTimeout(() => {
                        feather.replace();
                    }, 200); // Tunggu sebentar agar modal sudah terbuka
                });
            });
        });
    </script>
    <script src="/dist/js/app.js"></script>

</x-layout>
