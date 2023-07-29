@extends('admin.template')
@section('title', 'Visitors')
@section('contents')
	<div class="row">
		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Visitors list</h4>
					<div class="container-fluid">
						{{ $visitors->links('pagination::bootstrap-5') }}
					</div>
					<table class="table table-sm table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Confirmation ID</th>
								<th>Name</th>
								<th>Registered Date</th>
								<th>Config</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($visitors as $visitor)
							<tr>
								<td>{{ ($loop->index)+($paginate * $page)-($paginate-1) }}</td>
								<td>{{ $visitor->conf_id }}</td>
								<td>{{ $visitor->name }}</td>
								<td>{{ $visitor->created_at }}</td>
								<td><button class="btn btn-outline-primary btn-sm"><i class="mdi mdi-dots-vertical"></i></button></td>
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
		<div class="col-md-4 grid-margin">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Doughnut chart</h4>
					<canvas id="doughnutChart"></canvas>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('customjs')
<script type="text/javascript" src="{{ url('vendors/js/vendor.bundle.base.js') }}"></script>
<script type="text/javascript" src="{{ url('vendors/chart.js/Chart.min.js') }}"></script>

<script src="{{ url('js/off-canvas.js') }}"></script>
<script src="{{ url('js/hoverable-collapse.js') }}"></script>
<script src="{{ url('js/template.js') }}"></script>
<script src="{{ url('js/settings.js') }}"></script>
<script src="{{ url('js/todolist.js') }}"></script>

<script type="text/javascript" src="{{ url('js/visitor_chart.js') }}"></script>
@endsection