@extends('layouts.app')
@section('content')
    @php
        $count = 1;
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4>{{ $title }}</h4>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('reports.distributions') }}" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="startDate" class="form-label">Start Date</label>
                                        <input type="date" name="startDate" id="startDate" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="endDate" class="form-label">End Date</label>
                                        <input type="date" name="endDate" id="endDate" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="btn" class="form-label"></label>
                                    <button class="btn btn-primary btn-md w-100">Search</button>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered reportTable">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>School</th>
                                                <th>Type of Distribution</th>
                                                <th>Visit Date</th>
                                                <th>Distribution Date</th>
                                                <th>No of Items Distributed</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($distributions as $distribution)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $distribution->visit->school->name }}</td>
                                                    <td>{{ $distribution->distributionType->name }}</td>
                                                    <td>{{ $distribution->visit->visit_date }}</td>
                                                    <td>{{ $distribution->distribution_date }}</td>
                                                    <td>{{ $distribution->num_distributed }}</td>
                                                </tr>
                                                @php
                                                    $count++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
