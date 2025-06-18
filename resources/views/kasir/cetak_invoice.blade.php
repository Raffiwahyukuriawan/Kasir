<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="/dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Struk</title>
    <style>
        body {
            font-family: "Courier New", 'Courier New', Courier, monospace;
            width: 58mm;
            font-size: 12px;
            margin: 0;
            padding: 10px;
        }

        .center {
            align-items: center;
        }

        .bold {
            font-weight: bold;
        }

        .dotted {
            border-top: 1px dashed black;
        }

        .right {
            text-align: right;
            float: right
        }
    </style>
</head>

<body onload="window.print(); setTimeout(() => window.location.href = '/transaksi/kasir',1000)">
    <div class="center bold">Toko {{ $konfigurasi['nama_toko'] }}</div>
    <div class="center">Belanja Lengkap Dan Murah</div>
    <div class="center">{{ $konfigurasi['alamat'] }}</div>
    <div class="center">Telp {{ $konfigurasi['no_telp'] }}</div>
    <div class="center">------------------------------</div>

    <p style="margin-top: 1px">Tanggal: {{ date('d-m-Y H:i:s') }}</p>
    <p>Nota: {{ $transaksi->no_nota }}</p>
    <p style="margin-bottom: 1px; margin-top:1px">Kasir: {{ $transaksi->nama_kasir }}</p>

    <div class="dotted"></div>

    @foreach ($details as $detail)
        <p>
            {{ $detail->nama_produk }}<br>
            {{ $detail->jumlah }} x Rp. {{ number_format($detail->harga, 0, ',', '.') }}
            <span class="right">Rp.{{ number_format($detail->total_harga, 0, ',', '.') }}</span>
        </p>
    @endforeach

    <div class="dotted"></div>

    <p class="bold">Subtotal: <span class="right">Rp.{{ number_format($transaksi->total_harga, 0, ',', '.') }}</span></p>
    <p class="bold">Dibayar: <span class="right">Rp.{{ number_format($transaksi->bayar, 0, ',', '.') }}</span></p>
    <p class="bold">Kembalian: <span class="right">Rp.{{ number_format($transaksi->bayar - $transaksi->total_harga, 0, ',', '.') }}</span></p>

    <div class="dotted"></div>
    <div class="center">Terima Kasih!</div>
    <div class="center">Barang yang sudah dibeli</div>
    <div class="center">tidak dapat dikembalikan</div>
</body>

</html>
