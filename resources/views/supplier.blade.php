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
                        <a class="button text-white bg-theme-1 shadow-md mr-2" href="javascript:;" data-toggle="modal"
                            data-target="#tambah">Add New Supplier</a>
                        {{-- Modal --}}

                        <div class="modal" id="tambah">
                            <div class="modal__content p-10 text-center">
                                <!-- Header Modal -->
                                <form class=" p-6 rounded-md shadow-md w-full max-w-sm text-left"
                                    action="{{ route('supplier.store') }}" method="post">
                                    @csrf
                                    <div class="flex justify-between items-center border-b pb-3">
                                        <h3 class="text-xl font-semibold text-gray-700">Tambah Supplier
                                        </h3>
                                    </div>

                                    <div class="mt-3">
                                        <label>Supplier</label>
                                        <input type="text" name="supplier" class="input w-full border mt-2"
                                            placeholder="Nama Supplier" value="{{ old('supplier') }}" autocomplete="off" required>
                                        @error('supplier')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label>No.Telp</label>
                                        <input type="number" name="no_telp" class="input w-full border mt-2 mb-3"
                                            placeholder="Masukkan NoTelp" value="{{ old('no_telp') }}" autocomplete="off" required>
                                        @error('no_telp')
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
                        <div class="hidden md:block mx-auto text-gray-600">Showing {{ $suppliers->firstItem() }} to
                            {{ $suppliers->lastItem() }} of {{ $suppliers->total() }} entries</div>
                        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                            <div class="w-56 relative text-gray-700">
                                <input type="text" id="search-input"
                                    class="input w-56 box pr-10 placeholder-theme-13" autocomplete="off" placeholder="Search...">
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
                                    <th class="whitespace-no-wrap">NAMA SUPPLIER</th>
                                    <th class="text-center whitespace-no-wrap">NO.Telp</th>
                                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startId = 1;
                                @endphp
                                @foreach ($suppliers as $index => $supplier)
                                    <tr class="intro-x">
                                        <td>{{ $startId + $index }}</td>
                                        <td class="w-40">{{ $supplier['supplier'] }}</td>
                                        <td class="text-center">{{ $supplier['no_telp'] }}</td>
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
                                                                    {{ $supplier->supplier }}</div>
                                                                <div class="text-xs text-theme-41">
                                                                </div>
                                                            </div>
                                                            <div class="p-2">
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"
                                                                    data-toggle="modal"
                                                                    data-target="#modal-edit{{ $supplier->id }}">
                                                                    <i data-feather="edit" class="w-4 h-4 mr-2"></i>
                                                                    Edit </a>
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md delete-button"
                                                                    data-id="{{ $supplier->id }}">
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
                                                <div class="modal edit-button" id="modal-edit{{ $supplier->id }}">
                                                    <div class="modal__content p-10 text-center">
                                                        <!-- Header Modal -->
                                                        <form action="{{ route('supplier.update', $supplier->id) }}"
                                                            method="POST"
                                                            class=" p-6 rounded-md shadow-md w-full max-w-sm text-left">
                                                            @csrf
                                                            @method('PUT')
                                                            <div
                                                                class="flex justify-between items-center border-b pb-3">
                                                                <h3 class="text-xl font-semibold text-gray-700">Edit
                                                                    {{ $supplier->supplier }}
                                                                </h3>
                                                            </div>

                                                            <div class="mt-3">
                                                                <label>Supplier</label>
                                                                <input type="text" name="supplier"
                                                                    class="input w-full border mt-2"
                                                                    placeholder="Nama Supplier"
                                                                    value="{{ $supplier->supplier}}" 
                                                                    autocomplete="off" required>
                                                            </div>

                                                            <div class="mt-3 mb-5">
                                                                <label>No Telephon</label>
                                                                <input type="number" name="no_telp"
                                                                    class="input w-full border mt-2"
                                                                    placeholder="Masukkan NoTelp"
                                                                    value="{{ $supplier->no_telp }}"
                                                                    autocomplete="off" required>
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
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Link pagination -->
                        <div>
                            {{ $suppliers->links() }}
                        </div>
                    </div>
                    <!-- END: Data List -->
                </div>
            </div>
        </div>


        {{-- delete supplier --}}
        <script>
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil id_supplier dari atribut data-id_supplier
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
                            form.action = `/supplier/delete/${id}`; // Gunakan id_user dalam URL

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
        {{-- end delete supplier --}}

        {{-- search --}}
        <script>
            document.getElementById('search-input').addEventListener('keyup', function() {
                const keyword = this.value;

                fetch(`/supplier/search?keyword=${keyword}`)
                    .then(response => response.json())
                    .then(suppliers => {
                        const tbody = document.querySelector('#data-table tbody');
                        tbody.innerHTML = ''; // Kosongkan tabel

                        if (suppliers.length === 0) {
                            tbody.innerHTML = `<tr><td colspan="7" class="text-center">No data found</td></tr>`;
                        } else {
                            suppliers.forEach((supplier, index) => {
                                const row = `
                                <tr class="intro-x">
                                    <td>${index + 1}</td>
                                    <td class="w-40">${supplier.supplier}</td>
                                    <td class="text-center">${supplier.no_telp}</td>
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center items-center edit-button">
                                                <div class="intro-x dropdown w-8 h-8 relative">
                                                    <div class="dropdown-toggle">
                                                        <i data-feather="more-vertical" class="fas fa-ellipsis-v mt-2"></i>
                                                    </div>
                                                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                                                        <div class="dropdown-box__content box bg-theme-38 text-white">
                                                            <div class="p-4 border-b border-theme-40">
                                                                <div class="font-medium">Beri aksi pada
                                                                    ${ supplier.supplier }</div>
                                                                <div class="text-xs text-theme-41">
                                                                </div>
                                                            </div>
                                                            <div class="p-2">
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md edit-button"
                                                                    data-toggle="modal" data-id="${supplier.id}"
                                                                    data-target="#modal-edit${supplier.id}">
                                                                    <i data-feather="edit" class="w-4 h-4 mr-2 fas fa-edit"></i>
                                                                    Edit </a>
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md delete-button"
                                                                    data-id="${ supplier.id }">
                                                                    <i data-feather="trash" class="w-4 h-4 mr-2 fas fa-trash" class=""></i>
                                                                    Delete </a>
                                                                <!-- Modal Edit -->
                                                                <div class="modal" id="modal-edit${supplier.id}">
                                                                    <div class="modal__content p-10 text-center">
                                                                        <form action="/supplier/update/${supplier.id}" method="POST" class="p-6 rounded-md shadow-md w-full max-w-sm text-left">
                                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                            <input type="hidden" name="_method" value="PUT">
                                                                            <div class="flex justify-between items-center border-b pb-3">
                                                                                <h3 class="text-xl font-semibold text-gray-700">Edit ${supplier.supplier}</h3>
                                                                            </div>
                                                                            <div class="mt-3">
                                                                                <label>Supplier</label>
                                                                                <input type="text" name="supplier" class="input w-full border mt-2" placeholder="Nama Supplier" value="${supplier.supplier}" required>
                                                                            </div>
                                                                            <div class="mt-3 mb-5">
                                                                                <label>No Telephon</label>
                                                                                <input type="number" name="no_telp" class="input w-full border mt-2" placeholder="Masukkan NoTelp" value="${supplier.no_telp}" required>
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
                                    form.action = `/supplier/delete/${id}`;

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
                    document.addEventListener('click', function(event) {
                        if (event.target.classList.contains('edit-button')) {
                            const id = event.target.getAttribute('data-id');
                            const modal = document.getElementById(`modal-edit${id}`);
                            if (modal) {
                                modal.classList.add('show');
                                modal.style.display = 'block';
                                document.body.classList.add('modal-open');
                            }
                        }
                    });

                }

            });
        </script>
        {{-- end search --}}
</x-layout>
