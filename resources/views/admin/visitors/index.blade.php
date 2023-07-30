@extends('admin.template')
@section('title', 'Visitors')
@section('contents')
	<div class="row">
		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Visitors list</h4>
					<div class="row">
						<div class="col-md-10">
							<form action="/visitors" method="GET">
								<div class="row">
									<div class="col-md-2 mb-3">
										<input type="hidden" name="orderBy" value="{{ $orderBy }}">
										<input type="hidden" name="page" value="1">
										<select onchange="this.form.submit()" name="paginate" class="form-control form-control-sm">
											<option value="5" 
											@if($paginate==5)
											selected
											@endif>5</option>
											<option value="10"
											@if($paginate==10)
											selected
											@endif>10</option>
											<option value="20"
											@if($paginate==20)
											selected
											@endif>20</option>
											<option value="30"
											@if($paginate==30)
											selected
											@endif>30</option>
										</select>
									</div>
									<div class="col-md">
										<div class="input-group">
											<input type="text" name="searchVal" class="form-control form-control-sm" value="{{ $searchVal }}">
											<div class="input-group-append">
												<input type="submit" name="search" class="btn btn-sm btn-primary" value="Search">
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="col-md-2">
							<form action="/visitors">
								<input type="hidden" name="paginate" value="10">
								<input type="hidden" name="orderBy" value="conf_id">
								<input type="hidden" name="page" value="1">
								<div class="d-md-none mb-3"> </div>
								<input type="submit" name="reset" value="Reset" class="btn btn-primary">
								<div class="d-md-none mb-3"> </div>
							</form>
						</div>
					</div>
					<div class="container-fluid">
						{{ $visitors->links('pagination::bootstrap-5') }}
					</div>
					<div class="d-none d-md-block ">
						<table class="table table-sm table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Confirmation ID</th>
									<th>Name</th>
									<th>Phone</th>
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
									<td>{{ $visitor->phone }}</td>
									<td>{{ $visitor->created_at }}</td>
									<td><button class="btn btn-outline-primary btn-sm"><i class="mdi mdi-dots-vertical"></i></button></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="d-md-none">
						<table class="table table-sm table-hover table-responsive">
							<thead>
								<tr>
									<th>#</th>
									<th>Confirmation ID</th>
									<th>Name</th>
									<th>Phone</th>
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
									<td>{{ $visitor->phone }}</td>
									<td>{{ $visitor->created_at }}</td>
									<td><button class="btn btn-outline-primary btn-sm"><i class="mdi mdi-dots-vertical"></i></button></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
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