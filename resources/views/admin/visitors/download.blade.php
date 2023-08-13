<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>IMS Silver Sea - ID Card</title>
	<style type="text/css">
		body{
			width: 898px;
			height: 1299px;
			margin: 0px;
			padding: 0px;
/*			background-image: url('{{ url("images/bg.jpg") }}');*/
			background-repeat: no-repeat;
		}

		.card-body{
			width: 100%;
			height: 4in;
			margin-top: 450px;
			text-align: center;
			font-family: "Calibri", sans-serif;
		}

		.box{
			width: 100%;
			height: 60px;
		}

		h1{
			font-size: 45px;
		}
	</style>
</head>
<body>
	<div class="card-body">
		<div class="box">
			<h1>{{ $visitor->name }}</h1>
		</div>
		<div class="box">
			<h1>{{ $visitor->position }}</h1>
		</div>
		<div class="box">
			<h1>{{ $visitor->company }}</h1>
		</div>
		<br>
		<div class="box">
			@php
				echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG(($visitor->id + 1000) . '-n' , 'C128' , 3,80) . '" alt="barcode"/>';
			@endphp
		</div>
	</div>
</body>
</html>