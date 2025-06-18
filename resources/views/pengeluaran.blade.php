<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <div>
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div>
                <!-- END: Top Bar -->
                @if (session('status') === 'success')
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-3 bg-theme-1 text-white alert-box">
                        <i data-feather="smile" class="w-6 h-6 mr-2"></i>
                        {{ session('message') }}
                        <i data-feather="x" class="w-4 h-4 ml-auto close-alert" style="cursor: pointer;"></i>
                    </div>
                @elseif (session('status') === 'error')
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-3 bg-theme-6 text-white alert-box">
                        <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i>
                        {{ session('message') }}
                        <i data-feather="x" class="w-4 h-4 ml-auto close-alert" style="cursor: pointer;"></i>
                    </div>
                @endif
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                        <a class="button text-white bg-theme-1 shadow-md mr-2"
                            href="{{ route('pengeluaran') }}">Pendapatan</a>
                        <a class="button text-white bg-theme-1 shadow-md mr-2" href="javascript:;" data-toggle="modal"
                            data-target="#tambah">Tambah Pengeluaran</a>
                        {{-- Modal --}}
                        <div class="modal" id="tambah">
                            <div class="modal__content p-10 text-center">
                                <!-- Header Modal -->
                                <form class=" p-6 rounded-md shadow-md w-full max-w-sm text-left"
                                    action="{{ route('pengeluaran.store') }}" method="post">
                                    @csrf
                                    <div class="flex justify-between items-center border-b pb-3">
                                        <h3 class="text-xl font-semibold text-gray-700">Tambah Supplier
                                        </h3>
                                    </div>

                                    <div class="mt-3">
                                        <label>Tanggal</label>
                                        <input type="date" name="tanggal" class="input w-full border mt-2" required>
                                        @if ($errors->has('tanggal'))
                                            <div
                                                class="rounded-md flex items-center px-5 py-4 mb-2 mt-3 bg-theme-6 text-white alert-box">
                                                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i>
                                                {{ $errors->first('tanggal') }}
                                                <i data-feather="x" class="w-4 h-4 ml-auto close-alert"
                                                    style="cursor: pointer;"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mt-3">
                                        <label>Kategori</label>
                                        <select name="kategori" id="" class="input w-full border mt-2">
                                            <option value="Pengeluaran Operasional">Pengeluaran Operasional</option>
                                            <option value="Pengeluaran Gaji & Karyawan">Pengeluaran Gaji & Karyawan</option>
                                            <option value="Pengeluaran Pembelian Barang">Pengeluaran Pembelian Barang</option>
                                            <option value=" Biaya Periklanan & Pemasaran"> Biaya Periklanan & Pemasaran</option>
                                            <option value="Biaya Peralatan & Inventaris">Biaya Peralatan & Inventaris</option>
                                            <option value="Biaya Pajak & Perizinan">Biaya Pajak & Perizinan</option>
                                            <option value="Biaya Pengiriman & Logistik">Biaya Pengiriman & Logistik</option>
                                        </select>
                                        @if ($errors->has('kategori'))
                                            <div
                                                class="rounded-md flex items-center px-5 py-4 mb-2 mt-3 bg-theme-6 text-white alert-box">
                                                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i>
                                                {{ $errors->first('kategori') }}
                                                <i data-feather="x" class="w-4 h-4 ml-auto close-alert"
                                                    style="cursor: pointer;"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mt-3">
                                        <label>Deskripsi</label>
                                        <textarea type="text" name="deskripsi" class="input w-full border mt-2" placeholder="Deskripsi" required></textarea>
                                        @if ($errors->has('suplier'))
                                            <div
                                                class="rounded-md flex items-center px-5 py-4 mb-2 mt-3 bg-theme-6 text-white alert-box">
                                                <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i>
                                                {{ $errors->first('deskripsi') }}
                                                <i data-feather="x" class="w-4 h-4 ml-auto close-alert"
                                                    style="cursor: pointer;"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mt-3">
                                        <label>Nominal Pengeluaran</label>
                                        <input type="number" name="total_pengeluaran"
                                            class="input w-full border mt-2 mb-3"
                                            placeholder="Masukkan Nominal Pengeluaran" required>
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700"
                                        type="submit">
                                        Submit
                                    </button>
                                    <!-- Footer Modal -->
                                </form>
                            </div>
                        </div>
                        {{-- end Modal --}}
                        <div class="hidden md:block mx-auto text-gray-600">Showing {{ $pengeluarans->firstItem() }} to
                            {{ $pengeluarans->lastItem() }} of {{ $pengeluarans->total() }} entries</div>
                        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                            <div class="w-56 relative text-gray-700">
                                <a class="button text-white bg-theme-1 shadow-md mr-2"
                                    href="{{ route('laba.rugi') }}">Laba Rugi</a>
                                <a class="button text-white bg-theme-1 shadow-md mr-2"
                                    href="{{ route('arus.kas') }}">PDF</a>
                            </div>
                        </div>
                    </div>
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table id="data-table" class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class=" whitespace-no-wrap">TANGGAL</th>
                                    <th class=" whitespace-no-wrap">KATEGORI</th>
                                    <th class=" whitespace-no-wrap">DESKRIPSI</th>
                                    <th class=" whitespace-no-wrap">TOTAL PENGELUARAN</th>
                                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startId = 1;
                                @endphp
                                @foreach ($pengeluarans as $index => $item)
                                    <tr class="intro-x">
                                        <td>{{ $startId + $index }}</td>
                                        <td class="">{{ $item->tanggal }}</td>
                                        <td>{{ $item->kategori }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td class="">Rp.
                                            {{ number_format($item->total_pengeluaran, 0, ',', '.') }}</td>
                                        </td>
                                        <td class="table-report__action w-56">
                                            <div class="flex justify-center items-center adit-button">
                                                <div class="intro-x dropdown w-8 h-8 relative">
                                                    <div class="dropdown-toggle">
                                                        <i data-feather="more-vertical"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Link pagination -->
                        <div>
                            {{ $pengeluarans->links() }}
                        </div>
                    </div>
                    <!-- END: Data List -->
                </div>
            </div>
        </div>

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
