<!-- <!DOCTYPE html>
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
						<br> -->
						<!-- <label for="dob">Date of Birth</label> -->
						<!-- <input type="date" name="dob" id="dob" class="form-control">
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
</html> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="{{ url('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{ url('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ ('vendor/datepicker/daterangepicker.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-white p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
        	<img src="{{ url('images/banner.jpg') }}" class="w-100">
            <div class="card card-1">
                <div class="card-body">
                    <h2 class="title">Registration Info</h2>
                    <form method="POST" action="/form">
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="NAME" name="name" required>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="email" placeholder="E-MAIL" name="email" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="PHONE" name="phone" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1 js-datepicker" type="text" placeholder="BIRTHDATE" name="dob" required>
                                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="sex" required>
                                            <option disabled="disabled" selected="selected">GENDER</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="COMPANY (OPTIONAL)" name="company">
                                </div>
                            </div>
                        </div>
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Vendor JS-->
    <script src="{{ url('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ url('vendor/datepicker/moment.min.js') }}"></script>
    <script src="{{ url('vendor/datepicker/daterangepicker.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ url('js/global.js') }}"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
