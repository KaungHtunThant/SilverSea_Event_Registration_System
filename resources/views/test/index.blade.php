<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Test</title>
</head>
<body>
	@php
		echo '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://emp.powerglobal.com.mm/id/1234', 'QRCODE',2.2,2.2) . '" alt="barcode"   />';
	@endphp
</body>
</html>