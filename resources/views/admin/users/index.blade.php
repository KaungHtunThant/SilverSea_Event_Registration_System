@extends('admin.template')
@section('title', 'Users')
@section('add_form')
    <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="mdi mdi-account-plus"></i></div>
        <div id="theme-settings" class="settings-panel" style="overflow:scroll;">
            <i class="settings-close ti-close"></i>
            <p class="settings-heading text-success">Add New User</p>
            <form action="/users" method="POST" class="mx-2 mt-3" autocomplete="off">
                @csrf
                <input type="hidden" name="orderBy" value="{{ $orderBy }}">
                <input type="hidden" name="page" value="{{ $page }}">
                <input type="hidden" name="paginate" value="{{ $paginate }}">
                <input type="hidden" name="searchVal" value="{{ $searchVal }}">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-account"></i>
                            </span>
                        </div>
                        <input type="text" name="name" class="form-control" placeholder="Enter name.">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-email"></i>
                            </span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="Enter email.">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-key"></i>
                            </span>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password.">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-key"></i>
                            </span>
                        </div>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password.">
                    </div>
                    <hr>
                    <input type="submit" name="Submit" value="Create" class="btn btn-success my-2">
                </div>
            </form>
        </div>
    </div>
@endsection
@section('contents')
	<div class="row">
		<div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Users List</h4>
                    <div class="row">
                        <div class="col-md-10">
                            <form action="/users" method="GET">
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
                            <form action="/users">
                                @csrf
                                <input type="hidden" name="paginate" value="10">
                                <input type="hidden" name="orderBy" value="id">
                                <input type="hidden" name="page" value="1">
                                <input type="submit" name="reset" value="Reset" class="btn btn-success float-right">
                            </form>
                        </div>
                    </div>
                    <div class="d-md-none mb-4"> </div>
                    <div class="container-fluid">
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover text-center">
                            <thead>
                                <tr>
                                    <th>
                                        <button type="submit" class="btn">#</button>
                                    </th>
                                    <th>
                                        <form action="/users" method="GET">
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
                                        <form action="/users" method="GET">
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
                                        <form action="/users" method="GET">
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
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ ($loop->index)+($paginate * $page)-($paginate-1) }}</td>
                                    <td>
                                        <div id="btn-{{ $user->id }}-name">
                                            {{ $user->name }}
                                            <button class="btn btn-link mx-0 px-0" onclick="update_func({{ $user->id }}, 'name')">
                                                <i class="ml-3 mdi mdi-pencil"></i>
                                            </button>
                                        </div>
                                        <form action="/users/{{ $user->id }}" id="inp-{{ $user->id }}-name" style="display: none;" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="orderBy" value="{{ $orderBy }}">
                                            <input type="hidden" name="page" value="{{ $page }}">
                                            <input type="hidden" name="pagination" value="{{ $paginate }}">
                                            <input type="hidden" name="searchVal" value="{{ $searchVal }}">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm" value="{{ $user->name }}" name="name">
                                                <div class="input-group-append">
                                                    <a class="btn btn-outline-danger btn-sm" onclick="close_func({{ $user->id }}, 'name')"><i class="mdi mdi-close"></i></a>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="submit" name="close" class="btn btn-outline-success btn-sm"><i class="mdi mdi-check"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <div id="btn-{{ $user->id }}-email">
                                            {{ $user->email }}
                                            <button class="btn btn-link mx-0 px-0" onclick="update_func({{ $user->id }}, 'email')">
                                                <i class="ml-3 mdi mdi-pencil"></i>
                                            </button>
                                        </div>
                                        <form action="/users/{{ $user->id }}" id="inp-{{ $user->id }}-email" style="display: none;" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="orderBy" value="{{ $orderBy }}">
                                            <input type="hidden" name="page" value="{{ $page }}">
                                            <input type="hidden" name="pagination" value="{{ $paginate }}">
                                            <input type="hidden" name="searchVal" value="{{ $searchVal }}">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm" value="{{ $user->email }}" name="email">
                                                <div class="input-group-append">
                                                    <a class="btn btn-outline-danger btn-sm" onclick="close_func({{ $user->id }}, 'email')"><i class="mdi mdi-close"></i></a>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="submit" name="close" class="btn btn-outline-success btn-sm"><i class="mdi mdi-check"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        {{ $user->created_at }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-success btn-sm" type="button" id="{{ $user->id }}-details" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="{{ $user->id }}-details">
                                                <a class="text-dark dropdown-item py-3" href="/users/{{ $user->id }}">Password reset</a>
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
                        {{ $users->links('pagination::bootstrap-5') }}
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
@endsection