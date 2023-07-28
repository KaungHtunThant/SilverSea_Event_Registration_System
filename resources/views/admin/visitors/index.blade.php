@extends('admin.template')
@section('title', 'Visitors')
@section('contents')
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Visitors list</h4>
					<table class="table table-sm table-hover">
						<tr>
							<th>Confirmation ID</th>
							<th>Name</th>
							<th>Registered Date</th>
							<th>Config</th>
						</tr>
						@foreach ($visitors as $visitor)
						<tr>
							<td>{{ $visitor->conf_id }}</td>
							<td>{{ $visitor->name}}</td>
							<td>{{ $visitor->created_at }}</td>
							<td><button class="btn btn-success">More</button></td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection