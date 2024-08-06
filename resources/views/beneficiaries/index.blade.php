@extends('layouts.app')
@section('content')
    @php
        $count = 1;
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3>{{ $title }}</h3>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-6">
                                @haspermission('add-student')
                                    <a href="{{ route('beneficiaries.create') }}" class="btn btn-primary mb-2">Add New Record</a>
                                @endhaspermission
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 d-flex justify-content-md-end justify-content-sm-end">
                                @haspermission('export-student-report')
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"
                                            aria-expanded="false">
                                            Export
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('beneficiaries.exportPDF') }}"
                                                target="_blank">PDF</a>
                                            <a class="dropdown-item" href="{{ route('beneficiaries.exportExcel') }}">Excel</a>
                                        </div>
                                    </div>
                                @endhaspermission
                            </div>
                        </div>


                    </div>
                </div>

                <br>
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered nowrap" id="beneficiaryTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>New Student</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($beneficiaries as $beneficiary)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $beneficiary->fullname }}</td>
                                            <td>
                                                @if ($beneficiary->is_new == true)
                                                    <span class="badge bg-primary text-light">Yes</span>
                                                @else
                                                    <span class="badge bg-info text-light">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($beneficiary->is_active == true)
                                                    <span class="badge bg-success">Yes</span>
                                                @else
                                                    <span class="badge bg-danger">No</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('beneficiaries.edit', ['id' => $beneficiary->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-fw fa-edit"></i></a>
                                                <a href="{{ route('beneficiaries.details', ['id' => $beneficiary->id]) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-fw fa-book"></i></a>
                                                <a href="{{ route('beneficiaries.destroy', ['id' => $beneficiary->id]) }}"
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
            $('#beneficiaryTable').dataTable({

            });
        })
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
