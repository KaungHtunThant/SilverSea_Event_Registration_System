@extends('admin.template')
@section('title', 'IMS Silver Sea - Dashboard')
@section('contents')
    <div class="row">
        {{ var_dump($entry) }}
        <div class="col-6 col-lg-3 col-xl-3 mb-4 transparent">
            <div class="card card-dark-blue">
                <div class="card-body">
                    <p class="mb-4">Total Visitors</p>
                    <p class="fs-30 mb-2">{{ $Vtotal }}</p>
                    <p><nobr>18-Aug - 20-Aug</nobr></p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-xl-3 mb-4 transparent">
            <div class="card card-light-danger">
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
                                                    <input type="submit" name="search" class="btn btn-sm btn-primary" value="Search">
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
                                <input type="submit" name="reset" value="Reset" class="btn btn-primary float-right">
                            </form>
                            <form action="/">
                                @csrf
                                <input type="hidden" name="paginate" value="{{ $paginate }}">
                                <input type="hidden" name="orderBy" value="{{ $orderBy }}">
                                <input type="hidden" name="page" value="{{ $page }}">
                                @if(isset($searchVal))
                                <input type="hidden" name="searchVal" value="{{ $searchVal }}">
                                @endif
                                <button type="submit" name="reload" class="btn btn-primary float-right mr-2">
                                    <i class="mdi mdi-reload"></i>
                                </button>
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
          var fontSize = 3.125;
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
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)'
        // 'rgba(75, 192, 192, 0.2)',
        // 'rgba(153, 102, 255, 0.2)',
        // 'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)'
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
    labels: ["9AM", "10AM", "11AM", "12PM", "1PM", "2PM", "3PM", "4PM"],
    datasets: [{
      label: '# of Votes',
      data: ["{{ $entry['9am'] }}", "{{ $entry['10am'] }}", "{{ $entry['11am'] }}", "{{ $entry['12pm'] }}", "{{ $entry['1pm'] }}", "{{ $entry['2pm'] }}", "{{ $entry['3pm'] }}", "{{ $entry['4pm'] }}"],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 99, 132, 0.2)',
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
        'rgba(255, 206, 86, 1)'
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
</script>
<script src="{{ url('js/chart.js') }}"></script>
@endsection