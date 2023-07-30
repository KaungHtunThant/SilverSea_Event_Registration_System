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
								<div class="form-group">
									<div class="row">
										<div class="col-md-3 mb-3">
											<input type="hidden" name="orderBy" value="{{ $orderBy }}">
											<input type="hidden" name="page" value="1">
											<div class="input-group">
												<div class="input-group-prepend" style="margin-top: -1px;">
													<span class="input-group-text" style="padding-bottom: 10px;">
														<i class=" mdi mdi-code-tags"></i>
													</span>
												</div>
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
								</div>
							</form>
						</div>
						<div class="col-md-2">
							<form action="/visitors">
								<input type="hidden" name="paginate" value="10">
								<input type="hidden" name="orderBy" value="conf_id">
								<input type="hidden" name="page" value="1">
								<input type="submit" name="reset" value="Reset" class="btn btn-primary float-right">
							</form>
						</div>
					</div>
					<div class="d-md-none mb-4"> </div>
					<div class="container-fluid">
						{{ $visitors->links('pagination::bootstrap-5') }}
					</div>
					<div class="d-none d-md-block ">
						<table class="table table-sm table-hover text-center">
							<thead>
								<tr>
									<th>
										<button type="submit" class="btn">#</button>
									</th>
									<th>
										<form action="/visitors" method="GET">
											<input type="hidden" name="paginate" value="{{ $paginate }}">
											<input type="hidden" name="page" value="{{ $page }}">
											<button type="submit" class="btn 
											@if($orderBy=='conf_id')
											btn-link
											@endif
											" name="orderBy" value="conf_id">Confirmation ID</button>
										</form>
									</th>
									<th>
										<form action="/visitors" method="GET">
											<input type="hidden" name="paginate" value="{{ $paginate }}">
											<input type="hidden" name="page" value="{{ $page }}">
											<button type="submit" class="btn 
											@if($orderBy=='name')
											btn-link
											@endif
											" name="orderBy" value="name">Name</button>
										</form>
									</th>
									<th>
										<form action="/visitors" method="GET">
											<input type="hidden" name="paginate" value="{{ $paginate }}">
											<input type="hidden" name="page" value="{{ $page }}">
											<button type="submit" class="btn 
											@if($orderBy=='phone')
											btn-link
											@endif
											" name="orderBy" value="phone">Phone</button>
										</form>
									</th>
									<th>
										<form action="/visitors" method="GET">
											<input type="hidden" name="paginate" value="{{ $paginate }}">
											<input type="hidden" name="page" value="{{ $page }}">
											<button type="submit" class="btn 
											@if($orderBy=='created_at')
											btn-link
											@endif
											" name="orderBy" value="created_at">Registered Date</button>
										</form>
									</th>
									<th>
										<button type="submit" class="btn">Config</button>
									</th>
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
									<td>
										<div class="dropdown">
											<button class="btn btn-outline-primary btn-sm" type="button" id="{{ $visitor->id }}-more" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="mdi mdi-dots-vertical"></i>
											</button>
											<div class="dropdown-menu" aria-labelledby="{{ $visitor->id }}-more">
												<div class="dropdown-item">
													<button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#{{ $visitor->id }}-details">
														Details
													</button>
												</div>
												<button class="btn btn-link dropdown-item">Delete</button>
											</div>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="d-md-none">
						<table class="table table-sm table-hover table-responsive text-center">
							<thead>
								<tr>
									<th>
										<button type="submit" class="btn">#</button>
									</th>
									<th>
										<form action="/visitors" method="GET">
											<input type="hidden" name="paginate" value="{{ $paginate }}">
											<input type="hidden" name="page" value="{{ $page }}">
											<button type="submit" class="btn 
											@if($orderBy=='conf_id')
											btn-link
											@endif
											" name="orderBy" value="conf_id">Confirmation ID</button>
										</form>
									</th>
									<th>
										<form action="/visitors" method="GET">
											<input type="hidden" name="paginate" value="{{ $paginate }}">
											<input type="hidden" name="page" value="{{ $page }}">
											<button type="submit" class="btn 
											@if($orderBy=='name')
											btn-link
											@endif
											" name="orderBy" value="name">Name</button>
										</form>
									</th>
									<th>
										<form action="/visitors" method="GET">
											<input type="hidden" name="paginate" value="{{ $paginate }}">
											<input type="hidden" name="page" value="{{ $page }}">
											<button type="submit" class="btn 
											@if($orderBy=='phone')
											btn-link
											@endif
											" name="orderBy" value="phone">Phone</button>
										</form>
									</th>
									<th>
										<form action="/visitors" method="GET">
											<input type="hidden" name="paginate" value="{{ $paginate }}">
											<input type="hidden" name="page" value="{{ $page }}">
											<button type="submit" class="btn 
											@if($orderBy=='created_at')
											btn-link
											@endif
											" name="orderBy" value="created_at">Registered Date</button>
										</form>
									</th>
									<th>
										<button type="submit" class="btn">Config</button>
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($visitors as $visitor)
								<tr>
									<td>{{ ($loop->index)+($paginate * $page)-($paginate-1) }}</td>
									<td>{{ $visitor->conf_id }}</td>
									<td class="text-left">{{ $visitor->name }}</td>
									<td>{{ $visitor->phone }}</td>
									<td>{{ $visitor->created_at }}</td>
									<td>
										<div class="dropdown">
											<button class="btn btn-outline-primary btn-sm" type="button" id="{{ $visitor->id }}-details" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="mdi mdi-dots-vertical"></i>
											</button>
											<div class="dropdown-menu" aria-labelledby="{{ $visitor->id }}-details">
												<button class="btn btn-link dropdown-item my-2">Details</button>
												<button class="btn btn-link dropdown-item my-2">Delete</button>
											</div>
										</div>
									</td>
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
	@foreach ($visitors as $visitor)
    <!-- <div class="modal fade" id="" tabindex="-1" aria-labelledby="{{ $visitor->id }}-details" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-custom text-light">
                <div class="modal-header bg-dark">
                    <h6 class="modal-title">{{$visitor->conf_id}}<br>{{$visitor->name}}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                   
                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->
	<div class="modal fade" id="{{ $visitor->id }}-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">{{$visitor->name}}</h5>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<p>This is a modal with default size</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
    @endforeach
<script type="text/javascript" src="{{ url('js/visitor_chart.js') }}"></script>
@endsection