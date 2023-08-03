@extends('admin.template')
@section('title', 'Dashboard')
@section('contents')
    <div class="row">
        <div class="col-md-3 grid-margin stretch-card">
            <div class="row">
                <div class="col-md-12 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Today’s Bookings</p>
                            <p class="fs-30 mb-2">4006</p>
                            <p>10.00% (30 days)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4">Today’s Bookings</p>
                            <p class="fs-30 mb-2">4006</p>
                            <p>10.00% (30 days)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Doughnut chart</h4>
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
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
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Visitors' Attendance List</h4>
                    <div class="row">
                        <div class="col-md-10">
                            <form action="/" method="GET">
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
                            <form action="/">
                                <input type="hidden" name="paginate" value="10">
                                <input type="hidden" name="orderBy" value="attendances.created_at">
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
                                        <form action="/" method="GET">
                                            @csrf
                                            <input type="hidden" name="paginate" value="{{ $paginate }}">
                                            <input type="hidden" name="page" value="{{ $page }}">
                                            <button type="submit" class="btn 
                                            @if($orderBy=='attendances.created_at')
                                            btn-link
                                            @endif
                                            " name="orderBy" value="attendances.created_at">Entry Date</button>
                                        </form>
                                    </th>
                                    <th>
                                        <form action="/" method="GET">
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
                                        <form action="/" method="GET">
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
                                        <form action="/" method="GET">
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
                                        <form action="/" method="GET">
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
                                        <form action="/" method="GET">
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
                                        <form action="/" method="GET">
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
                                        <form action="/" method="GET">
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
                                        <form action="/" method="GET">
                                            @csrf
                                            <input type="hidden" name="paginate" value="{{ $paginate }}">
                                            <input type="hidden" name="page" value="{{ $page }}">
                                            <button type="submit" class="btn 
                                            @if($orderBy=='visitors.created_at')
                                            btn-link
                                            @endif
                                            " name="orderBy" value="visitors.created_at">Registered Date</button>
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
                                    <td>{{ $visitor->att_created_at }}</td>
                                    <td>{{ $visitor->conf_id }}</td>
                                    <td class="text-left">{{ $visitor->name }}</td>
                                    <td class="text-left">{{ $visitor->phone }}</td>
                                    <td class="text-left">{{ $visitor->email }}</td>
                                    <td>{{ $visitor->dob }}</td>
                                    <td>{{ $visitor->company }}</td>
                                    <td>{{ $visitor->sex }}</td>
                                    <td>{{ $visitor->vis_created_at }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-primary btn-sm" type="button" id="{{ $visitor->id }}-details" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="{{ $visitor->id }}-details">
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
                        {{ $visitors->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customjs')
<script>
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    let today = document.getElementById("today");
    today.innerHTML = new Date().toLocaleDateString("en-US", options);
</script>
<script type="text/javascript" src="{{ url('js/visitor_chart.js') }}"></script>
@endsection