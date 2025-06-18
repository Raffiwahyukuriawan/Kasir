<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <div>
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div>
                <!-- END: Top Bar -->
                {{-- Menampilkan alert jika ada status success atau error --}}
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
                            data-target="#tambah" onclick="openModal()">Add New Kategori</a>
                        {{-- Modal --}}
                        <div class="modal {{ session('modal') == 'tambah' || $errors->any() ? 'active' : '' }}"
                            id="tambah">
                            <div class="modal__content p-10 text-center">
                                <form class="p-6 rounded-md shadow-md w-full max-w-sm text-left"
                                    action="{{ route('add.kategori') }}" method="post">
                                    @csrf
                                    <div class="flex justify-between items-center border-b pb-3">
                                        <h3 class="text-xl font-semibold text-gray-700">Add Kategori</h3>
                                    </div>

                                    <div class="mt-3 mb-4">
                                        <label>Kategori</label>
                                        <input type="text" name="kategori" class="input w-full border mt-2"
                                            placeholder="Nama Kategori" autocomplete="off" required value="{{ old('kategori') }}">
                                        @error('kategori')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                        {{-- end Modal --}}
                        <div class="hidden md:block mx-auto text-gray-600">Showing {{ $kategoris->firstItem() }} to
                            {{ $kategoris->lastItem() }} of {{ $kategoris->total() }} entries</div>
                        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                            <div class="w-56 relative text-gray-700">
                                <input type="text" id="search-kategori"
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
                                    <th class=" whitespace-no-wrap">KATEGORI</th>
                                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startId = ($kategoris->currentPage() - 1) * $kategoris->perPage() + 1;
                                @endphp
                                @foreach ($kategoris as $index => $kategori)
                                    <tr class="intro-x">
                                        <td>{{ $startId + $index }}</td>
                                        <td class="">{{ $kategori['kategori'] }}</td>
                                        <td class="table-report__action w-56">
                                            <div class="flex justify-center items-center adit-button">
                                                <div class="intro-x dropdown w-8 h-8 relative">
                                                    <div class="dropdown-toggle">
                                                        <i data-feather="more-vertical"></i>
                                                    </div>
                                                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                                                        <div class="dropdown-box__content box bg-theme-38 text-white">
                                                            <div class="p-4 border-b border-theme-40">
                                                                <div class="font-medium">Beri aksi pada kategori
                                                                    {{ $kategori->kategori }}</div>
                                                                <div class="text-xs text-theme-41">
                                                                </div>
                                                            </div>
                                                            <div class="p-2">
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"
                                                                    data-toggle="modal"
                                                                    data-target="#modal-edit{{ $kategori->id }}">
                                                                    <i data-feather="edit" class="w-4 h-4 mr-2"></i>
                                                                    Edit </a>
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md delete-kategori"
                                                                    data-id="{{ $kategori->id }}">
                                                                    <i data-feather="trash" class="w-4 h-4 mr-2"></i>
                                                                    Delete </a>
                                                                <a href="{{ route('produk_kategori', $kategori->id) }}"
                                                                    class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                                                    <i data-feather="box" class="w-4 h-4 mr-2"></i>
                                                                    Lihat Produk </a>
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
                                                <div class="modal" id="modal-edit{{ $kategori->id }}">
                                                    <div class="modal__content p-10 text-center">
                                                        <!-- Header Modal -->
                                                        <form action="{{ route('update.kategori', $kategori->id) }}"
                                                            method="POST"
                                                            class=" p-6 rounded-md shadow-md w-full max-w-sm text-left">
                                                            @csrf
                                                            @method('PUT')
                                                            <div
                                                                class="flex justify-between items-center border-b pb-3">
                                                                <h3 class="text-xl font-semibold text-gray-700">Edit
                                                                    {{ $kategori->kategori }}
                                                                </h3>
                                                            </div>

                                                            <div class="mt-5 mb-5">
                                                                <label>Nama Kategori</label>
                                                                <input type="text" name="kategori"
                                                                    class="input w-full border mt-2"
                                                                    value="{{ old('kategori', $kategori->kategori) }}"
                                                                    autocomplete="off" required>
                                                                @error('kategori')
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
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Link pagination -->
                        <div>
                            {{ $kategoris->links() }}
                        </div>
                    </div>
                    <!-- END: Data List -->
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if (session('modal') == 'tambah' || $errors->any())
                    document.getElementById('tambah').classList.add('active');
                @endif
            });
        </script>

        {{-- delete kategori --}}
        <script>
            document.querySelectorAll('.delete-kategori').forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil id_kategori dari atribut data-id_user
                    const id = this.getAttribute('data-id');
                    if (!id) {
                        console.error('ID Kategori tidak ditemukan!');
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
                            form.action = `/kategori/${id}`; // Gunakan id_user dalam URL

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
                                        <div class="flex justify-center items-center edit-button">
                                                <div class="intro-x dropdown w-8 h-8 relative">
                                                    <div class="dropdown-toggle">
                                                        <i data-feather="more-vertical" class="fas fa-ellipsis-v mt-2"></i>
                                                    </div>
                                                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                                                        <div class="dropdown-box__content box bg-theme-38 text-white">
                                                            <div class="p-4 border-b border-theme-40">
                                                                <div class="font-medium">Beri aksi pada
                                                                    ${kategori.kategori}</div>
                                                                <div class="text-xs text-theme-41">
                                                                </div>
                                                            </div>
                                                            <div class="p-2">
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md edit-button"
                                                                    data-toggle="modal"
                                                                    data-target="#modal-edit${kategori.id}">
                                                                    <i data-feather="edit" class="w-4 h-4 mr-2 fas fa-edit"></i>
                                                                    Edit </a>
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md delete-button"
                                                                    data-id="${kategori.id}">
                                                                    <i data-feather="trash" class="w-4 h-4 mr-2 fas fa-trash" class=""></i>
                                                                    Delete </a>
                                                                
                                                                <!-- Modal Edit -->
                                                                <div class="modal" id="modal-edit${kategori.id}">
                                                                    <div class="modal__content p-10 text-center">
                                                                        <form action="/kategori/update/${kategori.id}" method="POST" class="p-6 rounded-md shadow-md w-full max-w-sm text-left">
                                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                            <input type="hidden" name="_method" value="PUT">
                                                                            <div class="flex justify-between items-center border-b pb-3">
                                                                                <h3 class="text-xl font-semibold text-gray-700">Edit ${kategori.kategori}</h3>
                                                                            </div>
                                                                            <div class="mt-3 mb-5">
                                                                                <label>Kategori</label>
                                                                                <input type="text" name="kategori" class="input w-full border mt-2" placeholder="Nama kategori" value="${kategori.kategori}" required>
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
