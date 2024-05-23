@extends('layouts.app')
@section('content')
    @php
        $count = 1;
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3>{{ $title }}</h3>
                @haspermission('add-school')
                    <a href="{{ route('schools.create') }}" class="btn btn-primary mb-2">Add New Record</a><br><br>
                @endhaspermission
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered nowrap" id="schoolTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Active</th>
                                        <th>No. of Girls</th>
                                        <th>County</th>
                                        <th>Location</th>
                                        <th>Sponsor</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schools as $school)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $school->name }}</td>
                                            <td>
                                                @if ($school->is_active == true)
                                                <span class="badge bg-success">Yes</span>
                                                @else
                                                    <span class="badge bg-danger">No</span>
                                                @endif
                                            </td>
                                            <td>{{ $school->total_girls }}</td>
                                            <td>{{ $school->county->name }}</td>
                                            <td>{{ $school->location }}</td>
                                            <td>{{ $school->sponsor->name }}</td>
                                            <td>
                                                <a href="{{ route('schools.edit', ['id' => $school->id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-edit"></i></a>
                                                <a href="{{ route('schools.destroy', ['id' => $school->id]) }}" onclick="confirmDelete(event)" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>
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
        $(document).ready(function (){
            $('#schoolTable').dataTable({

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
