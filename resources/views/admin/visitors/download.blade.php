<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>IMS Silver Sea - ID Card</title>
	<style type="text/css">
		html{
			width: 384px;
			height: 336in;
			margin: 0px;
			padding: 0px;
/*			padding-left: 4.2in;*/
		}
		body{
			width: 384in;
			margin: 0px;
			padding: 0px;
/*			text-align: center;*/
		}

		.card-bg{
			background-image: url('{{ url("images/bg2.jpg") }}');
			background-repeat: no-repeat;
			background-size: contain;
		}

		.card-body{
			width: 384in;
			height: 336in;
			padding-top: 125px;
			padding-bottom: -125px;
			text-align: center;
			font-family: "Calibri", sans-serif;
		}

		.box{
			width: 100%;
			height: 30px;
		}

		.qrbox{
			width: 100%;
			text-align: left;
			margin-left: 280px;
		}

		h1{
			@php
				$len = strlen($visitor->name);
			@endphp
			@if($len > 28)
				font-size: 27px;
			@else
				font-size: 32px;
			@endif
		}

		h2{
			font-size: 23px;
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
				<h2>{{ $visitor->company }}</h2>
			</div>
			<br>
			<div class="qrbox">
				
					<!-- echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG(($visitor->id + 1000) . '-b' , 'C128' , 2,40) . '" alt="QRcode"/>'; -->
				@php
					echo '<img class="qr" src="data:image/png;base64,' . DNS2D::getBarcodePNG('http://40.121.217.184/id/'.$visitor->conf_id, 'QRCODE',2.5,2.5) . '" alt="barcode"/>';
				@endphp
			</div>
		</div>
	</div>
	<script type="text/javascript">
		print();
	</script>
</body>
</html>