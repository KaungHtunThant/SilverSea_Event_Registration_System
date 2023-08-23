<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		body{
			width: 2.993 in;
			height: 4.33 in;
			border: 1px solid #666;
			border-radius: 5px;
		}

		.card-body{
			height: 2 in;
			padding-top: 0in;
			padding-bottom: 0in;
			border: 1px solid #333;
		}
	</style>
</head>
<body>
	<div class="card-body">
		<p>{{ $name }}</p>
		<p>{{ var_dump($status) }}</p>
	</div>
</body>
</html>