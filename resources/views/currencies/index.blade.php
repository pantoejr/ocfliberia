@extends('layouts.app')
@section('content')
    @php
        $count = 1;
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $title }}</h3>
                @haspermission('add-student')
                    <a href="{{ route('currencies.create') }}" class="btn btn-primary mb-2">Add New Record</a>
                @endhaspermission
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="currencyTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Action(s)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($currencies as $currency)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $currency->name }}</td>
                                            <td>
                                                <a href="{{ route('currencies.edit', ['id' => $currency->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-fw fa-edit"></i></a>
                                                <a href="{{ route('currencies.destroy', ['id' => $currency->id]) }}"
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
