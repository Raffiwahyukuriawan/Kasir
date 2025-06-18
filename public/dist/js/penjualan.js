let routeStore = "{{ route('temp_penjualan.store') }}";
let routeDelete = "{{ route('temp_penjualan.destroy', ':id') }}";

$(document).ready(function() {
    $('#product-select').select2({
        width: '100%'
    });

    $('#barcode-input').on('input', function() {
        let barcode = $(this).val().trim();
        let product = $('#product-select option[data-barcode="' + barcode + '"]');

        if (product.length > 0) {
            product.prop('selected', true);
            $('#product-select').val(product.val()).trigger('change');
        } else {
            $('#product-select').val("").trigger('change');
            alert("Barcode tidak ditemukan! Silakan pilih produk secara manual.");
        }
    });

    $('#product-select').change(function() {
        let selectedOption = $(this).find(':selected');
        let barcode = selectedOption.data('barcode');
        let nama_produk = selectedOption.text().trim();
        let harga = selectedOption.data('price');
        let no_nota = $('#nomor_nota').val();
        let jumlah = 1;

        if (barcode) {
            $('#barcode-input').val(barcode);
            addProduct(nama_produk, barcode, harga, no_nota, jumlah);
            setTimeout(() => {
                $('#barcode-input').focus();
            }, 100);
        }
    });

    function addProduct(nama_produk, barcode, harga, no_nota, jumlah) {
        if (!no_nota) {
            alert("Nomor Nota belum tersedia!");
            return;
        }

        $.ajax({
            url: routeStore,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                nama_produk,
                barcode,
                harga,
                no_nota,
                jumlah
            },
            success: function(response) {
                if (response.success) {
                    $('#nomor_nota').val(response.nomor_nota);
                    $('#barcode-input').val('');
                    $('#product-select').val('').trigger('change');
                    refreshTable();
                    setTimeout(() => {
                        $('#barcode-input').focus();
                    }, 100);
                } else {
                    alert("Gagal menambahkan produk: " + response.message);
                }
            },
            error: function(xhr) {
                alert("Gagal menambahkan produk! " + (xhr.responseJSON?.message ||
                    "Terjadi kesalahan"));
            }
        });
    }

    function refreshTable() {
        $.ajax({
            url: "{{ route('get_temp') }}",
            method: "GET",
            success: function(response) {
                updateTable(response.data);
            },
            error: function(xhr) {
                alert("Gagal memuat data terbaru! " + (xhr.responseJSON?.message ||
                    "Terjadi kesalahan"));
            }
        });
    }

    function updateTable(data) {
        let tableBody = $("#produkTableBody");
        tableBody.empty();

        let newData = Array.isArray(data) ? data : [data];

        newData.forEach((item, index) => {
            let row = `
        <tr>
            <td>${index + 1}</td>
            <td>${item.barcode}</td>
            <td>${item.nama_produk}</td>
            <td>Rp. ${new Intl.NumberFormat('id-ID').format(item.harga)}</td>
            <td>${item.jumlah}</td>
            <td>Rp. ${new Intl.NumberFormat('id-ID').format(item.harga * item.jumlah)}</td>
            <td>
                <button class="delete-btn text-red-500" data-id="${item.id}">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
            </td>
        </tr>`;
            tableBody.append(row);
        });

        bindDeleteEvent();
    }

    $(document).on("click", ".delete-btn", function() {
        let id = $(this).data("id");

        $.ajax({
            url: routeDelete.replace(":id", id),
            method: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                if (response.success) {
                    updateTable(response.data);
                } else {
                    alert("Gagal menghapus produk: " + response.message);
                }
            },
            error: function(xhr) {
                alert("Gagal menghapus produk! " + (xhr.responseJSON?.message ||
                    "Terjadi kesalahan"));
            }
        });
    });

    $("#resetTable").on("click", function() {
        if (!confirm("Apakah Anda yakin ingin menghapus semua data?")) return;

        $.ajax({
            url: "{{ route('temp_penjualan.reset') }}",
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                setTimeout(function() {
                    if (response.success) {
                        $("#produkTableBody").empty();
                        alert("Semua data berhasil dihapus!");
                    } else {
                        alert("Gagal menghapus data: " + response.message);
                    }
                }, 500);
            },
            error: function(xhr) {
                alert("Terjadi kesalahan! " + (xhr.responseJSON?.message ||
                    "Silakan coba lagi"));
            }
        });
    });

    refreshTable(); // Load data saat pertama kali halaman dibuka
});