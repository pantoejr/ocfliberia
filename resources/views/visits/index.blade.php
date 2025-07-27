@extends('layouts.app')
@section('content')
    @php
        $count = 1;
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3>{{ $title }}</h3>
                @haspermission('add-visit')
                    <a href="{{ route('visits.create') }}" class="btn btn-primary mb-2">Add New Record</a><br><br>
                @endhaspermission
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered nowrap" id="schoolTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Description</th>
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
                                            <td>{{ $visit->name }}</td>
                                            <td>{{ $visit->description }}</td>
                                            <td>{{ $visit->school->name }}</td>
                                            <td>{{ $visit->visit_date }}</td>
                                            <td>{{ $visit->sponsor->name }}</td>
                                            <td>
                                                @haspermission('edit-visit')
                                                    <a href="{{ route('visits.edit', ['id' => $visit->id]) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-fw fa-edit"></i>
                                                    </a>
                                                @endhaspermission
                                                @haspermission('view-visit-details')
                                                    <a href="{{ route('visits.details', ['id' => $visit->id]) }}"
                                                        class="btn btn-primary btn-sm"><i class="fas fa-fw fa-book"></i></a>
                                                @endhaspermission
                                                @haspermission('delete-visit')
                                                    <a href="{{ route('visits.destroy', ['id' => $visit->id]) }}"
                                                        onclick="confirmDelete(event)" class="btn btn-danger btn-sm"><i
                                                            class="fas fa-fw fa-trash"></i></a>
                                                @endhaspermission
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
            $('#schoolTable').dataTable();
        })
    </script>
@endsection
