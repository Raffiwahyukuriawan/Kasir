<x-layout>
    {{-- <x-header1 :title="$title"/> --}}
    <div class="content">
        <div id="myalert" style="margin-top: 10px; display: none;">
        </div>
        <div class="grid grid-cols-12 gap-6 mt-10">
            <div class="intro-y col-span-3">
                <!-- BEGIN: Keranjang -->
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                            Pilih produk terlebih dahulu
                        </h2>
                    </div>
                    <div class="p-5">
                        <form id="keranjangForm" action="" method="post">
                            <input type="hidden" name="kode_penjualan" value="2502031">
                            <div class="preview">
                                <div class="mt-1">
                                    <label>Nomor Nota</label>
                                    <input type="text" id="nomor_nota" class="input w-full border mt-2 bg-gray-100"
                                        value="" disabled>
                                </div>
                                <div class="mt-5">
                                    <div>
                                        <label>Produk</label>
                                        <div class="mt-2">
                                            <select id="product-select" class="select2 w-full">
                                                <option value="" class="defaultOption" selected disabled>Pilih
                                                    Produk</option>
                                                @foreach ($produks as $produk)
                                                    <option value="{{ $produk->id }}"
                                                        data-barcode="{{ $produk->barcode }}"
                                                        data-price="{{ $produk->harga }}">
                                                        {{ $produk->nama_produk }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <label>Masukkan Barcode Produk</label>
                                    <input type="text" class="input w-full border mt-2 bg-gray-100" name="barcode"
                                        id="barcode-input" autofocus autocomplete="off">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END: Keranjang -->
            </div>
            <div class="intro-y col-span-9">
                <!-- BEGIN: Bayar -->
                @if (session('error'))
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-3 bg-theme-6 text-white alert-box">
                        <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i>
                        {{ session('error') }}
                        <i data-feather="x" class="w-4 h-4 ml-auto close-alert" style="cursor: pointer;"></i>
                    </div>
                @endif
                <div class="intro-y box">
                    <div class="flex justify-between items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base">
                            Produk yang dipilih
                        </h2>
                        <button id="resetTable" style="outline:none;" type="button"
                            class="bg-red-700 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                            <i class="fas fa-sync-alt"></i> <!-- Ikon Reset -->
                        </button>
                    </div>
                    <div class="p-5">
                        <div class="overflow-x-auto">
                            <table class="table" id="produkTable">
                                <thead>
                                    <tr>
                                        <th class="border-b-2 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 whitespace-no-wrap">Kode Barang</th>
                                        <th class="border-b-2 whitespace-no-wrap">Produk</th>
                                        <th class="border-b-2 whitespace-no-wrap text-right">Harga</th>
                                        <th class="border-b-2 whitespace-no-wrap text-right">Jumlah</th>
                                        <th class="border-b-2 whitespace-no-wrap text-right">Total Harga</th>
                                        <th class="border-b-2 whitespace-no-wrap text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="produkTableBody">

                                </tbody>
                                <tfoot id="tfootTotal" style="display: none;">
                                    <tr id="totalRow">
                                        <td colspan="5" class="border-b border-t whitespace-no-wrap font-bold">Total
                                            Harga</td>
                                        <td class="border-b border-t whitespace-no-wrap text-right font-bold"
                                            id="totalHarga">Rp. 0</td>
                                        <td class="border-b border-t whitespace-no-wrap">-</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <form action="{{ route('proses_penjualan') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mt-3 pr-10 pl-10">
                                    <input type="number" class="input w-full border mt-2 text-xl"
                                        placeholder="Uang yang dibayar" min="1" required name="bayar"
                                        id="bayar" onkeyup="hitungKembalian()">
                                </div>
                                <div class="mt-1 pr-10 pl-10" id="bukti_transfer_container" style="display: none;">
                                    <label for="bukti" class="input border text-xl" id="bukti_label">Masukan bukti
                                        transfer</label>
                                    <input type="file" class="input border text-lg" name="bukti" id="bukti"
                                        accept=".jpeg, .jpg" onchange="updateBuktiLabel(this)">
                                </div>
                                <div class="mt-3 pr-10 pl-10">
                                    <input type="hidden" name="total_harga" id="total_harga">
                                    <input type="hidden" name="id_pelanggan" value="1">
                                    <h1 class="input w-full border mt-2 text-xl" id="sisa">Rp. 0</h1>
                                    <button type="submit"
                                        class="button w-32 mr-2 mb-2 mt-5 flex items-center justify-center bg-theme-1 text-white text-lg w-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-dollar-sign w-4 h-4 mr-2">
                                            <line x1="12" y1="1" x2="12" y2="23">
                                            </line>
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg> Bayar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END: Bayar -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- produk dan barcode --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            function formatRupiah(angka) {
                return angka.toLocaleString('id-ID'); // Format angka ke rupiah
            }

            // Fungsi untuk memuat data dari `temp_penjualan`
            function loadTempPenjualan() {
                $.ajax({
                    url: "{{ route('penjualan') }}", // Ganti dengan route yang sesuai
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        var produkTable = $('#produkTable tbody');
                        produkTable.empty();

                        if (response.length === 0) {
                            produkTable.append(
                                '<tr id="emptyRow">' +
                                '<td colspan="7" class="text-center text-gray-500">Belum ada produk yang dipilih.</td>' +
                                '</tr>'
                            );
                        } else {
                            $.each(response, function(index, item) {
                                var totalHarga = item.harga * item.jumlah;
                                produkTable.append(
                                    '<tr data-barcode="' + item.barcode + '">' +
                                    '<td class="border-b-2 whitespace-no-wrap">' + (index +
                                        1) + '</td>' +
                                    '<td class="border-b-2 whitespace-no-wrap">' + item
                                    .barcode + '</td>' +
                                    '<td class="border-b-2 whitespace-no-wrap">' + item
                                    .nama_produk + '</td>' +
                                    '<td class="border-b whitespace-no-wrap">' +
                                    '<input type="number" name="jumlah" value="' + item
                                    .jumlah +
                                    '" min="1" class="jumlah-input input w-20 border">' +
                                    '</td>' +
                                    '<td class="border-b-2 whitespace-no-wrap text-right">Rp. ' +
                                    formatRupiah(item.harga) + '</td>' +
                                    '<td class="border-b-2 whitespace-no-wrap text-right">Rp. ' +
                                    formatRupiah(totalHarga) + '</td>' +
                                    '<td class="border-b-2 whitespace-no-wrap text-center">' +
                                    '<button type="button" class="delete-row" data-id="' +
                                    item.id + '"><i class="fas fa-trash"></i></button>' +
                                    '</td>' +
                                    '</tr>'
                                );
                            });
                        }

                        updateTotal();
                    }
                });
            }

            // Event saat memilih produk dari dropdown
            $('#produkSelect').change(function() {
                var selectedOption = $(this).find(':selected');
                var produk_id = selectedOption.val(); // Ambil ID produk
                var barcode = selectedOption.data('barcode');
                var nama_produk = selectedOption.text().trim();
                var harga = selectedOption.data('harga') || 0;

                console.log("Produk dipilih:", produk_id, barcode, nama_produk, harga); // Debugging

                if (!produk_id) return; // Jika tidak ada produk, hentikan

                $.ajax({
                    url: "{{ route('temp_penjualan.store') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        produk_id: produk_id,
                        barcode: barcode,
                        nama_produk: nama_produk,
                        harga: harga,
                        jumlah: 1
                    },
                    success: function(response) {
                        console.log("Response dari server:", response);
                        loadTempPenjualan(); // Refresh tabel setelah produk ditambahkan
                    },
                    error: function(xhr) {
                        console.log("Error:", xhr.responseText);
                    }
                });

                // Reset dropdown setelah produk dipilih
                $('#produkSelect').val('');
            });


            // Fungsi untuk memperbarui total harga
            function updateTotal() {
                var total = 0;
                $('#produkTable tbody tr').each(function() {
                    var totalHargaText = $(this).find('td').eq(5).text().replace(/\D/g, '');
                    var totalHarga = parseInt(totalHargaText) || 0;
                    total += totalHarga;
                });

                $('#totalHarga').text('Rp. ' + formatRupiah(total));

                if (total === 0) {
                    $('#tfootTotal').hide();
                } else {
                    $('#tfootTotal').show();
                }
            }

            // Memuat data saat halaman pertama kali dibuka
            loadTempPenjualan();

            // Hapus produk dari tabel dan database `temp_penjualan`
            $('body').on('click', '.delete-row', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('temp_penjualan.delete') }}", // Ganti dengan route yang sesuai
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(response) {
                        loadTempPenjualan(); // Refresh tabel setelah dihapus
                    }
                });
            });

            // Event saat jumlah produk diubah
            $('body').on('input', '.jumlah-input', function() {
                var row = $(this).closest('tr');
                var jumlah = parseInt($(this).val()) || 1;
                var id = row.data('barcode');

                $.ajax({
                    url: "{{ route('temp_penjualan.update') }}", // Ganti dengan route yang sesuai
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        jumlah: jumlah
                    },
                    success: function(response) {
                        loadTempPenjualan(); // Refresh tabel setelah update jumlah
                    }
                });
            });
        });
    </script> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        let routeStore = "{{ route('temp_penjualan.store') }}";
        let routeGetTemp = "{{ route('get_temp') }}";
    </script>

    <script>
        $(document).ready(function() {
            console.log("Script berjalan, mencoba mengambil nomor nota...");

            function fetchNomorNota() {
                if (!$('#nomor_nota').val()) {
                    $.getJSON('/penjualan/get-no-nota', function(data) {
                        if (data.nomor_nota) {
                            $('#nomor_nota').val(data.nomor_nota);
                        }
                    }).fail(function() {
                        console.error('Fetch nomor nota error');
                    });
                }
            }
            setInterval(fetchNomorNota, 4000);

            $('#product-select').select2({
                width: '100%'
            });

            $('#barcode-input').on('input', function() {
                let barcode = $(this).val().trim();
                setTimeout(function() {
                    let product = $('#product-select option[data-barcode="' + barcode + '"]');
                    if (product.length > 0) {
                        let nama_produk = product.text(),
                            harga = product.data('price'),
                            no_nota = $('#nomor_nota').val(),
                            jumlah = 1;

                        product.prop('selected', true);
                        $('#product-select').val(product.val()).trigger('change');
                        if (no_nota) {
                            addProduct(nama_produk, barcode, harga, no_nota, jumlah);
                        } else {
                            alert("Nomor Nota belum tersedia!");
                        }
                    } else {
                        $('#product-select').val(null).trigger('change');
                        alert("Barcode tidak ditemukan! Pilih produk secara manual.");
                    }
                }, 300);
            });

            $('#product-select').on('select2:select', function(e) {
                let selectedOption = $(this).find('option:selected');
                let barcode = selectedOption.data('barcode'),
                    nama_produk = selectedOption.text(),
                    harga = selectedOption.data('price'),
                    no_nota = $('#nomor_nota').val(),
                    jumlah = 1;

                $('#barcode-input').val(barcode);
                if (barcode) {
                    addProduct(nama_produk, barcode, harga, no_nota, jumlah);
                    $('#product-select').select2('close');
                }
            });

            function addProduct(nama_produk, barcode, harga, no_nota, jumlah) {
                if (!no_nota) {
                    alert("Nomor Nota belum tersedia!");
                    return;
                }

                $.post(routeStore, {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    nama_produk,
                    barcode,
                    harga,
                    no_nota,
                    jumlah
                }).done(function(response) {
                    if (response.success) {
                        $('#nomor_nota').val(response.nomor_nota);
                        $('#barcode-input').val('');
                        $('#product-select').val(null).trigger('change');
                        refreshTable();
                        setTimeout(() => $('#barcode-input').focus(), 100);
                    } else {
                        alert("Gagal menambahkan produk: " + response.message);
                    }
                }).fail(function(xhr) {
                    alert("Gagal menambahkan produk! " + (xhr.responseJSON?.message ||
                    "Terjadi kesalahan"));
                });
            }

            function refreshTable() {
                $.get("{{ route('get_temp') }}", function(response) {
                    updateTable(response.data);
                }).fail(function(xhr) {
                    alert("Gagal memuat data! " + (xhr.responseJSON?.message || "Terjadi kesalahan"));
                });
            }

            function updateTable(data) {
                let tableBody = $("#produkTableBody").empty();
                let totalHarga = 0;

                data.forEach((item, index) => {
                    let row = `<tr>
                <td>${index + 1}</td>
                <td>${item.barcode}</td>
                <td>${item.nama_produk}</td>
                <td class="text-right">Rp. ${new Intl.NumberFormat('id-ID').format(item.harga)}</td>
                <td class="text-right">${item.jumlah}</td>
                <td class="text-right">Rp. ${new Intl.NumberFormat('id-ID').format(item.total_harga)}</td>
                <td class="text-center">
                    <button class="delete-btn text-red-500" data-id="${item.id}">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </td>
            </tr>`;
                    tableBody.append(row);
                    totalHarga += item.total_harga;
                });

                $("#totalHarga").text("Rp. " + new Intl.NumberFormat('id-ID').format(totalHarga));
                $("#total_harga").val(totalHarga);
                $("#tfootTotal").toggle(data.length > 0);
                bindDeleteEvent();
            }

            function bindDeleteEvent() {
                $("#produkTableBody").off("click", ".delete-btn").on("click", ".delete-btn", function() {
                    console.log("Klik tombol hapus"); // Cek apakah tombol diklik

                    let id = $(this).data("id");
                    let row = $(this).closest("tr");

                    console.log("ID produk:", id); // Cek apakah ID ada

                    if (!id) {
                        console.error("ID produk tidak ditemukan!");
                        return;
                    }

                    if (confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
                        $.ajax({
                            url: "/penjualan/delete/" + id,
                            type: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                            }
                        }).done(function(response) {
                            console.log("Respons dari server:",
                            response); // Cek respons dari server

                            if (response.success) {
                                console.log("Produk berhasil dihapus.");
                                row.remove();
                                refreshTable();
                            } else {
                                console.error("Gagal menghapus produk:", response);
                                alert("Gagal menghapus produk!");
                            }
                        }).fail(function(jqXHR, textStatus, errorThrown) {
                            console.error("Error AJAX:", textStatus, errorThrown);
                            console.error("Respons server:", jqXHR.responseText);
                            alert("Terjadi kesalahan saat menghapus produk.");
                        });
                    }
                });
            }


            $("#resetTable").on("click", function() {
                if (!confirm("Apakah Anda yakin ingin menghapus semua data?")) return;

                $.post("{{ route('temp_penjualan.reset') }}", {
                    _token: $('meta[name="csrf-token"]').attr("content")
                }).done(function(response) {
                    if (response.success) {
                        $("#produkTableBody").empty();
                        refreshTable();
                    } else {
                        alert("Gagal menghapus data: " + response.message);
                    }
                }).fail(function(xhr) {
                    alert("Terjadi kesalahan! " + (xhr.responseJSON?.message ||
                        "Silakan coba lagi"));
                });
            });

            $("#bayar_button").on("click", function(event) {
                event.preventDefault();
                if (!confirm("Apakah Anda yakin ingin menyelesaikan transaksi?")) return;

                let formData = new FormData($("form")[0]);

                fetch("{{ route('proses_penjualan') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    }
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        alert("Transaksi berhasil!");
                        window.location.href = "/invoice/" + data.id_penjualan;
                    } else {
                        alert("Gagal melakukan transaksi: " + data.message);
                    }
                }).catch(error => {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan saat memproses transaksi.");
                });
            });
            refreshTable();
        });
    </script>

    {{-- submit --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("bayar_button").addEventListener("click", function(event) {
                event.preventDefault(); // Mencegah submit default form

                if (!confirm("Apakah Anda yakin ingin menyelesaikan transaksi?")) {
                    return;
                }

                // **Perbarui nilai total harga sebelum submit**
                document.getElementById("total_harga").value = document.getElementById("totalHarga")
                    .innerText.replace(/[^\d]/g, '');

                let formData = new FormData(document.querySelector("form"));

                // **Menampilkan data yang dikirim dalam alert**
                let formDataEntries = [];
                formData.forEach((value, key) => {
                    formDataEntries.push(`${key}: ${value}`);
                });
                alert("Data yang dikirim:\n" + formDataEntries.join("\n"));

                fetch("{{ route('proses_penjualan') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Transaksi berhasil!");
                            window.location.href = "/invoice/" + data
                                .no_nota; // Redirect ke halaman invoice
                        } else {
                            alert("Gagal melakukan transaksi: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Terjadi kesalahan saat memproses transaksi.");
                    });
            });
        });
    </script>

    {{-- pembayaran --}}
    <script>
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        function hitungKembalian() {
            var totalHargaText = document.getElementById('totalHarga').innerText; // Ambil teks dari tabel
            var totalHarga = parseInt(totalHargaText.replace(/[^\d]/g, '')) || 0; // Bersihkan karakter selain angka

            var uangDibayar = parseInt(document.getElementById('bayar').value.replace(/[^\d]/g, '')) || 0;
            var kembalian = uangDibayar - totalHarga;

            console.log("Total Harga:", totalHarga);
            console.log("Uang Dibayar:", uangDibayar);
            console.log("Kembalian:", kembalian);

            if (kembalian >= 0) {
                document.getElementById('sisa').innerText = "Kembalian: Rp. " + formatRupiah(kembalian);
            } else {
                document.getElementById('sisa').innerText = "Kurang: Rp. " + formatRupiah(-kembalian);
            }

            // Update input hidden supaya dikirim ke server
            document.getElementById('total_harga').value = totalHarga;

        }
    </script>
    {{-- pembayaran - opsi --}}
    <script>
        function toggleBuktiInput() {
            let metode = document.getElementById("metode_pembayaran").value;
            let buktiContainer = document.getElementById("bukti_transfer_container");
            let buktiInput = document.getElementById("bukti");

            if (metode === "Transfer") {
                buktiContainer.style.display = "block";
                buktiInput.setAttribute("required", "required"); // Wajib upload bukti jika transfer
            } else {
                buktiContainer.style.display = "none";
                buktiInput.removeAttribute("required"); // Tidak perlu bukti jika tunai
            }
        }
    </script>
    {{-- penyembunyian total harga dan form --}}
    <script></script>
</x-layout>
