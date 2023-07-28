<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Test</title>
</head>
<body>
	@php
		echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('01001', 'C39+',2,70) . '" alt="barcode"   />';
	@endphp
</body>
</html>