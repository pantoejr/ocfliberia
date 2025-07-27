@extends('layouts.app')
@section('content')
    @php
        $count = 1;
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $title }}</h3>
                @haspermission('add-client')
                    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-2">Add New Record</a>
                @endhaspermission
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="currencyTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Status</th>
                                        <th>Action(s)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->phone_number }}</td>
                                            <td>
                                                @if ($client->is_active == true)
                                                    <span class="badge bg-success text-white">Yes</span>
                                                @else
                                                    <span class="badge bg-danger text-white">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('clients.edit', ['id' => $client->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-fw fa-edit"></i></a>
                                                <a href="{{ route('clients.destroy', ['id' => $client->id]) }}"
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
            $('#currencyTable').DataTable();
        });
    </script>
@endsection
