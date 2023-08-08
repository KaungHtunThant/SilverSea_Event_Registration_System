@extends('admin.template')
@section('title', 'IMS Silver Sea - Winners')
@section('contents')
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Winners List</h4>
                    <div class="row">
                        <div class="col-md-10">
                            <form action="/winners" method="GET">
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
                            <form action="/winners">
                            	@csrf
                                <input type="hidden" name="paginate" value="10">
                                <input type="hidden" name="orderBy" value="winners.created_at">
                                <input type="hidden" name="page" value="1">
                                <input type="submit" name="reset" value="Reset" class="btn btn-primary float-right">
                            </form>
                        </div>
                    </div>
                    <div class="d-md-none mb-4"> </div>
                    <div class="container-fluid">
                        {{ $winners->links('pagination::bootstrap-5') }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover text-center">
                            <thead>
                                <tr>
                                    <th>
                                        <button type="submit" class="btn">#</button>
                                    </th>
                                    <th>
                                        <form action="/winners" method="GET">
                                        	@csrf
                                            <input type="hidden" name="paginate" value="{{ $paginate }}">
                                            <input type="hidden" name="page" value="{{ $page }}">
                                            <button type="submit" class="btn 
                                            @if($orderBy=='winners.created_at')
                                            btn-link
                                            @endif
                                            " name="orderBy" value="winners.created_at">Won Date</button>
                                        </form>
                                    </th>
                                    <th>
                                        <form action="/winners" method="GET">
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
                                        <form action="/winners" method="GET">
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
                                        <form action="/winners" method="GET">
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
                                        <form action="/winners" method="GET">
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
                                        <form action="/winners" method="GET">
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
                                        <form action="/winners" method="GET">
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
                                        <form action="/winners" method="GET">
                                        	@csrf
                                            <input type="hidden" name="paginate" value="{{ $paginate }}">
                                            <input type="hidden" name="page" value="{{ $page }}">
                                            <button type="submit" class="btn 
                                            @if($orderBy=='sex')
                                            btn-link
                                            @endif
                                            " name="orderBy" value="sex">Gender</button>
                                        </form>
                                    </th>
                                    <th>
                                        <form action="/" method="GET">
                                        	@csrf
                                            <input type="hidden" name="paginate" value="{{ $paginate }}">
                                            <input type="hidden" name="page" value="{{ $page }}">
                                            <button type="submit" class="btn 
                                            @if($orderBy=='winners.created_at')
                                            btn-link
                                            @endif
                                            " name="orderBy" value="winners.created_at">Registered Date</button>
                                        </form>
                                    </th>
                                    <th>
                                        <button type="submit" class="btn">Config</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($winners as $winner)
                                <tr>
                                    <td>{{ ($loop->index)+($paginate * $page)-($paginate-1) }}</td>
                                    <td>{{ $winner->att_created_at }}</td>
                                    <td>{{ $winner->conf_id }}</td>
                                    <td class="text-left">{{ $winner->name }}</td>
                                    <td class="text-left">{{ $winner->phone }}</td>
                                    <td class="text-left">{{ $winner->email }}</td>
                                    <td>{{ $winner->dob }}</td>
                                    <td>{{ $winner->company }}</td>
                                    <td>{{ $winner->sex }}</td>
                                    <td>{{ $winner->vis_created_at }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-primary btn-sm" type="button" id="{{ $winner->id }}-details" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="{{ $winner->id }}-details">
                                                <a class="text-primary dropdown-item py-3" href="#">Download ID Card</a>
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
                        {{ $winners->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
	</div>
	
@endsection
@section('customjs')
@endsection