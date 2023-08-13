<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>IMS Silver Sea - ID Card</title>
	<style type="text/css">
		html{
			width: 2.993in;
			height: 4.33in;
			margin: 0px;
			padding: 0px;
		}
		body{
			width: 2.993in;
			margin: 0px;
			padding: 0px;
			background-image: url('{{ url("images/bg.jpg") }}');
			background-repeat: no-repeat;
			background-size: cover;
		}

		.card-body{
			width: 100%;
			height: 4in;
			margin-top: 130px;
			text-align: center;
			font-family: "Calibri", sans-serif;
		}

		.box{
			width: 100%;
			height: 22px;
		}

		h1{
			font-size: 15px;
		}

		h2{
			font-size: 10px;
		}
	</style>
</head>
<body id="printarea">
	<div class="card-body">
		<div class="box">
			<h1>{{ $visitor->name }}</h1>
		</div>
		<div class="box">
			<h2>{{ $visitor->position }}</h2>
		</div>
		<div class="box">
			<h2>{{ $visitor->company }}</h2>
		</div>
		<br>
		<div class="box">
			@php
				echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG(($visitor->id + 1000) . '-n' , 'C128' , 2,40) . '" alt="barcode"/>';
			@endphp
		</div>
	</div>
	<script type="text/javascript">
		print();
	</script>
</body>
</html>