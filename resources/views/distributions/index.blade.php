@extends('layouts.app')
@section('content')
    @php
        $count = 1;
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $title }}</h3>
                <a href="{{ route('distributions.create') }}" class="btn btn-primary mb-2">Add Distribution</a><br><br>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered nowrap" id="distributionTable">
                                <thead>
                                    <th>No.</th>
                                    <th>Visit</th>
                                    <th>Distribution type</th>
                                    <th>Distribution date</th>
                                    <th>No. of items distributed</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($distributions as $distribution)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $distribution->visit->name }}</td>
                                            <td>{{ $distribution->distributionType->name }}</td>
                                            <td>{{ $distribution->distribution_date }}</td>
                                            <td>{{ $distribution->num_distributed }}</td>
                                            <td>
                                                <a href="{{ route('distributions.edit', ['id' => $distribution->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-fw fa-edit"></i></a>
                                                <a href="{{ route('distributions.details', ['id' => $distribution->id]) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-fw fa-book"></i></a>
                                                <a href="{{ route('distributions.destroy', ['id' => $distribution->id]) }}"
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
            $('#distributionTable').DataTable();
        });
    </script>
@endsection
