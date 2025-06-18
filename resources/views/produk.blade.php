<x-layout>
    {{-- <x-header1 :title="$title" /> --}}
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
                        <a class="button text-white bg-theme-1 shadow-md mr-2" href="javascript:;" data-toggle="modal"
                            data-target="#tambah">Add New Produk</a>
                        {{-- Modal --}}
                        <div class="modal" id="tambah">
                            <div class="modal__content p-10 text-center">
                                <!-- Header Modal -->
                                <form class=" p-6 rounded-md shadow-md w-full max-w-sm text-left"
                                    action="{{ route('add.produk') }}" method="post">
                                    @csrf
                                    <div class="flex justify-between items-center border-b pb-3">
                                        <h3 class="text-xl font-semibold text-gray-700">Add New Produk
                                        </h3>
                                    </div>

                                    <div class="mt-3 mb-4">
                                        <label>Nama Produk</label>
                                        <input type="text" name="nama_produk" class="input w-full border mt-2"
                                            placeholder="Nama Produk" autocomplete="off" required
                                            value="{{ old('nama_produk') }}">
                                        @error('nama_produk')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3 mb-4">
                                        <label>Kategori</label>
                                        <select class="input input--lg border mr-2 w-full" name="id_kategori"
                                            id="" value="{{ old('id_kategori') }}">
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori['id'] }}">{{ $kategori['kategori'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_kategori')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3 mb-4">
                                        <label for="barcode">Barcode</label>
                                        <input type="text" id="barcode-input" name="barcode"
                                            class="input w-full border mt-2" placeholder="Barcode" autocomplete="off"
                                            autofocus>
                                        @error('barcode')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3 mb-4">
                                        <label>Harga</label>
                                        <input type="number" name="harga" class="input w-full border mt-2"
                                            placeholder="Harga" value="{{ old('harga') }}" autocomplete="off"
                                            required>
                                        @error('harga')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3 mb-4">
                                        <label>Stok</label>
                                        <input type="number" name="stok" class="input w-full border mt-2"
                                            placeholder="Jumlah Stok" value="{{ old('stok') }}" autocomplete="off"
                                            required>
                                        @error('stok')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
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
                        <div class="hidden md:block mx-auto text-gray-600">Showing {{ $produks->firstItem() }} to
                            {{ $produks->lastItem() }} of {{ $produks->total() }} entries</div>
                        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                            <div class="w-56 relative text-gray-700">
                                <input type="text" id="search-produk"
                                    class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." autocomplete="off">
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
                                    <th class=" whitespace-no-wrap">PRODUK</th>
                                    <th class=" whitespace-no-wrap">KATEGORI</th>
                                    <th class=" whitespace-no-wrap">BARCODE</th>
                                    <th class=" whitespace-no-wrap">HARGA</th>
                                    <th class=" whitespace-no-wrap">STOK</th>
                                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startId = ($produks->currentPage() - 1) * $produks->perPage() + 1;
                                @endphp
                                @foreach ($produks as $produk)
                                    <tr class="intro-x">
                                        <td>{{ $startId++ }}</td>
                                        <td class="">{{ $produk['nama_produk'] }}</td>
                                        <td class="">{{ $produk->kategori->kategori }}</td>
                                        <td class="">{{ $produk['barcode'] }}</td>
                                        <td class="">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                        <td class="">{{ $produk['stok'] }}</td>
                                        <td class="table-report__action w-56">
                                            <div class="flex justify-center items-center adit-button">
                                                <div class="intro-x dropdown w-8 h-8 relative">
                                                    <div class="dropdown-toggle">
                                                        <i data-feather="more-vertical"></i>
                                                    </div>
                                                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                                                        <div class="dropdown-box__content box bg-theme-38 text-white">
                                                            <div class="p-4 border-b border-theme-40">
                                                                <div class="font-medium">Beri aksi pada
                                                                    {{ $produk->nama_produk }}</div>
                                                                <div class="text-xs text-theme-41">
                                                                </div>
                                                            </div>
                                                            <div class="p-2">
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"
                                                                    data-toggle="modal"
                                                                    data-kode="{{ $produk->barcode }}"
                                                                    data-target="#modal-barcode{{ $produk->id }}"
                                                                    data-id="{{ $produk->id }}">
                                                                    <i data-feather="save" class="w-4 h-4 mr-2"></i>
                                                                    Barcode </a>
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"
                                                                    data-toggle="modal"
                                                                    data-target="#modal-edit{{ $produk->id }}"">
                                                                    <i data-feather="edit" class="w-4 h-4 mr-2"></i>
                                                                    Edit </a>
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md delete-produk"
                                                                    data-id="{{ $produk->id }}">
                                                                    <i data-feather="trash" class="w-4 h-4 mr-2"></i>
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
                                                {{-- Modal --}}
                                                <div class="modal" id="modal-edit{{ $produk->id }}">
                                                    <div class="modal__content p-10 text-center">
                                                        <!-- Header Modal -->
                                                        <form action="{{ route('produk.update', $produk->id) }}"
                                                            method="POST"
                                                            class=" p-6 rounded-md w-full max-w-sm text-left">
                                                            @csrf
                                                            @method('PUT')
                                                            <div
                                                                class="flex justify-between items-center border-b pb-3">
                                                                <h3 class="text-xl font-semibold text-gray-700">Edit
                                                                    Produk
                                                                    {{ $produk->nama_produk }}
                                                                </h3>
                                                            </div>

                                                            <div class="mt-5 mb-5">
                                                                <label>Nama produk</label>
                                                                <input type="text" name="nama_produk"
                                                                    class="input w-full border mt-2"
                                                                    value="{{ $produk->nama_produk }}"
                                                                    autocomplete="off" required>
                                                                @error('nama_produk')
                                                                    <p class="text-red-500 text-sm mt-1">
                                                                        {{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="mt-5 mb-5">
                                                                <label>Kategori</label>
                                                                <select class="input input--lg border mr-2 w-full"
                                                                    name="id_kategori" id="">
                                                                    @foreach ($kategoris as $kategori)
                                                                        <option value="{{ $kategori->id }}">
                                                                            {{ $kategori->kategori }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('id_kategori')
                                                                    <p class="text-red-500 text-sm mt-1">
                                                                        {{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="mt-5 mb-5">
                                                                <label>Barcode</label>
                                                                <input type="text" name="barcode"
                                                                    class="input w-full border mt-2"
                                                                    value="{{ $produk->barcode }}" autocomplete="off"
                                                                    required>
                                                                @error('barcode')
                                                                    <p class="text-red-500 text-sm mt-1">
                                                                        {{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="mt-5 mb-5">
                                                                <label>Harga</label>
                                                                <input type="text" name="harga"
                                                                    class="input w-full border mt-2"
                                                                    value="{{ $produk->harga }}" autocomplete="off"
                                                                    required>
                                                                @error('harga')
                                                                    <p class="text-red-500 text-sm mt-1">
                                                                        {{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="mt-5 mb-5">
                                                                <label>Stok</label>
                                                                <input type="number" name="stok"
                                                                    class="input w-full border mt-2"
                                                                    value="{{ $produk->stok }}" autocomplete="off"
                                                                    required>
                                                                @error('stok')
                                                                    <p class="text-red-500 text-sm mt-1">
                                                                        {{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <button type="submit"
                                                                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                                                                Submit
                                                            </button>
                                                            <!-- Footer Modal -->
                                                        </form>
                                                    </div>
                                                </div>
                                                {{-- end Modal --}}

                                                {{-- Modal barcode --}}
                                                <div class="modal" id="modal-barcode{{ $produk->id }}">
                                                    <div class="modal__content p-10 text-center">
                                                        <h2 class="text-lg font-bold mb-3">Barcode Produk
                                                            {{ $produk->nama_produk }}</h2>

                                                        <div class="flex justify-center">
                                                            <svg id="barcode-{{ $produk->id }}"></svg>
                                                        </div>

                                                        <button onclick="printBarcode({{ $produk->id }})"
                                                            class="mt-3 bg-blue-500 text-white px-4 py-2 rounded-md">Print
                                                            Barcode</button>

                                                    </div>
                                                </div>
                                                {{-- end Modal barcode --}}
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Link pagination -->
                        <div>
                            {{ $produks->links() }}
                        </div>
                    </div>
                    <!-- END: Data List -->
                </div>
            </div>
        </div>

        {{-- autofocus --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('tambah');
                modal.addEventListener('shown.bs.modal', function() {
                    document.getElementById('barcode-input').focus();
                });
            });
        </script>

        {{-- delete produk --}}
        <script>
            document.querySelectorAll('.delete-produk').forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil id_produk dari atribut data-id_produk
                    const id = this.getAttribute('data-id');
                    if (!id) {
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
                            form.action = `/produk/${id}`; // Gunakan id_user dalam URL

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
        {{-- end delete produk --}}

        {{-- search --}}
        <script>
            document.getElementById('search-produk').addEventListener('keyup', function() {
                const keyword = this.value;

                fetch(`/produk/search?keyword=${encodeURIComponent(keyword)}`)
                    .then(response => response.json())
                    .then(produks => {
                        const tbody = document.querySelector('#data-table tbody');
                        tbody.innerHTML = ''; // Kosongkan tabel

                        if (produks.length === 0) {
                            tbody.innerHTML = `<tr><td colspan="7" class="text-center">No data found</td></tr>`;
                        } else {
                            produks.forEach((produk, index) => {
                                const row = `
                    <tr class="intro-x">
                        <td>${index + 1}</td>
                        <td class="w-35">${produk.nama_produk}</td>
                        <td class="text">${produk.kategori ? produk.kategori.kategori : '-'}</td>
                        <td class="">${produk.barcode}</td>
                        <td class="">Rp. ${produk.harga}</td>
                        <td class="">${produk.stok}</td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <div class="intro-x dropdown w-8 h-8 relative">
                                    <div class="dropdown-toggle">
                                        <i data-feather="more-vertical" class="fas fa-ellipsis-v mt-2"></i>
                                    </div>
                                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                                        <div class="dropdown-box__content box bg-theme-38 text-white">
                                            <div class="p-4 border-b border-theme-40">
                                                <div class="font-medium">Beri aksi pada ${produk.nama_produk}</div>
                                            </div>
                                            <div class="p-2">
                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md edit-button"
                                                    data-id="${produk.id}"
                                                     data-toggle="modal"
                                                     data-target="#modal-edit${produk.id}">
                                                    <i class="w-4 h-4 mr-2 fas fa-edit"></i> Edit
                                                </a>
                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md delete-button"
                                                    data-id="${produk.id}">
                                                    <i class="w-4 h-4 mr-2 fas fa-trash"></i> Delete
                                                </a>

                                                <!-- Modal Edit -->
                                                <div class="modal" id="modal-edit${produk.id}">
                                                    <div class="modal__content p-10 text-center">
                                                        <form action="/produk/update/${produk.id}" method="POST" class="p-6 rounded-md shadow-md w-full max-w-sm text-left">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <div class="flex justify-between items-center border-b pb-3">
                                                                <h3 class="text-xl font-semibold text-gray-700">Edit ${produk.nama_produk}</h3>
                                                            </div>
                                                            <div class="mt-3">
                                                                <label>Nama Produk</label>
                                                                <input type="text" name="nama_produk" class="input w-full border mt-2" value="${produk.nama_produk}" required>
                                                            </div>
                                                            <div class="mt-3 mb-5">
                                                                <input type="hidden" name="id_kategori" class="input w-full border mt-2" value="${produk.id_kategori}" required>
                                                            </div>
                                                            <div class="mt-3 mb-5">
                                                                <label>Barcode</label>
                                                                <input type="number" name="barcode" class="input w-full border mt-2" value="${produk.barcode}" required>
                                                            </div>
                                                            <div class="mt-3 mb-5">
                                                                <label>Harga</label>
                                                                <input type="number" name="harga" class="input w-full border mt-2" placeholder="Masukkan NoTelp" value="${produk.harga}" required>
                                                            </div>
                                                            <div class="mt-3 mb-5">
                                                                <label>Stok</label>
                                                                <input type="number" name="stok" class="input w-full border mt-2" placeholder="Masukkan NoTelp" value="${produk.stok}" required>
                                                            </div>
                                                            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                                                                Submit
                                                            </button>
                                                        </form>
                                                    </div>
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
                            feather.replace(); // Perbaiki ikon feather
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            // Event delegation untuk tombol Edit dan Delete
            document.addEventListener('click', function(event) {
                if (event.target.closest('.edit-button')) {
                    const id = event.target.closest('.edit-button').getAttribute('data-id');
                    console.log(`Edit produk dengan ID: ${id}`);
                }

                if (event.target.closest('.delete-button')) {
                    const id = event.target.closest('.delete-button').getAttribute('data-id');
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
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/produk/${id}`;

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
                }
            });
        </script>
        {{-- end search --}}

        {{-- barcode --}}
        <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>

        <script>
            document.querySelectorAll("[data-target^='#modal-barcode']").forEach(button => {
                button.addEventListener("click", function() {
                    let barcode = this.getAttribute("data-kode");
                    let produkId = this.getAttribute("data-id");

                    let modal = document.getElementById("modal-barcode" + produkId);
                    let barcodeContainer = modal.querySelector("#barcode-" + produkId);
                    let barcodeNumber = modal.querySelector("#barcode-number-" + produkId);

                    if (barcodeContainer) {
                        JsBarcode(barcodeContainer, barcode, {
                            format: "CODE128",
                            displayValue: true
                        });
                        barcodeNumber.textContent = barcode;
                    } else {
                        console.error("Barcode container tidak ditemukan!");
                    }
                });
            });
        </script>

        <script>
            function printBarcode(id) {
                let modal = document.getElementById("modal-barcode" + id);
                let content = modal.innerHTML;

                let newWindow = window.open("", "", "width=600,height=400");
                newWindow.document.write("<html><head><title>Print Barcode</title></head><body>");
                newWindow.document.write(content);
                newWindow.document.write("</body></html>");
                newWindow.document.close();
                newWindow.print();
            }
        </script>
        {{-- end barcode --}}
</x-layout>
