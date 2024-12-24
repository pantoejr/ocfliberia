@extends('layouts.app')
@section('content')
    @php
        $count = 1;
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-3">{{ $title }}</h3>
                @haspermission('view-beneficiaries-pdf')
                    <a href="{{ route('distribution.beneficiaries.pdf') }}" target="_blank" class="btn btn-primary mb-3">PDF</a>
                @endhaspermission
                <div class="card">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="distributionBeneficiariesTable">
                                <thead>
                                    <th>No.</th>
                                    <th>Beneficiary</th>
                                    <th>Visit</th>
                                    <th>Distribution Date</th>
                                </thead>
                                <tbody>
                                    @foreach ($distributionBeneficiaries as $dBeneficiary)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $dBeneficiary->beneficiary->fullname }}</td>
                                            <td>{{ $dBeneficiary->visit->name }}</td>
                                            <td>{{ $dBeneficiary->distribution->distribution_date }}</td>
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
    <script>
        $(document).ready(function() {
            $('#distributionBeneficiariesTable').dataTable({
                layout: {
                    topStart: {
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    }
                }
            });
        });
    </script>
@endsection
