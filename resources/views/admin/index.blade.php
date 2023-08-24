@extends('admin.template')
@section('title', 'EMP - Dashboard')
@section('add_form')
    <div class="theme-setting-wrapper">
        <div id="theme-settings" class="settings-panel" style="overflow:scroll;">
            <i class="settings-close ti-close"></i>
            <p class="settings-heading text-light">Add New Visitor</p>
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
                    <p>Gender</p>
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
                    </div>
                    <p>Occupation</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-account-multiple"></i>
                            </span>
                        </div>
                        <input type="text" name="position" class="form-control" placeholder="Enter Occupation." required>
                    </div>
                    <p>Company/ Organization</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="mdi mdi-account-multiple"></i>
                            </span>
                        </div>
                        <input type="text" name="company" class="form-control" placeholder="Enter Company.">
                    </div>
                    <p>Interests</p>
                    <div class="input-group mb-1">
                        <input class="form-check-input ml-3" type="checkbox" name="pos[]" value="Real Estate and Properties ">
                        <label class="form-check-label ml-5" for="defaultCheck1">
                            Real Estate and Properties
                        </label>
                    </div>
                    <div class="input-group mb-1">
                        <input class="form-check-input ml-3" type="checkbox" name="pos[]" value="Constructions">
                        <label class="form-check-label ml-5" for="defaultCheck1">
                            Constructions
                        </label>
                    </div>
                    <div class="input-group mb-1">
                        <input class="w-auto form-check-input ml-3" type="checkbox" name="pos[]" value="Renewable Energy and EV">
                        <label class="form-check-label ml-5" for="defaultCheck1">
                            Renewable Energy and EV
                        </label>
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
        <div class="col-12 col-md-4 col-lg-3 col-xl-2 mb-4 transparent stretch-card" id="settings-trigger2">
            <div class="card card-success">
                <div class="card-body text-center">
                    <p class="">New Visitor</p>
                    <i class="mdi mdi-account-plus fs-50"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-3 mb-4 transparent">
            <div class="card card-dark-blue">
                <div class="card-body">
                    <p class="mb-4">Total Visitors</p>
                    <p class="fs-30 mb-2">{{ $Vtotal }}</p>
                    <p><nobr>18-Aug - 20-Aug</nobr></p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 col-xl-3 mb-4 transparent">
            <div class="card card-light-blue">
                <div class="card-body">
                    <p class="mb-4">Today’s Visitors</p>
                    <p class="fs-30 mb-2">{{ $Vtoday }}</p>
                    <p>{{ date('d-M') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Visitors' Genders</h4>
                    <br>
                    <canvas id="gender-chart"></canvas>
                    <div id="gender-legend"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Visitors Interests Chart</p>
                    <br>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Today's Entry Chart</p>
                    <canvas id="lineChart"></canvas>
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
                                            btn-link text-warning
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
                                            @if($orderBy=='email')
                                            btn-link text-warning
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
                                            @if($orderBy=='position')
                                            btn-link text-warning
                                            @endif
                                            " name="orderBy" value="position">Occupation</button>
                                        </form>
                                    </th>
                                    <th>
                                        <form action="/" method="GET">
                                            @csrf
                                            <input type="hidden" name="paginate" value="{{ $paginate }}">
                                            <input type="hidden" name="page" value="{{ $page }}">
                                            <button type="submit" class="btn 
                                            @if($orderBy=='company')
                                            btn-link text-warning
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
                                            btn-link text-warning
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
                                    <td>{{ $visitor->name }}</td>
                                    <td>{{ $visitor->phone }}</td>
                                    <td>{{ $visitor->email }}</td>
                                    <td>{{ $visitor->position }}</td>
                                    <td>{{ $visitor->company }}</td>
                                    <td>{{ $visitor->sex }}</td>
                                    <td>{{ $visitor->vis_created_at }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-success btn-sm" type="button" id="{{ $visitor->id }}-details" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="{{ $visitor->id }}-details">
                                                <a class="text-success dropdown-item py-3" href="/visitors/download/{{ $visitor->id }}">Download ID Card</a>
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
<script>
    if ($("#gender-chart").length) {
      var areaData = {
        labels: ["Male", "Female", "Other"],
        datasets: [{
            data: [{{ $Mtotal }}, {{ $Ftotal }}],
            backgroundColor: [
               "rgba(54, 162, 235, 0.5)","rgba(255, 99, 132, 0.5)",
            ],
            borderColor: "rgba(0,0,0,0)"
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        segmentShowStroke: false,
        cutoutPercentage: 78,
        elements: {
          arc: {
              borderWidth: 4
          }
        },      
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
        legendCallback: function(chart) { 
          var text = [];
          text.push('<div class="report-chart">');
            text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[0] + '"></div><p class="mb-0">Male</p></div>');
            text.push('<p class="mb-0">{{ $Mtotal }}</p>');
            text.push('</div>');
            text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[1] + '"></div><p class="mb-0">Female</p></div>');
            text.push('<p class="mb-0">{{ $Ftotal }}</p>');
            text.push('</div>');
          text.push('</div>');
          return text.join("");
        },
      }
      var northAmericaChartPlugins = {
        beforeDraw: function(chart) {
          var width = chart.chart.width,
              height = chart.chart.height,
              ctx = chart.chart.ctx;
      
          ctx.restore();
          var fontSize = 2.125;
          ctx.font = "500 " + fontSize + "em sans-serif";
          ctx.textBaseline = "middle";
          ctx.fillStyle = "#13381B";
      
          var text = "{{ $Vtotal }}",
              textX = Math.round((width - ctx.measureText(text).width) / 2),
              textY = height / 2;
      
          ctx.fillText(text, textX, textY);
          ctx.save();
        }
      }
      var northAmericaChartCanvas = $("#gender-chart").get(0).getContext("2d");
      var northAmericaChart = new Chart(northAmericaChartCanvas, {
        type: 'doughnut',
        data: areaData,
        options: areaOptions,
        plugins: northAmericaChartPlugins
      });
      document.getElementById('gender-legend').innerHTML = northAmericaChart.generateLegend();
    }
</script>
<script type="text/javascript">
    'use strict';
  var interest_data = {
    labels: ["Properties", "Construction", "EV"],
    datasets: [{
      label: '# of Votes',
      data: [{{ $intr['rep'] }}, {{ $intr['cons'] }}, {{ $intr['ev'] }}],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(54, 162, 235, 0.2)'
        // 'rgba(75, 192, 192, 0.2)',
        // 'rgba(153, 102, 255, 0.2)',
        // 'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(255, 206, 86, 1)',
        'rgba(54, 162, 235, 1)'
        // 'rgba(75, 192, 192, 1)',
        // 'rgba(153, 102, 255, 1)',
        // 'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };
  var options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: false
    },
    elements: {
      point: {
        radius: 0
      }
    }

  };

  var entry_data = {
    labels: ["9AM", "10AM", "11AM", "12PM", "1PM", "2PM", "3PM", "4PM", "5PM", "8PM", "12AM"],
    datasets: [{
      label: '# of Votes',
      data: ["{{ $entry['9am'] }}", "{{ $entry['10am'] }}", "{{ $entry['11am'] }}", "{{ $entry['12pm'] }}", "{{ $entry['1pm'] }}", "{{ $entry['2pm'] }}", "{{ $entry['3pm'] }}", "{{ $entry['4pm'] }}", "0", "{{ $entry['8pm'] }}", "0"],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(54, 162, 235, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(255, 206, 86, 1)'
      ],
      borderWidth: 1,
      fill: true
    }]
  };
  var options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: false
    },
    elements: {
      point: {
        radius: 0
      }
    }

  };
</script>
<script src="{{ url('js/chart.js') }}"></script>
<script type="text/javascript">
    // Turn off the value scrolling behaviour on all fields
    document.addEventListener("wheel", function(event){
        if(document.activeElement.type === "number"){
            document.activeElement.blur();
        }
    });
</script>
@endsection