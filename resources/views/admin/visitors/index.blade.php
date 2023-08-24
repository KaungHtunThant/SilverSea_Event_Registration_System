@extends('admin.template')
@section('title', 'EMP - Visitors')
@section('add_form')
    <div class="theme-setting-wrapper">
        <div id="theme-settings" class="settings-panel" style="overflow:scroll;">
            <i class="settings-close ti-close"></i>
            <p class="settings-heading text-success">Add New Customer</p>
            <form action="/visitors" method="POST" class="mx-2 mt-3" autocomplete="off">
                @csrf
                <input type="hidden" name="orderBy" value="conf_id">
				<input type="hidden" name="page" value="1">
				<input type="hidden" name="pagination" value="10">
                <div class="form-group">
                	<p>Customer ID (*)</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-account"></i>
                            </span>
                        </div>
                        <input type="text" name="name" class="form-control" placeholder="Enter name." required>
                    </div>
                    <p>Phone (*)</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-cellphone"></i>
                            </span>
                        </div>
                        <input type="number" name="phone" class="form-control" placeholder="Enter phone No." required>
                    </div>
                    <hr>
                    <input type="submit" name="Submit" value="Create" class="btn btn-success my-2">
                    <br class="mb-5">
                    <br class="mb-3">
                </div>
            </form>
        </div>
    </div>
@endsection
@section('contents')
@if(Session::has('status'))
<script type="text/javascript">
    alert('{{ $status['text'] }}');
</script>
{{ Session::forget('status'); }}
@endif
	<div class="row">
		<div class="col-md-12 col-lg-12 col-xl-10 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title mb-4">Visitors list</h4>
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-outline-success mb-4" id="settings-trigger2"><i class="mdi mdi-account-plus mr-2"></i>Add Visitor</button>
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
													<input type="submit" name="search" class="btn btn-sm btn-success" value="Search">
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
								<input type="submit" name="reset" value="Reset" class="btn btn-success float-right">
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
											" name="orderBy" value="conf_id">Customer ID</button>
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
										{{ $visitor->phone }}
									</td>
									<td>
										<div class="dropdown">
											<button class="btn btn-outline-success btn-sm" type="button" id="{{ $visitor->id }}-details" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="mdi mdi-dots-vertical"></i>
											</button>
											<div class="dropdown-menu" aria-labelledby="{{ $visitor->id }}-details">
												<a class="text-success dropdown-item py-3" href="{{
													'data:image/png;base64,' . DNS2D::getBarcodePNG('https://emp.powerglobal.com.mm/id/'.$visitor->id, 'QRCODE',2.2,2.2)
												}}" download="{{ htmlspecialchars($visitor->conf_id) }}">Download QR</a>
												<a class="text-success dropdown-item py-3" href="/visitors/{{ $visitor->id }}">Edit</a>
												<button class="text-success dropdown-item py-3" href="#">Delete</button>
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