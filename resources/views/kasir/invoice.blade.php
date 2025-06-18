<x-layout>
    <div class="content p-10">
        <!-- Header -->
        <div class="border-b pb-8 mb-8 flex items-center">
            <div class="flex-1 text-left">
                <img src="{{ asset('assets/logo/'. $konfigurasi['logo']) }}" alt="Logo Perusahaan" class="h-20 w-auto mr-4">
                <p class="text-sm text-gray-500">Nama Toko: {{ $konfigurasi['nama_toko'] }}</p>
                <p class="text-sm text-gray-500">Alamat: {{ $konfigurasi['alamat'] }}</p>
                <p class="text-sm text-gray-500">Telepon: {{ $konfigurasi['no_telp'] }}</p>
                <p class="text-sm text-gray-500">Email: {{ $konfigurasi['email'] }}</p>
            </div>
            <div class="flex-2 text-right">
                <h1 class="text-4xl font-bold text-gray-400 uppercase">Invoice</h1>
                <div class="mt-4 flex items-center space-x-2"> <!-- Tambahkan flex dan space-x -->
                    <form action="{{ route('batal.penjualan.kasir', $transaksi->no_nota) }}" method="post"
                        onsubmit="return confirm('Yakin ingin membatalkan transaksi ini');">
                        @csrf
                        @method('delete')
                        <button class="bg-red-500 text-white px-4 py-2 rounded">
                            Batalkan Transaksi
                        </button>
                    </form>
                    <a href="{{ route('cetak.kasir', $transaksi->no_nota) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded focus:ring focus:ring-blue-300">
                        Cetak Invoice
                    </a>
                </div>
            </div>

        </div>

        <!-- Informasi Transaksi -->
        <div class="pb-4 mb-4 flex items-start">
            <div class="mb-4">
                <p class="text-sm text-gray-500">Kode Transaksi: {{ $transaksi->no_nota }}</p>
                <p class="text-sm text-gray-500">Tanggal: {{ $transaksi->tanggal }}</p>
            </div>
            <div class="mb-4 text-right flex-1">
                <p class="text-sm text-gray-500">Nama Kasir: {{ $transaksi->nama_kasir }}</p>
            </div>
        </div>

        <!-- Tabel Invoice -->
        <table class="min-w-full table-auto mb-24">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Produk</th>
                    <th class="px-4 py-2 text-left">Qty</th>
                    <th class="px-4 py-2 text-left">Harga</th>
                    <th class="px-4 py-2 text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                    <tr>
                        <td class="border px-4 py-2">{{ $detail->nama_produk }}</td>
                        <td class="border px-4 py-2">{{ $detail->jumlah }}</td>
                        <td class="border px-4 py-2">Rp. {{ number_format($detail->harga, 0, ',', '.') }}</td>
                        <td class="border px-4 py-2 text-right total-harga">Rp.
                            {{ number_format($detail->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="border px-4 py-2 text-right">Subtotal</td>
                    <td class="border px-4 py-2 text-right" id="subtotal">Rp.
                        {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                    </td>
                </tr>
                <tr class="font-bold">
                    <td colspan="3" class="border px-4 py-2 text-right">Dibayar</td>
                    <td class="border px-4 py-2 text-right" id="dibayar" value="0">Rp.
                        {{ number_format($transaksi->bayar, 0, ',', '.') }}</td>
                </tr>
                <tr class="font-bold">
                    <td colspan="3" class="border px-4 py-2 text-right">Kembalian</td>
                    <td class="border px-4 py-2 text-right" id="kembalian">Rp. 0</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        document.getElementById("batal_transaksi").addEventListener("click", function() {
            if (!confirm("Apakah Anda yakin ingin membatalkan transaksi ini?")) return;

            let no_nota = this.getAttribute("data-no-nota");

            url("/penjualan/batal/" + no_nota, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            "content")
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Transaksi berhasil dibatalkan!");
                        window.location.href = "/penjualan";
                    } else {
                        alert("Gagal membatalkan transaksi: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan saat membatalkan transaksi.");
                });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function formatRupiah(angka) {
                return "Rp. " + angka.toLocaleString("id-ID");
            }

            function hitungKembalian() {
                let subtotal = parseInt(document.getElementById("subtotal").innerText.replace(/[^\d]/g, "")) || 0;
                let dibayar = parseInt(document.getElementById("dibayar").innerText.replace(/[^\d]/g, "")) || 0;
                let kembalian = dibayar - subtotal;

                document.getElementById("kembalian").innerText = formatRupiah(kembalian > 0 ? kembalian : 0);
            }

            // Jalankan fungsi hitungKembalian setiap halaman dimuat
            hitungKembalian();
        });
    </script>
    <script src="/dist/js/app.js"></script>
</x-layout>
