<x-layout>
    <div class="content">
        <div class="flex flex-col lg:flex-row gap-6 mt-5">
            <!-- Form -->
            <div class="w-full lg:w-1/2">
                <div class="border p-5">
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
                    <h2 class="font-medium text-base mb-4">Konfigurasi Toko</h2>
                    <form action="{{ route('konfigurasi.update', $konfigurasi->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                            <label>Nama Toko</label>
                            <input type="text" name="nama_toko" value="{{ $konfigurasi->nama_toko }}"
                                class="input w-full border mt-2">
                        </div>
                        <div class="mt-3">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="input w-full border mt-2"
                                value="{{ $konfigurasi->alamat }}">
                        </div>
                        <div class="mt-3">
                            <label>No. Telepon</label>
                            <input type="number" name="no_telp" value="{{ $konfigurasi->no_telp }}"
                                class="input w-full border mt-2">
                        </div>
                        <div class="mt-3">
                            <label>Email</label>
                            <input type="email" name="email" class="input w-full border mt-2"
                                value="{{ $konfigurasi->email }}">
                        </div>
                        <div class="mt-3">
                            <label>Jam Operasional</label>
                            <input type="text" name="jam_operasional" class="input w-full border mt-2"
                                value="{{ $konfigurasi->jam_operasional }}">
                        </div>
                        <div class="mt-3">
                            <label>Instagram</label>
                            <input type="text" name="instagram" class="input w-full border mt-2"
                                value="{{ $konfigurasi->instagram }}">
                        </div>
                        <div class="mt-3">
                            <label>Facebook</label>
                            <input type="text" name="facebook" class="input w-full border mt-2"
                                value="{{ $konfigurasi->facebook }}">
                        </div>
                        <div class="mt-3">
                            <label>Logo</label>
                            <input type="file" name="logo" class="input w-full border mt-2"
                                value="{{ $konfigurasi->logo }}">
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="button bg-theme-1 text-white w-full">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Gambar -->
            <div class="w-full lg:w-1/2 flex flex-col items-center justify-center">
                <label class="font-medium text-base mb-2">Logo Toko {{ $konfigurasi['nama_toko'] }}</label>
                <div class="image-zoom relative">
                    <img class="w-full max-w-sm" src="{{ asset('assets/logo/' . $konfigurasi->logo) }}"
                        alt="Logo Toko">
                </div>
            </div>

        </div>

    </div>
</x-layout>
<svg id="barcode"></svg>

<script>
    JsBarcode("#barcode", "123456789", {
        format: "CODE128",
        displayValue: true
    });
</script>
