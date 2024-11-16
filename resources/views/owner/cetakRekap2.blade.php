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
        <h2>Rekap Data Customer </h2>
        <div class="table-responsive text-nowrap">
        <table class="table" id="tabel-user" style="width: 100%;">
            <thead >
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>IP</th>
                    <th>Kode Cust</th>
                    <th>Area</th>
                    <th>Paket</th>
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th>Biaya Pemasangan</th>
                    <th>Tanggal Pemasangan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="tabel-pegawai">
                @foreach($customer as $no=>$cust)
                <tr>
                    <td>{{ ++$no}}</td>
                    <td>{{ $cust->nama_cust }}</td>
                    <td>{{ $cust->ip }}</td>
                    <td>{{ $cust->kode_cust }}</td>
                    <td>{{ $cust->area->nama_area }}</td>
                    <td>{{ $cust->paket->bandwidth }}</td>
                    <td>{{ $cust->alamat }}</td>
                    <td>{{ $cust->no_telp }}</td>
                    <td>{{ $cust->biaya_pemasangan }}</td>
                    <td>{{ $cust->tgl_pemasangan }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    </div>
</body>
</html>