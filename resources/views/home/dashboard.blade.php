@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Sponsors ({{ date('Y') }})
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sponsorCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Schools ({{ date('Y') }})</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $schoolCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-school fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Beneficiaries ({{ date('Y') }})</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $beneficiaryCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-female fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Visits ({{ date('Y') }})
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $visitCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-road fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Distributions</h6>
                </div>
                <div class="card-body">
                    <div class="container">
                        <canvas id="distributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Distributions Per Sponsor</h6>
                </div>
                <div class="card-body">
                    @if (is_null($data))
                        <p class="text-primary">No record yet</p>
                    @else
                        @foreach ($data as $item)
                            <h4 class="small font-weight-bold">{{ $item->sponsor_name }}
                                <span class="float-right">
                                    {{ $item->total_distributed }} Items distributed
                                </span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ round(($item->total_distributed / $data->sum('total_distributed')) * 100, 2) }}%"
                                    aria-valuenow="{{ round(($item->total_distributed / $data->sum('total_distributed')) * 100, 2) }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    {{ round(($item->total_distributed / $data->sum('total_distributed')) * 100, 2) }}%
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Visits Per School</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="visitChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            var ctx = document.getElementById('distributionChart').getContext('2d');
            var distributions = @json($distributions);

            var months = [];
            var data = [];

            distributions.forEach(function(item) {
                months.push(item.year + "-" + item.month);
                data.push(item.total_distributed);
            });

            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Total Distributions per month',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        data: data,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var ctx2 = document.getElementById('visitChart').getContext('2d');
            var visits = @json($visits);

            var labels = [];
            var data = [];

            visits.forEach(function(item) {
                labels.push(item.school_name);
                data.push(item.total_visits);
            });

            var chart = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Visits',
                        backgroundColor: 'rgba(255, 30, 235, 0.2)',
                        borderColor: 'rgba(255, 20, 150, 1)',
                        borderWidth: 1,
                        data: data,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
