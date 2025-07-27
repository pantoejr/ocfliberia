@extends('layouts.app')
@section('content')
    @php
        $count = 1;
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3>{{ $title }}</h3>
                <a href="{{ route('roles.create') }}" class="btn btn-primary mb-2">Add New Record</a><br><br>
                <div class="card mb-4">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="roleTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <a href="{{ route('roles.edit', ['id' => $role->id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-edit"></i></a>
                                                <a href="{{ route('roles.details', ['id' => $role->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-book"></i></a>
                                                <a href="{{ route('roles.delete', ['id' => $role->id]) }}" onclick="confirmDelete(event)" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>
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
            $('#roleTable').dataTable({

            });
        })
    </script>
@endsection
