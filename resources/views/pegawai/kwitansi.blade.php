<html>
<head>
	<title>Print kwitansi </title>
	<style type="text/css">
			.lead {
				font-family: "Verdana";
				font-weight: bold;
			}
			.value {
				font-family: "Verdana";
			}
			.value-big {
				font-family: "Verdana";
				font-weight: bold;
				font-size: large;
			}
			.td {
				valign : "top";
			}

			/* @page { size: with x height */
			/*@page { size: 20cm 10cm; margin: 0px; }*/
			@page {
				size: A5 landscape;
				margin : 0px;
				
			}
	/*		@media print {
			  html, body {
			  	width: 210mm;
			  }
			}*/
			/*body { border: 2px solid #000000;  }*/
	</style>
	
</head>
<body>
	<div style="margin:auto;">

	<table border="1px">
		<tr>
			<td width="80px">
            <img width="200px" src="data:image/png;base64,<?= base64_encode(file_get_contents( public_path('assets/img/logo.png')) )?>" alt="Image">
            </td>
			<td>
				<table cellpadding="4">
					
					<tr>
						<td><div class="lead">Telah terima dari:</div></td>
						<td><div class="value">{{$bayar->customer->nama_cust}}</div></td>
					</tr>
					<tr>
						<td><div class="lead">Untuk Pembayaran:</div></td>
						<td><div class="value">Wifi Bulan {{$bayar->bulan_terbayar->format('F Y')}}</div></td>
					</tr>
					<tr>
						<td><div class="lead">Tanggal:</div></td>
						<td><div class="value">{{$bayar->tgl_pembayaran->format('d F Y')}}</div></td>
					</tr>
					<tr>
						<td><div class="lead">Rupiah:</div></td>
						<td><div class="value-big">Rp. {{$bayar->jumlah_bayar}}</div></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td><div class="lead">Kasir:</div></td>
						<td>____________________________________________________</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><div style="text-align:center;" class="value">{{$bayar->user->nama}}</div></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
	</div>
	<hr>
</body>
</html>