<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Test</title>
</head>
<body>
	@php
		echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('2001-n', 'C128',1.5,40) . '" alt="barcode"   />';
		echo date('Y-m-d H:i:s', strtotime('today 2pm'));
	@endphp


</body>
</html>