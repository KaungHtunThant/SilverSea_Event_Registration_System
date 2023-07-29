@extends('admin.template')
@section('title', 'Visitors')
@section('contents')
	<div class="row">
		<div class="col-lg-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Visitors list</h4>
					<div class="container-fluid">
						{{ $visitors->links('pagination::bootstrap-5') }}
					</div>
					<table class="table table-sm table-hover">
						<thead>
							<tr>
								<th>Confirmation ID</th>
								<th>Name</th>
								<th>Registered Date</th>
								<th>Config</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($visitors as $visitor)
							<tr>
								<td>{{ $visitor->conf_id }}</td>
								<td>{{ $visitor->name}}</td>
								<td>{{ $visitor->created_at }}</td>
								<td><button class="btn btn-outline-success btn-sm"><i class="mdi mdi-dots-vertical"></i></button></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<br>
					<div class="container-fluid">
						{{ $visitors->links('pagination::bootstrap-5') }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection