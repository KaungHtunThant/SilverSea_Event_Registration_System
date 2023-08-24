@extends('admin.template')
@section('title', 'EMP - Customer Details')

@section('contents')
@if(Session::has('status'))
<script type="text/javascript">
    alert('{{ $status['text'] }}');
</script>
{{ Session::forget('status'); }}
@endif
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<a href="/visitors" class="btn btn-outline-primary btn-sm"><i class="mdi mdi-arrow-left"></i> Customer List</a>
				<h3 class="card-title my-4 text-center">{{ $visitor->conf_id }}'s Details</h3>
				<form action="/visitors/{{ $visitor->id }}" method="POST">
					@method('PATCH')
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								<label>Customer's ID</label>
								<input type="text" name="conf_id" value="{{ $visitor->conf_id }}" class="form-control mb-3" disabled>
							</div>
							<div class="col-md-6">
								<label>Customer's Phone No.</label>
								<input type="number" name="phone" value="{{ $visitor->phone }}" class="form-control mb-3">
							</div>
							<div class="col-md-12 mt-5">
								<input type="submit" name="submit" value="Update" class="btn btn-success">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('customjs')
@endsection