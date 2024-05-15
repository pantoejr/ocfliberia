@extends('layouts.app')
@section('content')
    @php
        $count = 1;
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3>{{ $title }}</h3>
                @haspermission('add-sponsor')
                    <a href="{{ route('sponsors.create') }}" class="btn btn-primary mb-2">Add New Record</a><br><br>
                @endhaspermission
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered nowrap" id="sponsorsTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sponsors as $sponsor)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $sponsor->name }}</td>
                                            <td><a href="mailto:{{ $sponsor->email }}">{{ $sponsor->email }}</a></td>
                                            <td>{{ $sponsor->contact }}</td>
                                            <td>
                                                @if ($sponsor->is_active == true)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">In Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                @haspermission('edit-sponsor')
                                                    <a href="{{ route('sponsors.edit', ['id' => $sponsor->id]) }}"
                                                        class="btn btn-warning btn-sm"><i class="fas fa-fw fa-edit"></i>
                                                    </a>
                                                @endhaspermission
                                                @haspermission('delete-sponsor')
                                                    <a href="{{ route('sponsors.destroy', ['id' => $sponsor->id]) }}"
                                                        onclick="confirmDelete(event)" class="btn btn-danger btn-sm"><i
                                                            class="fas fa-fw fa-trash">
                                                        </i>
                                                    </a>
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
            $('#sponsorsTable').dataTable({

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
