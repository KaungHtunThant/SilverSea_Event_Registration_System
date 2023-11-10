<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration</title>
	<link rel="stylesheet" href="{{ url('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
	<style type="text/css">
		.bg-img{
			background-image: url('{{ url("images/mg_bg_final.jpg") }}');
			background-size: cover;
		}

		.box{
		}
	</style>
</head>
<body>
	<div class="container m-0" id="printarea">
		<div class="box bg-img w-100 m-0 p-0">
			Hi
		</div>
	</div>

	<button id="capture-screenshot">Save</button>

	<!-- Button for screenshot -->
	

	<!-- JS -->
	<!-- <script src="{{ url('vendors/js/vendor.bundle.base.js') }}"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
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