<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Power GLobal - ID Card</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style type="text/css">
		html{
/*			width: 8.3in;*/
/*			height: 11.7in;*/
			margin: 0px;
			padding: 0px;
		}
		body{
			width: 100%;
/*			height: 100vh;*/
			margin: 0px;
			padding: 0px;
			text-align: center;
		}

		.card-bg{
/*			height: 100vh;*/
/*			margin-left: 2.405in;*/
/*			padding-top: 100px;*/
			background-image: url('{{ url("images/mg_real_final/mg_bg_real_final.jpg") }}');
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
/*			background-color: red;*/
/*			padding: 5px;*/
/*			color: white;*/
/*			width: 100px;*/
/*			height: 50px;*/
/*			font-size: 20px;*/
/*			text-align: center;*/
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

		.h-max{
			height: 100%;
		}

		.w-max{
			width: 100%;
			max-width: 600px;
		}
	</style>
</head>
<body>
	<div class="container-fluid p-0">
		<div class="d-flex justify-content-center w-100">
			<div class="card-bg w-max" id="printarea">
				<div class="card-body p-0 pb-3">
					<img src="{{ url('images/mg_real_final/mg_header_real_final.png') }}" class="w-max">
					<div class="box mb-3">
						<h1><b>{{ $visitor->name }}</b></h1>
					</div>
					<div class="box mb-0">
						<h2><b>{{ $visitor->company }}</b></h2>
					</div>
					<br>
					<div class="mb-3">
						@php
							echo '<img class="qr" src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://zhejiangexpo.powerglobal.com.mm/id/'.$visitor->id, 'QRCODE',5.5,5.5) . '" alt="barcode"/>';
						@endphp
					</div>
					<img src="{{ url('images/mg_real_final/mg_footer_real_final.png') }}" class="w-max">
				</div>
			</div>
		</div>
		<button class="btn btn-danger btn-lg my-2 take-screenshot" id="capture-screenshot">Save Screenshot</button>
	</div>

	<div class="modal" id="screenshot-modal" tabindex="-1" role="dialog" aria-labelledby="Screenshot Modal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Registered successfully!</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Please take a screenshot of the QR code.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success take-screenshot" data-dismiss="modal">Take Screenshot</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript"
    src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
		const srcElement = document.getElementById('printarea'),
		btns = document.querySelectorAll("button.take-screenshot");

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
					a.download = "{{$visitor->conf_id}}_{{time()}}.jpg";
					a.click();
				});
			});
		});
	</script>
	<script type="text/javascript">
		$('#screenshot-modal').modal('show');
	</script>
</body>
</html>