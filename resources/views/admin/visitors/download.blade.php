<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>IMS Silver Sea - ID Card</title>
	<style type="text/css">
		body{
			width: 718.32px;
			height: 1039.2px;
			border: 1px solid #666;
			border-radius: 5px;
			margin: 0px;
			padding: 0px;
		}

		.card-body{
			width: 100%;
			height: 4in;
			margin-top: 1.5in;
			margin-bottom: 0in;
			border: 1px solid #333;
			text-align: center;
		}

		h2{
			margin-bottom: 0.5in;
		}
	</style>
</head>
<body>
	<div class="card-body">
		<h2 style="margin-top: 0.5in;">{{ $visitor->name }}</h2>
		<h2>{{ $visitor->company }}</h2>
		<h2>Position</h2>
		@php
			echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG(($visitor->id + 1001) . '-n' , 'C128' , 2,50) . '" alt="barcode"/>';
		@endphp
	</div>
</body>
</html>