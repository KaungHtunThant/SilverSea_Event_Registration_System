@extends('admin.template')
@section('title', 'Power GLobal - Visitors')
@section('add_form')
    <div class="theme-setting-wrapper">
        <div id="theme-settings" class="settings-panel" style="overflow:scroll;">
            <i class="settings-close ti-close"></i>
            <p class="settings-heading text-danger">Add New Visitor</p>
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
                        <input type="text" name="name" class="form-control" placeholder="Enter name." required>
                    </div>
                    <p>Phone</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-cellphone"></i>
                            </span>
                        </div>
                        <input type="number" name="phone" class="form-control" placeholder="Enter phone No." required>
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
                    <p>Company/ Organization</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-account-multiple"></i>
                            </span>
                        </div>
                        <input type="text" name="company" class="form-control" placeholder="Enter Company." required>
                    </div>
                    <p>Interests</p>
                    <div class="input-group mb-1">
                        <input class="form-check-input ml-3" type="checkbox" name="pos[]" value="Clothings" id="pos1">
                        <label class="form-check-label ml-5" for="pos1">
                            Clothings
                        </label>
                    </div>
                    <div class="input-group mb-1">
                        <input class="form-check-input ml-3" type="checkbox" name="pos[]" value="Fabrics and Accessories" id="pos2">
                        <label class="form-check-label ml-5" for="pos2">
                            Fabrics and Accessories
                        </label>
                    </div>
                    <div class="input-group mb-1">
                        <input class="w-auto form-check-input ml-3" type="checkbox" name="pos[]" value="Machinery" id="pos3">
                        <label class="form-check-label ml-5" for="pos3">
                            Machinery
                        </label>
                    </div>
                    <div class="input-group mb-1">
                        <input class="form-check-input ml-3" type="checkbox" name="pos[]" value="Bags" id="pos4">
                        <label class="form-check-label ml-5" for="pos4">
                            Bags
                        </label>
                    </div>
                    <div class="input-group mb-1">
                        <input class="form-check-input ml-3" type="checkbox" name="pos[]" value="Shoes" id="pos5">
                        <label class="form-check-label ml-5" for="pos5">
                            Shoes
                        </label>
                    </div>
                    <div class="input-group mb-1">
                        <input class="form-check-input ml-3" type="checkbox" name="pos[]" value="Others" id="pos6">
                        <label class="form-check-label ml-5" for="pos6">
                            Others
                        </label>
                    </div>
                    <hr>
                    <input type="submit" name="Submit" value="Create" class="btn btn-danger my-2">
                    <br class="mb-5">
                    <br class="mb-3">
                </div>
            </form>
        </div>
    </div>
@endsection
@section('contents')
	<div class="row">
		<div class="col-md-12 col-lg-12 col-xl-10 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title mb-4">Visitors list</h4>
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-outline-danger mb-4" id="settings-trigger2"><i class="mdi mdi-account-plus mr-2"></i>Add Visitor</button>
							<a href="/visitors/export" class="btn btn-danger ml-4 mb-4">Export</a>
						</div>
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
													<input type="submit" name="search" class="btn btn-sm btn-danger" value="Search">
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
								<input type="submit" name="reset" value="Reset" class="btn btn-danger float-right">
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
											btn-link text-warning
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
											btn-link text-warning
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
											btn-link text-warning
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
											btn-link text-warning
											@endif
											" name="orderBy" value="email">Email</button>
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
									<td class="text-center">
										{{ ($loop->index)+($paginate * $page)-($paginate-1) }}
									</td>
									<td class="text-center">
										{{ $visitor->conf_id }}
									</td>
									<td>
										{{ $visitor->name }}
									</td>
									<td>
										{{ $visitor->phone }}
									</td>
									<td>
										{{ $visitor->email }}
									</td>
									<td>
										<div class="dropdown">
											<button class="btn btn-outline-danger btn-sm" type="button" id="{{ $visitor->id }}-details" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="mdi mdi-dots-vertical"></i>
											</button>
											<div class="dropdown-menu" aria-labelledby="{{ $visitor->id }}-details">
												<a class="text-success dropdown-item py-3" href="/visitors/download/{{ $visitor->id }}" target="_blank">Download ID Card</a>
												<a class="text-success dropdown-item py-3" href="/visitors/{{ $visitor->id }}">Edit</a>
												<button class="text-danger dropdown-item py-3" href="#">Delete</button>
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
<script type="text/javascript">
	function update_func(id, cat){
		let btn = document.getElementById('btn-'+id+'-'+cat);
		btn.style.display = "none";
		let inp = document.getElementById('inp-'+id+'-'+cat);
		inp.style.display = "block";
		inp.focus();
	}

	function close_func(id, cat){
		let inp = document.getElementById('inp-'+id+'-'+cat);
		inp.style.display = "none";
		let btn = document.getElementById('btn-'+id+'-'+cat);
		btn.style.display = "block";
	}
</script>
<script type="text/javascript">
    // Turn off the value scrolling behaviour on all fields
    document.addEventListener("wheel", function(event){
        if(document.activeElement.type === "number"){
            document.activeElement.blur();
        }
    });
</script>
@endsection