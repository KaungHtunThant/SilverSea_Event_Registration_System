@extends('admin.template')
@section('title', 'EMP - Visitor Details')

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
				<a href="/visitors" class="btn btn-outline-primary btn-sm"><i class="mdi mdi-arrow-left"></i> Visitors List</a>
				<h3 class="card-title my-4 text-center">{{ $visitor->conf_id }}'s Details</h3>
				<form action="/visitors/{{ $visitor->id }}" method="POST">
					@method('PATCH')
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								<label>Visitor's Name</label>
								<input type="text" name="name" value="{{ $visitor->name }}" class="form-control mb-3">
							</div>
							<div class="col-md-6">
								<label>Visitor's Phone No.</label>
								<input type="number" name="phone" value="{{ $visitor->phone }}" class="form-control mb-3">
							</div>
							<div class="col-md-6">
								<label>Visitor's Email</label>
								<input type="text" name="email" value="{{ $visitor->email }}" class="form-control mb-3">
							</div>
							<div class="col-md-6">
								<label>Visitor's Gender</label>
								<select class="form-control mb-3" name="sex">
									<option value="Male" @if ($visitor->sex == 'Male')selected
									@endif>Male</option>
									<option value="Female" @if ($visitor->sex == 'Female')selected
									@endif>Female</option>
								</select>
							</div>
							<div class="col-md-6">
								<label>Visitor's Occupation</label>
								<input type="text" name="position" value="{{ $visitor->position }}" class="form-control mb-3">
							</div>
							<div class="col-md-6">
								<label>Visitor's Company</label>
								<input type="text" name="company" value="{{ $visitor->company }}" class="form-control mb-3">
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