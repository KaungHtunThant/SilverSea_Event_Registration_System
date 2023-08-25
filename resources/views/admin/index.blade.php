@extends('admin.template')
@section('title', 'EMP - Dashboard')
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
                                <i class="mdi mdi-cellphone"></i>
                            </span>
                        </div>
                        <input type="text" name="conf_id" class="form-control" placeholder="Enter Customer ID" required>
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
    <div class="row">
        <div class="col-12 col-md-4 mb-4 transparent stretch-card" id="settings-trigger2">
            <div class="card card-success">
                <div class="card-body text-center">
                    <p class="">New Customer</p>
                    <i class="mdi mdi-account-plus fs-50"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 mb-4 transparent">
            <div class="card card-dark-blue">
                <div class="card-body">
                    <p class="mb-4">Total Customers</p>
                    <p class="fs-30 mb-2">{{ $Vtotal }} / 150</p>
                    <p><nobr>25-Aug - 9-Sep</nobr></p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 mb-4 transparent">
            <div class="card card-light-blue">
                <div class="card-body">
                    <p class="mb-4">Today’s Attendance</p>
                    <p class="fs-30 mb-2">{{ $Vtoday }}</p>
                    <p>{{ date('d-M') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Customers' Attendance List</h4>
                    <div class="row">
                        <div class="col-md-10">
                            <form action="/" method="GET">
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
                        <div class="col-sm-2">
                            <form action="/">
                                @csrf
                                <input type="hidden" name="paginate" value="10">
                                <input type="hidden" name="orderBy" value="attendances.created_at">
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
                                        <form action="/" method="GET">
                                            @csrf
                                            <input type="hidden" name="paginate" value="{{ $paginate }}">
                                            <input type="hidden" name="page" value="{{ $page }}">
                                            <button type="submit" class="btn 
                                            @if($orderBy=='attendances.created_at')
                                            btn-link text-warning
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
                                            btn-link text-warning
                                            @endif
                                            " name="orderBy" value="conf_id">Customer ID</button>
                                        </form>
                                    </th>
                                    <th>
                                        <form action="/" method="GET">
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
                                        <form action="/" method="GET">
                                            @csrf
                                            <input type="hidden" name="paginate" value="{{ $paginate }}">
                                            <input type="hidden" name="page" value="{{ $page }}">
                                            <button type="submit" class="btn 
                                            @if($orderBy=='visitors.created_at')
                                            btn-link text-warning
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
                                    <td>{{ $visitor->phone }}</td>
                                    <td>{{ $visitor->vis_created_at }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-success btn-sm" type="button" id="{{ $visitor->id }}-details" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="{{ $visitor->id }}-details">
                                                <a class="text-success dropdown-item py-3" href="{{
                                                    'data:image/png;base64,' . DNS2D::getBarcodePNG('https://emp.powerglobal.com.mm/id/'.$visitor->id, 'QRCODE',2.2,2.2)
                                                }}" download="{{ htmlspecialchars($visitor->conf_id) }}">Download QR</a>
                                                <a class="text-success dropdown-item py-3" href="#">Delete</a>
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
    // Turn off the value scrolling behaviour on all fields
    document.addEventListener("wheel", function(event){
        if(document.activeElement.type === "number"){
            document.activeElement.blur();
        }
    });
</script>
@endsection