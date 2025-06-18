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
                            data-target="#tambah">Add New User</a>
                        {{-- Modal --}}
                        <div class="modal" id="tambah">
                            <div class="modal__content p-10 text-center">
                                <!-- Header Modal -->
                                <form class=" p-6 rounded-md shadow-md w-full max-w-sm text-left"
                                    action="{{ route('users.store') }}" method="post">
                                    @csrf
                                    <div class="flex justify-between items-center border-b pb-3">
                                        <h3 class="text-xl font-semibold text-gray-700">Tambah Pengguna
                                        </h3>
                                    </div>

                                    <div class="mt-5">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="input w-full border mt-2"
                                            placeholder="Masukkan nama" autocomplete="off" value="{{ old('nama') }}"
                                            required>
                                        @error('nama')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label>Password</label>
                                        <input type="password" name="password" class="input w-full border mt-2"
                                            placeholder="Masukkan password" autocomplete="off"
                                            value="{{ old('password') }}" required>
                                        @error('password')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="input w-full border mt-2"
                                            placeholder="Masukkan email" autocomplete="off" value="{{ old('email') }}"
                                            required>
                                        @error('email')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label>No Telephon</label>
                                        <input type="number" name="no_telp" class="input w-full border mt-2"
                                            placeholder="Masukkan No.Telp" autocomplete="off"
                                            value="{{ old('no_telp') }}" required>
                                        @error('no_telp')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-2 mb-5">
                                        <label>Level</label>
                                        <select class="input input--lg border mr-2 w-full" name="role">
                                            <option>kasir</option>
                                            <option>admin</option>
                                            <option>manager</option>
                                        </select>
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
                        <div class="hidden md:block mx-auto text-gray-600">Showing {{ $users->firstItem() }} to
                            {{ $users->lastItem() }} of {{ $users->total() }} entries</div>
                        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                            <div class="w-56 relative text-gray-700">
                                <input type="text" id="search-input"
                                    class="input w-56 box pr-10 placeholder-theme-13" autocomplete="off"
                                    placeholder="Search...">
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
                                    <th class="whitespace-no-wrap">NAMA</th>
                                    <th class="text-center whitespace-no-wrap">EMAIL</th>
                                    <th class="text-center whitespace-no-wrap">NO TELEPHON</th>
                                    <th class="text-center whitespace-no-wrap">LEVEL</th>
                                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startId = ($users->currentPage() - 1) * $users->perPage() + 1;
                                @endphp
                                @foreach ($users as $user)
                                    <tr class="intro-x">
                                        <td>{{ $startId++ }}</td>
                                        <td class="w-40">{{ $user['nama'] }}</td>
                                        <td class="text-center">{{ $user['email'] }}</td>
                                        <td class="text-center">{{ $user['no_telp'] }}</td>
                                        <td class="w-40">
                                            <div class="flex items-center justify-center text-theme-6">
                                                {{ $user['role'] }} </div>
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
                                                                <div class="font-medium">Beri aksi pada
                                                                    {{ $user->nama }}</div>
                                                                <div class="text-xs text-theme-41">
                                                                </div>
                                                            </div>
                                                            <div class="p-2">
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"
                                                                    data-toggle="modal"
                                                                    data-target="#modal-edit{{ $user->id }}">
                                                                    <i data-feather="edit" class="w-4 h-4 mr-2"></i>
                                                                    Edit </a>
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md delete-button"
                                                                    data-id="{{ $user->id }}">
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
                                                <div class="modal" id="modal-edit{{ $user->id }}">
                                                    <div class="modal__content p-10 text-center">
                                                        <!-- Header Modal -->
                                                        <form action="{{ route('user.update', $user->id) }}"
                                                            method="POST"
                                                            class=" p-6 rounded-md shadow-md w-full max-w-sm text-left">
                                                            @csrf
                                                            @method('PUT')
                                                            <div
                                                                class="flex justify-between items-center border-b pb-3">
                                                                <h3 class="text-xl font-semibold text-gray-700">Edit
                                                                    {{ $user->nama }}
                                                                </h3>
                                                            </div>

                                                            <div class="mt-5">
                                                                <label>Nama</label>
                                                                <input type="text" name="nama"
                                                                    class="input w-full border mt-2"
                                                                    placeholder="Masukkan nama"
                                                                    value="{{ old('nama', $user->nama) }}"
                                                                    autocomplete="off" required>
                                                                @error('nama')
                                                                    <p class="text-red-500 text-sm mt-1">
                                                                        {{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="mt-3">
                                                                <label>Email</label>
                                                                <input type="email" name="email"
                                                                    class="input w-full border mt-2"
                                                                    placeholder="Masukkan email"
                                                                    value="{{ old('email', $user->email) }}"
                                                                    autocomplete="off" required>
                                                                @error('email')
                                                                    <p class="text-red-500 text-sm mt-1">
                                                                        {{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="mt-3 mb-5">
                                                                <label>No Telephon</label>
                                                                <input type="number" name="no_telp"
                                                                    class="input w-full border mt-2"
                                                                    placeholder="Masukkan NoTelp"
                                                                    value="{{ old('no_telp', $user->no_telp) }}"
                                                                    autocomplete="off" required>
                                                                @error('no_telp')
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
                            {{ $users->links() }}
                        </div>
                    </div>
                    <!-- END: Data List -->
                </div>
                <!-- BEGIN: Delete Confirmation Modal -->
                <div class="modal" id="delete-confirmation-modal">
                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-x-circle w-16 h-16 text-theme-6 mx-auto mt-3">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                <line x1="9" y1="9" x2="15" y2="15"></line>
                            </svg>
                            <div class="text-3xl mt-5">Are you sure?</div>
                            <div class="text-gray-600 mt-2">Do you really want to delete these records? This process
                                cannot
                                be undone.</div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal"
                                class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="button" class="button w-24 bg-theme-6 text-white">Delete</button>
                        </div>
                    </div>
                </div>
                <!-- END: Delete Confirmation Modal -->
            </div>
        </div>

        {{-- delete pengguna --}}
        <script>
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil id_user dari atribut data-id_user
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
                            form.action = `/users/${id}`; // Gunakan id_user dalam URL

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

                fetch(`/users/search?keyword=${keyword}`)
                    .then(response => response.json())
                    .then(users => {
                        const tbody = document.querySelector('#data-table tbody');
                        tbody.innerHTML = ''; // Kosongkan tabel

                        if (users.length === 0) {
                            tbody.innerHTML = `<tr><td colspan="7" class="text-center">No data found</td></tr>`;
                        } else {
                            users.forEach((user, index) => {
                                const row = `
                                <tr class="intro-x">
                                    <td>${index + 1}</td>
                                    <td class="w-40">${user.nama}</td>
                                    <td class="text-center">${user.email}</td>
                                    <td class="text-center">${user.no_telp}</td>
                                    <td class="w-40 text-center">${user.role}</td>
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
                                                                    ${ user.nama }</div>
                                                                <div class="text-xs text-theme-41">
                                                                </div>
                                                            </div>
                                                            <div class="p-2">
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md edit-button"
                                                                    data-toggle="modal"
                                                                    data-target="#modal-edit${user.id}">
                                                                    <i data-feather="edit" class="w-4 h-4 mr-2 fas fa-edit"></i>
                                                                    Edit </a>
                                                                <a class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md delete-button"
                                                                    data-id="${ user.id }">
                                                                    <i data-feather="trash" class="w-4 h-4 mr-2 fas fa-trash" class=""></i>
                                                                    Delete </a>

                                                                <!-- Modal Edit -->
                                                                <div class="modal" id="modal-edit${user.id}">
                                                                    <div class="modal__content p-10 text-center">
                                                                        <form action="/users/update/${user.id}" method="POST" class="p-6 rounded-md shadow-md w-full max-w-sm text-left">
                                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                            <input type="hidden" name="_method" value="PUT">
                                                                            <div class="flex justify-between items-center border-b pb-3">
                                                                                <h3 class="text-xl font-semibold text-gray-700">Edit ${user.nama}</h3>
                                                                            </div>
                                                                            <div class="mt-3">
                                                                                <label>Nama</label>
                                                                                <input type="text" name="nama" class="input w-full border mt-2" placeholder="Nama user" value="${user.nama}" required>
                                                                            </div>
                                                                            <div class="mt-3 mb-5">
                                                                                <label>Email</label>
                                                                                <input type="email" name="email" class="input w-full border mt-2" placeholder="Nama user" value="${user.email}" required>
                                                                            </div>
                                                                            <div class="mt-3 mb-5">
                                                                                <label>No Telephon</label>
                                                                                <input type="number" name="no_telp" class="input w-full border mt-2" placeholder="Masukkan NoTelp" value="${user.no_telp}" required>
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
                                    form.action = `/users/${id}`;

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
