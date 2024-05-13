@extends('layouts.app')
@section('content')
    @php
        $count = 1;
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3>{{ $title }}</h3>
                <a href="{{ route('visits.create') }}" class="btn btn-primary mb-2">Add New Record</a><br><br>
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered nowrap" id="schoolTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>School Visited</th>
                                        <th>Visit Date</th>
                                        <th>Visited By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visits as $visit)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $visit->school->name }}</td>
                                            <td>{{ $visit->visit_date }}</td>
                                            <td>{{ $visit->sponsor->name }}</td>
                                            <td>
                                                <a href="{{ route('visits.edit', ['id' => $visit->id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-edit"></i></a>
                                                <a href="{{ route('visits.details', ['id' => $visit->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-book"></i></a>
                                                <a href="{{ route('visits.destroy', ['id' => $visit->id]) }}" onclick="confirmDelete(event)" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>
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
