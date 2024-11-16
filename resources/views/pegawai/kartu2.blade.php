<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @page {
          size: 5.8in 4.1in landscape;
          margin: 0in;
        }
        table{
            border-collapse: collapse;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
            border: 5px solid #66b2b2;
        }
        table td {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
        }
        table td:first-child {
            border-left: none;
        }
        table td:last-child {
            border-right: none;
        }
        table tr:last-child {
            border-top: 1px solid #000;
        }
    </style>
</head>
<body>

<div style="width: 100%;">
    <h3 style="text-align:center;">KARTU PELANGGAN WIFI BAMS</h3>
    <table >
        <tr>
            <td width="60%">
                <img width="80%" src="data:image/png;base64,<?= base64_encode(file_get_contents( public_path('assets/img/logo.png')) )?>" alt="Image">
                
            </td>
            <td >
                <img width="80%" src="data:image/png;base64,<?= base64_encode(file_get_contents( public_path('assets/img/qr/qr.png')) )?>" alt="Image">
                
            </td>
        </tr>
        <tr>
            <td>Pembayaran Paling Lambat Tanggal 10</td>
            <td style="font-size: xx-large;text-transform: uppercase;"><b>{{ $user}}</b></td>
        </tr>
        
    </table>
</div>

</body>
</html>