@extends('layouts.app')
@section('content')

    @php
        $count = 1;
    @endphp

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>{{ $title }}</h3>
                @haspermission('add-user')
                    <a href="{{ route('account.register') }}" class="btn btn-primary mb-2"><i class="bi bi-pencil"></i> Add New
                        Record
                    </a><br><br>
                @endhaspermission
                <div class="card">
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-striped datatable nowrap" id="userTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @haspermission('edit-user')
                                                    <a href="{{ route('account.edit', ['id' => $user->id]) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-fw fa-edit">
                                                        </i>
                                                    </a>
                                                @endhaspermission
                                                @haspermission('view-user-details')
                                                    <a href="{{ route('account.details', ['id' => $user->id]) }}"
                                                        class="btn btn-primary">
                                                        <i class="fas fa-fw fa-book">
                                                        </i>
                                                    </a>
                                                @endhaspermission
                                                @haspermission('delete-user')
                                                    <a href="{{ route('account.destroy', ['id' => $user->id]) }}"
                                                        onclick="confirmDelete(event)" class="btn btn-danger">
                                                        <i class="fas fa-fw fa-trash">
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
            $('#userTable').dataTable({});
        })
    </script>
@endsection
