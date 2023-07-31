@extends('admin.template')
@section('title', 'Dashboard')
@section('contents')
    <div class="row">
        <div class="col-md-6 grid-margin transparent">
            <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Total</p>
                            <p class="fs-30 mb-2">4006</p>
                            <p>18Aug-21Aug</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4">Today</p>
                            <p class="fs-30 mb-2">61344</p>
                            <p id="today"></p>
                        </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4">Number of Meetings</p>
                            <p class="fs-30 mb-2">34040</p>
                            <p>2.00% (30 days)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                        <div class="card-body">
                            <p class="mb-4">Number of Clients</p>
                            <p class="fs-30 mb-2">47033</p>
                            <p>0.22% (30 days)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Charts</p>
                    <div class="charts-data">
                        <div class="mt-3">
                            <p class="mb-0">Data 1</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="progress progress-md flex-grow-1 mr-4">
                                    <div class="progress-bar bg-inf0" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">5k</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="mb-0">Data 2</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="progress progress-md flex-grow-1 mr-4">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">1k</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="mb-0">Data 3</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="progress progress-md flex-grow-1 mr-4">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 48%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">992</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="mb-0">Data 4</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="progress progress-md flex-grow-1 mr-4">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">687</p>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
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
        <div class="col-md-6 mt-3">
            <canvas id="north-america-chart"></canvas>
            <div id="north-america-legend"></div>
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
<script src="{{ url('js/dashboard.js') }}"></script>
<script src="{{ url('js/Chart.roundedBarCharts.js') }}"></script>
<script>
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    let today = document.getElementById("today");
    today.innerHTML = new Date().toLocaleDateString("en-US", options);
</script>
@endsection