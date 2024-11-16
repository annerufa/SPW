<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table{
            caption-side: bottom;
            border-collapse: collapse;
        }
        th,tr,td{
            border: 1px solid black;
            text-align: left;
            padding-left: 2px;
        }
    </style>
</head>
<body>
    <div style="overflow-x: auto;">
        <h2>Rekap Data Pembayaran {{$tgl}} </h2>
        <div class="table-responsive text-nowrap">
        <table class="table" id="tabel-user" style="width: 100%;">
            <thead >
                <tr>
                    <th>No</th>
                    <th>Tgl-Bayar</th>
                    <th>Pelanggan</th>
                    <th>Alamat</th>
                    <th>Paket</th>
                    <th>Nominal</th>
                    <th>Metode Bayar</th>
                    <th>Tagihan Bulan</th>
                    <th>Pegawai</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="tabel-pegawai">
                @foreach($bayar as $no=>$bayar)
                <tr>
                    <td>{{ ++$no}}</td>
                    <td>{{ $bayar->tgl_pembayaran->format('d F Y') }}</td>
                    <td>{{ $bayar->customer->nama_cust}}</td>
                    <td>{{ $bayar->customer->alamat}}</td>
                    <td>{{ $bayar->customer->paket->bandwidth}}</td>
                    <td>{{ $bayar->jumlah_bayar }}</td>
                    <td>{{ $bayar->metode_bayar }}</td>
                    <td>{{ $bayar->bulan_terbayar->format('F Y') }}</td>
                    <td>{{ $bayar->user->nama }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    </div>
</body>
</html>