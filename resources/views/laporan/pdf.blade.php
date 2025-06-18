<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Arus Kas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 10px; }
        .footer { position: fixed; bottom: 10px; text-align: center; width: 100%; font-size: 10px; }
    </style>
</head>
<body>

    <h2>Laporan Arus Kas</h2>
    <p><strong>Tanggal Cetak:</strong> {{ date('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Total Pendapatan</th>
                <th>Total Pengeluaran</th>
                <th>Total Laba / Rugi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $data)
            <tr>
                <td>{{ $data->bulan }}</td>
                <td>Rp {{ number_format($data->total_pendapatan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($data->total_pengeluaran, 0, ',', '.') }}</td>
                <td>
                    @if ($data->laba_rugi >= 0)
                        <span style="color: green">Rp {{ number_format($data->laba_rugi, 0, ',', '.') }}</span>                        
                    @else 
                    <span style="color: red">Rp {{ number_format($data->laba_rugi, 0, ',', '.') }}</span>                        
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak oleh: {{ Auth::user()->nama }} - {{ date('d-m-Y') }}</p>
    </div>

</body>
</html>
