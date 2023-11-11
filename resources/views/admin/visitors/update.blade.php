@extends('admin.template')
@section('title', 'Power GLobal - Visitor Details')

@section('contents')
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
<div class="modal" id="screenshot-modal" tabindex="-1" role="dialog" aria-labelledby="Screenshot Modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Attendance recorded successfully!</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Please take a screenshot of the QR code.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success take-screenshot" data-dismiss="modal">Take Screenshot</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('customjs')
@endsection