<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>IMS Silver Sea - ID Card</title>
</head>
<body>
	<h3>{{ $visitor->conf_id }}</h3>
	<h3>{{ $visitor->name }}</h3>
	<h3>{{ $visitor->company }}</h3>
	<h3>{{ $visitor->phone }}</h3>
	@php
		echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG(($visitor->id + 1001) . '-ndn' , 'C128' , 2,50) . '" alt="barcode"/>';
	@endphp
</body>
</html>