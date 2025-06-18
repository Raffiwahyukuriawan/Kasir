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
                        <a class="button text-white bg-theme-1 shadow-md mr-2" href="{{ route('keuangan') }}" 
                            >Pendapatan</a>
                        <a class="button text-white bg-theme-1 shadow-md mr-2"
                            href="{{ route('pengeluaran') }}">Pengeluaran</a>

                        {{-- Modal --}}
                        <div class="modal" id="tambah">
                            <div class="modal__content p-10 text-center">
                                <!-- Header Modal -->
                                <form class=" p-6 rounded-md shadow-md w-full max-w-sm text-left"
                                    action="{{ route('pembelian.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="flex justify-between items-center border-b pb-3">
                                        <h3 class="text-xl font-semibold text-gray-700">Tambah Pengguna
                                        </h3>
                                    </div>

                                    <div class="mt-5">
                                        <label>Supplier</label>
                                        <select name="supplier" id="" class="select2 form-control w-full">
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->supplier }}" class="defaultOption">
                                                    {{ $supplier->supplier }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-3 mb-3">
                                        <label>Nominal</label>
                                        <input type="number" name="nominal" class="input w-full border mt-2"
                                            placeholder="Masukkan nominal" required>
                                    </div>

                                    <div class="mt-3 mb-3">
                                        <label>Foto</label>
                                        <input type="file" name="foto" class="input w-full border mt-2"
                                            accept="image/*" required>
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

                        <div class="hidden md:block mx-auto text-gray-600">Showing {{ $laporan->firstItem() }} to
                            {{ $laporan->lastItem() }} of {{ $laporan->total() }} entries</div>
                        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                            <div class="w-56 relative text-gray-700">
                                <a class="button text-white bg-theme-1 shadow-md mr-2" href="{{ route('laba.rugi') }}">Laba Rugi</a>
                                <a class="button text-white bg-theme-1 shadow-md mr-2" href="{{ route('arus.kas') }}" >PDF</a>
                            </div>
                        </div>
                    </div>
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table id="data-table" class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class=" whitespace-no-wrap">BULAN</th>
                                    <th class=" whitespace-no-wrap">TOTAL PENDAPATAN</th>
                                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startId = 1;
                                @endphp
                                @foreach ($laporan as $index => $item)
                                    <tr class="intro-x">
                                        <td>{{ $startId + $index }}</td>
                                        <td class="">{{ date('F Y', strtotime($item->bulan . '-01')) }}</td>
                                        <td class="">Rp.
                                            {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
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
                            {{ $laporan->links() }}
                        </div>
                    </div>
                    <!-- END: Data List -->
                </div>
            </div>
        </div>

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
</x-layout>
