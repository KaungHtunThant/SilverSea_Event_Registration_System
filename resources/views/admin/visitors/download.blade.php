<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Power GLobal - ID Card</title>
	<style type="text/css">
		html{
/*			width: 8.3in;*/
/*			height: 11.7in;*/
			margin: 0px;
			padding: 0px;
		}
		body{
/*			width: 8.3in;*/
/*			height: 100vh;*/
			margin: 0px;
			padding: 0px;
			text-align: center;
		}

		.card-bg{
/*			height: 100vh;*/
/*			margin-left: 2.405in;*/
/*			padding-top: 100px;*/
			background-image: url('{{ url("images/mg_bg.jpg") }}');
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center;
		}

		.card-body{
			width: 100%;
/*			height: 4in;*/
/*			margin-left: 2.655in;*/
			text-align: center;
			color: white;
			font-family: "Calibri", sans-serif;
		}

		.box{
			width: 100%;
			height: 15px;
		}

		.qr{
			padding: 5px;
			background-color: white;
			border-radius: 4px;
		}

		#capture-screenshot{
			border-radius: 25px;
			background-color: red;
			padding: 5px;
			color: white;
			width: 100px;
			height: 50px;
			font-size: 20px;
			text-align: center;
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
<body>
	<div class="card-bg" id="printarea">
		<div class="card-body">
			<img src="{{ url('images/mg_header.jpg') }}" width="100%">
			<div class="box">
				<h1>{{ $visitor->name }}</h1>
			</div>
			<div class="box">
				<h2>{{ $visitor->company }}</h2>
			</div>
			<br>
			<div>
				@php
					echo '<img class="qr" src="data:image/png;base64,' . DNS2D::getBarcodePNG('http://192.168.30.18:8080/id/'.$visitor->id, 'QRCODE',5,5) . '" alt="barcode"/>';
				@endphp
			</div>
			<br>
			<br>
			<img src="{{ url('images/mg_footer.jpg') }}" width="100%">
		</div>
	</div>
	<button id="capture-screenshot">Save</button>

	<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript"
    src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
		const srcElement = document.getElementById('printarea'),
		btns = document.querySelectorAll("button");

		btns.forEach(btn => { // looping through each btn
			// adding click event to each btn
			btn.addEventListener("click", () => {
				// creating canvas of element using html2canvas
				html2canvas(srcElement).then(canvas => {
					// adding canvas/screenshot to the body
					if(btn.id === "take-src-only") {
						return document.body.appendChild(canvas);
					}

					// downloading canvas/screenshot
					const a = document.createElement("a");
					a.href = canvas.toDataURL();
					a.download = "screenshot.jpg";
					a.click();
				});
			});
		});
</script>
</body>
</html>