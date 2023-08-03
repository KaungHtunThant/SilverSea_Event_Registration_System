<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style type="text/css">
		.form-control{
			border: 0px;
			/*border-left: 0px;
			border-right: 0px;*/
			border-bottom: 1px solid #000;
			border-radius: 0px;
		}

		.form-control:focus{
			box-shadow: none;
		}
	</style>
</head>
<body>
	<div class="container shadow" style="max-width: 500px;">
		<div class="row">
			<div class="col-12 p-0">
				<img src="{{ url('images/banner.jpg') }}" class="img-fluid">
			</div>
			<div class="col-12 text-center my-5">
				<h3>Event Registration Form</h3>
			</div>
			<div class="col-12 p-5">
				<div class="form-group">
					<form action="/form" method="POST">
						<label for="name">Name</label>
						<input type="text" name="name" id="name" class="form-control" placeholder="Enter name.">
						<br>
						<label for="email">E-mail</label>
						<input type="email" name="email" id="email" class="form-control">
						<br>
						<label for="name">Phone</label>
						<input type="text" name="name" id="name" class="form-control">
						<br>
						<!-- <label for="dob">Date of Birth</label> -->
						<input type="date" name="dob" id="dob" class="form-control">
						<br>
						<label for="sex">Sex</label>
						<br>
						<br>
						<input type="radio" name="sex" id="male" value="male" class="mx-2">Male
						<input type="radio" name="sex" id="male" value="female" class="mx-2">Female
						<input type="radio" name="sex" id="male" value="other" class="mx-2">Other
						<br>
						<br>
						<label for="company">Company</label>
						<input type="text" name="company" id="company" class="form-control">
						<br>
						<input type="submit" class="btn btn-primary" name="submit" value="Register">
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>