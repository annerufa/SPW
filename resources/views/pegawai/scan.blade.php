<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="readere" width="300px" height="300px" style="width:300px">
    <!-- <input type="file" id="qr-input-file" accept="image/*"> -->
    <!-- 
    Or add captured if you only want to enable smartphone camera, PC browsers will ignore it.
    -->

    <!-- <input type="file" id="qr-input-file" accept="image/*" capture> -->
</div>
</body>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript">
// <script src="{{ URL::asset('assets/js/html5-qrcode.min.js')}}"></script>
<script>
  
function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    console.log(`Scan result: ${decodedText}`, decodedResult);
}

var html5QrcodeScanner = new Html5QrcodeScanner(
	"readere", { fps: 10, qrbox: {width: 250, height: 250} });
html5QrcodeScanner.render(onScanSuccess);

// Note: Current public API `scanFile` only returns the decoded text. There is
// another work in progress API (in beta) which returns a full decoded result of
// type `QrcodeResult` (check interface in src/core.ts) which contains the
// decoded text, code format, code bounds, etc.
// Eventually, this beta API will be migrated to the public API.
</script>
</html>