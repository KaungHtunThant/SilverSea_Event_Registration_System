<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>IMS Silver Sea - ID Card</title>
	<style type="text/css">
		html{
			width: 8.3in;
			height: 11.7in;
			margin: 0px;
			padding: 0px;
		}
		body{
			width: 8.3in;
			margin: 0px;
			padding: 0px;
/*			text-align: center;*/
		}

		.card-bg{
			width: 2.99in;
			margin-left: 2.405in;
			padding-top: 100px;
			background-image: url('{{ url("images/bg.jpg") }}');
			background-repeat: no-repeat;
			background-size: contain;
		}

		.card-body{
			width: 2.99in;
			height: 4in;
/*			margin-left: 2.655in;*/
			text-align: center;
			
			font-family: "Calibri", sans-serif;
		}

		.box{
			width: 100%;
			height: 15px;
		}

		h1{
			@php
				$len = strlen($visitor->name);
			@endphp
			@if($len > 28)
				font-size: 16px;
			@else
				font-size: 20px;
			@endif
		}

		h2{
			font-size: 16px;
		}
	</style>
</head>
<body id="printarea">
	<div class="card-bg">
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
					echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG(($visitor->id + 1000) . '-b' , 'C128' , 2,40) . '" alt="barcode"/>';
				@endphp
			</div>
		</div>
	</div>
	<script type="text/javascript">
		print();
	</script>
</body>
</html>