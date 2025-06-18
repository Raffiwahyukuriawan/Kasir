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

                @if (session('success'))
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-3 bg-theme-1 text-white alert-box">
                        <i data-feather="smile" class="w-6 h-6 mr-2"></i>
                        {{ session('success') }}
                        <i data-feather="x" class="w-4 h-4 ml-auto close-alert" style="cursor: pointer;"></i>
                    </div>
                @endif
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                        @if (\Auth::user()->role == 'kasir')
                            <a class="button text-white bg-theme-1 shadow-md mr-2" href="{{ route('penjualan') }}"
                                data-toggle="modal" data-target="#tambah">Add New Transaksi</a>
                        @endif
                        <div class="hidden md:block mx-auto text-gray-600">Showing {{ $transaksies->firstItem() }} to
                            {{ $transaksies->lastItem() }} of {{ $transaksies->total() }} entries</div>
                        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                            <div class="w-56 relative text-gray-700">
                                <input type="text" id="search-input"
                                    class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..."
                                    autocomplete="off">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table id="data-table" class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class=" whitespace-no-wrap">NO NOTA</th>
                                    <th class=" whitespace-no-wrap">STATUS</th>
                                    <th class=" whitespace-no-wrap">TANGGAL</th>
                                    <th class=" whitespace-no-wrap">TOTAL HARGA</th>
                                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startId = 1;
                                @endphp
                                @foreach ($transaksies as $index => $transaksi)
                                    <tr class="intro-x">
                                        <td>{{ $startId + $index }}</td>
                                        <td class="">{{ $transaksi['no_nota'] }}</td>
                                        <td class="">{{ $transaksi['status'] }}</td>
                                        <td class="">{{ $transaksi['tanggal'] }}</td>
                                        <td class="">Rp.
                                            {{ number_format($transaksi['total_harga'], 0, ',', '.') }}
                                        </td>
                                        <td class="table-report__action w-56">
                                            <div class="flex justify-center items-center adit-button">
                                                <div class="intro-x dropdown w-8 h-8 relative">
                                                    <div class="dropdown-toggle">
                                                        <i data-feather="more-vertical"></i>
                                                    </div>
                                                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                                                        <div class="dropdown-box__content box bg-theme-38 text-white">
                                                            <div class="p-4 border-b border-theme-40">
                                                                <div class="font-medium">Transaksi
                                                                    {{ $transaksi->no_nota }}</div>
                                                                <div class="text-xs text-theme-41">
                                                                </div>
                                                            </div>
                                                            <div class="p-2">
                                                                <a href="{{ route('invoice/kasir/', $transaksi->no_nota) }}"
                                                                    class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                                                    <i data-feather="credit-card"
                                                                        class="w-4 h-4 mr-2"></i>
                                                                    Invoice </a>
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md delete-button"
                                                                    data-id="{{ $transaksi->id }}">
                                                                    <i data-feather="trash-2" class="w-4 h-4 mr-2"></i>
                                                                    Delete </a>

                                                            </div>
                                                            <div class="p-2 border-t border-theme-40">
                                                                <a href="{{ route('logout') }}"
                                                                    class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                                                    <i data-feather="toggle-right"
                                                                        class="w-4 h-4 mr-2"></i> Logout </a>
                                                            </div>
                                                        </div>
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
                            {{ $transaksies->links() }}
                        </div>
                    </div>
                    <!-- END: Data List -->
                </div>
            </div>
        </div>

        {{-- delete pengguna --}}
        <script>
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil id_user dari atribut data-id_user
                    const id = this.getAttribute('data-id');
                    if (!id) {
                        console.error('Nota tidak ditemukan!');
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
                            form.action = `/penjualan/kasir/delete/${id}`; // Gunakan id_user dalam URL

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
        {{-- end delete pengguna --}}

        {{-- search --}}
        <script>
            document.getElementById('search-input').addEventListener('keyup', function() {
                const keyword = this.value;

                fetch(`/transaksi/search?keyword=${keyword}`)
                    .then(response => response.json())
                    .then(transaksis => {
                        const tbody = document.querySelector('#data-table tbody');
                        tbody.innerHTML = ''; // Kosongkan tabel

                        if (transaksis.length === 0) {
                            tbody.innerHTML = `<tr><td colspan="7" class="text-center">No data found</td></tr>`;
                        } else {
                            transaksis.forEach((transaksi, index) => {
                                const row = `   
                                <tr class="intro-x">
                                    <td>${index + 1}</td>
                                    <td class="w-40">${transaksi.no_nota}</td>
                                    <td class="">${transaksi.status}</td>
                                    <td class="whitespace-no-wrap">${transaksi.tanggal}</td>
                                    <td class="w-40 text-center">${transaksi.total_harga}</td>
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center items-center edit-button">
                                                <div class="intro-x dropdown w-8 h-8 relative">
                                                    <div class="dropdown-toggle">
                                                        <i class="fas fa-ellipsis-v mt-2"></i>
                                                    </div>
                                                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                                                        <div class="dropdown-box__content box bg-theme-38 text-white">
                                                            <div class="p-4 border-b border-theme-40">
                                                                <div class="font-medium">Beri aksi pada
                                                                    ${ transaksi.no_nota }</div>
                                                                <div class="text-xs text-theme-41">
                                                                </div>
                                                            </div>
                                                            <div class="p-2">
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"
                                                                    href="/invoice/${transaksi.no_nota}">
                                                                    <i data-feather="credit-card" class="w-4 h-4 mr-2 fas fa-credit-card"></i>
                                                                    Invoice </a>
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md delete-button"
                                                                    data-id="${ transaksi.no_nota }">
                                                                    <i data-feather="trash" class="w-4 h-4 mr-2 fas fa-trash" class=""></i>
                                                                    Delete </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>`;
                                tbody.insertAdjacentHTML('beforeend', row);
                            });
                            attachEventListeners();
                        }
                    })
                    .catch(error => console.error('Error:', error));
                // Fungsi untuk menambahkan event listener
                function attachEventListeners() {
                    // Tambahkan event listener untuk tombol Edit
                    document.querySelectorAll('.edit-button').forEach(button => {
                        button.addEventListener('click', function() {
                            const id = this.getAttribute('data-id_user');
                            console.log(`Edit user dengan ID: ${id}`);
                            // Tambahkan logika untuk membuka modal edit di sini
                        });
                    });

                    // Tambahkan event listener untuk tombol Delete
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
                                    form.action = `/penjualan/delete/${id}`;

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
        <script src="/dist/js/app.js"></script>

</x-layout>
