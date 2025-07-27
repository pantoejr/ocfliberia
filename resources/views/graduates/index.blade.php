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
                        <a href="{{ route('graduates.create') }}" class="btn btn-primary mb-2">Add Graduate</a><br><br>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6 d-flex justify-content-md-end justify-content-sm-end">
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false">
                                Export
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('graduates.exportPDF') }}" target="_blank">PDF</a>
                                <a class="dropdown-item" href="{{ route('graduates.exportExcel') }}">Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered nowrap" id="graduateTable">
                                <thead>
                                    <th>No.</th>
                                    <th>Fullname</th>
                                    <th>School Type</th>
                                    <th>School Graduated</th>
                                    <th>Class Graduated</th>
                                    <th>Date Graduated</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($graduates as $graduate)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $graduate->fullname }}</td>
                                            <td>{{ $graduate->schoolType->name }}</td>
                                            <td>{{ $graduate->school_graduated }}</td>
                                            <td>{{ $graduate->class_graduated }}</td>
                                            <td>{{ $graduate->date_graduated }}</td>
                                            <td>
                                                <a href="{{ route('graduates.edit', ['id' => $graduate->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-fw fa-edit"></i></a>
                                                <a href="{{ route('graduates.details', ['id' => $graduate->id]) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-fw fa-book"></i></a>
                                                <a href="{{ route('graduates.destroy', ['id' => $graduate->id]) }}"
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
            $('#graduateTable').DataTable();
        });
    </script>
@endsection
