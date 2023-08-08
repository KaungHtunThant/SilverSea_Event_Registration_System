@extends('admin.template')
@section('title', 'Visitors')
@section('add_form')
    <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="mdi mdi-account-plus"></i></div>
        <div id="theme-settings" class="settings-panel" style="overflow:scroll;">
            <i class="settings-close ti-close"></i>
            <p class="settings-heading text-primary">Add New Visitor</p>
            <form action="/visitors" method="POST" class="mx-2 mt-3" autocomplete="off">
                @csrf
                <input type="hidden" name="orderBy" value="conf_id">
				<input type="hidden" name="page" value="1">
				<input type="hidden" name="pagination" value="10">
                <div class="form-group">
                	<p>Name</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-account"></i>
                            </span>
                        </div>
                        <input type="text" name="name" class="form-control" placeholder="Enter name.">
                    </div>
                    <p>Phone</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-cellphone"></i>
                            </span>
                        </div>
                        <input type="text" name="phone" class="form-control" placeholder="Enter phone.">
                    </div>
                    <p>Email</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-email"></i>
                            </span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="Enter email.">
                    </div>
                    <p>Date of Birth</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-calendar"></i>
                            </span>
                        </div>
                        <input type="date" name="dob" class="form-control">
                    </div>
                    <p>Sex</p>
                    
                    <div class="mb-3">
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="sex" id="optionsRadios1" value="Male" checked>
								Male
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="sex" id="optionsRadios2" value="Female">
								Female
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="sex" id="optionsRadios3" value="Other">
								Other
							</label>
						</div>
                    </div>
                    <p>Company</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-account-multiple"></i>
                            </span>
                        </div>
                        <input type="text" name="company" class="form-control" placeholder="Enter Company.">
                    </div>
                    <hr>
                    <input type="submit" name="Submit" value="Create" class="btn btn-primary my-2">
                    <br class="mb-5">
                    <br class="mb-3">
                </div>
            </form>
        </div>
    </div>
@endsection
@section('contents')
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title mb-4">Visitors list</h4>
					<div class="row">
						<div class="col-md-10">
							<form action="/visitors" method="GET">
								@csrf
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
								@csrf
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
					<div class="table-responsive">
						<table class="table table-sm table-hover text-center">
							<thead>
								<tr>
									<th>
										<button type="submit" class="btn">#</button>
									</th>
									<th>
										<form action="/visitors" method="GET">
											@csrf
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
											@csrf
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
											@csrf
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
											@csrf
											<input type="hidden" name="paginate" value="{{ $paginate }}">
											<input type="hidden" name="page" value="{{ $page }}">
											<button type="submit" class="btn 
											@if($orderBy=='email')
											btn-link
											@endif
											" name="orderBy" value="email">Email</button>
										</form>
									</th>
									<th>
										<form action="/visitors" method="GET">
											@csrf
											<input type="hidden" name="paginate" value="{{ $paginate }}">
											<input type="hidden" name="page" value="{{ $page }}">
											<button type="submit" class="btn 
											@if($orderBy=='dob')
											btn-link
											@endif
											" name="orderBy" value="dob">Date of Birth</button>
										</form>
									</th>
									<th>
										<form action="/visitors" method="GET">
											@csrf
											<input type="hidden" name="paginate" value="{{ $paginate }}">
											<input type="hidden" name="page" value="{{ $page }}">
											<button type="submit" class="btn 
											@if($orderBy=='company')
											btn-link
											@endif
											" name="orderBy" value="company">Company</button>
										</form>
									</th>
									<th>
										<form action="/visitors" method="GET">
											@csrf
											<input type="hidden" name="paginate" value="{{ $paginate }}">
											<input type="hidden" name="page" value="{{ $page }}">
											<button type="submit" class="btn 
											@if($orderBy=='sex')
											btn-link
											@endif
											" name="orderBy" value="sex">Sex</button>
										</form>
									</th>
									<th>
										<form action="/visitors" method="GET">
											@csrf
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
									<td class="text-left">{{ $visitor->phone }}</td>
									<td class="text-left">{{ $visitor->email }}</td>
									<td>{{ $visitor->dob }}</td>
									<td>{{ $visitor->company }}</td>
									<td>{{ $visitor->sex }}</td>
									<td>{{ $visitor->created_at }}</td>
									<td>
										<div class="dropdown">
											<button class="btn btn-outline-primary btn-sm" type="button" id="{{ $visitor->id }}-details" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="mdi mdi-dots-vertical"></i>
											</button>
											<div class="dropdown-menu" aria-labelledby="{{ $visitor->id }}-details">
												<a class="text-primary dropdown-item py-3" href="/visitors/{{ $visitor->id }}">Download ID Card</a>
												<a class="text-danger dropdown-item py-3" href="#">Delete</a>
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
	</div>
	
@endsection
@section('customjs')
<script type="text/javascript" src="{{ url('js/visitor_chart.js') }}"></script>
@endsection