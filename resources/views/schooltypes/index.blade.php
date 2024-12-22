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
                        <a href="{{ route('schooltypes.create') }}" class="btn btn-primary mb-2">Add School Type</a><br><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered nowrap" id="schoolTypeTable">
                                <thead>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($schoolTypes as $schoolType)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $schoolType->name }}</td>
                                            <td>
                                                <a href="{{ route('schooltypes.edit', ['id' => $schoolType->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-fw fa-edit"></i></a>
                                                <a href="{{ route('schooltypes.destroy', ['id' => $schoolType->id]) }}"
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
            $('#schoolTypeTable').DataTable();
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
