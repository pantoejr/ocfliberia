@extends('layouts.app')
@section('content')
    @php
        $count = 1;
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $title }}</h3>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{ route('dropouts.create') }}" class="btn btn-primary mb-2">Add Dropout</a><br><br>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6 d-flex justify-content-md-end justify-content-sm-end">
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false">
                                Export
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('dropouts.exportPDF') }}" target="_blank">PDF</a>
                                <a class="dropdown-item" href="{{ route('dropouts.exportExcel') }}">Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered nowrap" id="dropoutTable">
                                <thead>
                                    <th>No.</th>
                                    <th>Fullname</th>
                                    <th>Class</th>
                                    <th>Reason</th>
                                    <th>Date Dropped</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($dropouts as $dropout)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $dropout->fullname }}</td>
                                            <td>{{ $dropout->class }}</td>
                                            <td>{{ $dropout->reason }}</td>
                                            <td>{{ $dropout->date_dropout }}</td>
                                            <td>
                                                <a href="{{ route('dropouts.edit', ['id' => $dropout->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-fw fa-edit"></i></a>
                                                <a href="{{ route('dropouts.details', ['id' => $dropout->id]) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-fw fa-book"></i></a>
                                                <a href="{{ route('dropouts.destroy', ['id' => $dropout->id]) }}"
                                                    onclick="confirmDelete(event)" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-fw fa-trash"></i></a>
                                            </td>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dropoutTable').DataTable();
        });
    </script>
    <script type="text/javascript">
        function confirmDelete(event) {
            event.preventDefault();
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = event.currentTarget.href;
            }
            return false;
        }
    </script>
@endsection
