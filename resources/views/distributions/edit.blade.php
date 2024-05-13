@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('distributions.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="visit_id" class="form-label">Visit</label>
                        <select class="form-control" id="visit_id" name="visit_id" required>
                            @foreach ($visits as $visitId => $visitName)
                                <option value="{{ $visitId }}" {{ $distribution->visit_id == $visitId ? "selected" : "" }}>
                                    {{ $visitName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="distribution_type_id" class="form-label">Type of Distribution</label>
                        <select class="form-control" id="distribution_type_id" name="distribution_type_id" required>
                            @foreach ($distributionTypes as $distributionTypeId => $distributionTypeName)
                                <option value="{{ $distributionTypeId }}" {{ $distribution->distribution_type_id == $distributionTypeId ? "selected" : "" }}>
                                    {{ $distributionTypeName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="distribution_date"
                            class="form-control @error('distribution_date') is-invalid @enderror" value="{{ $distribution->distribution_date }}" />
                        @error('distribution_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            Beneficiary List
                            <hr />
                            <div class="row" id="beneficiaryCheckboxes">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Update</button> | <a href="{{ route('distributions.index') }}"
                            class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            function fetchProjectBeneficiaries(visitId) {
                $.ajax({
                    url: "{{ route('getProjectBeneficiaries') }}",
                    type: "GET",
                    data: {
                        visit_id: visitId
                    },
                    success: function(response) {

                        $('#beneficiaryCheckboxes').empty();
                        response.forEach(function(beneficiary) {
                            var checkbox = '<div class="col-md-2">' +
                                            '<div class="custom-control custom-checkbox mb-4">' +
                                            '<input type="checkbox" id="beneficiaryId" class="custom-control-input" name="beneficiaries[]" value="' + beneficiary.id + '">' +
                                            '<label class="custom-control-label" for="beneficiaryId">' + beneficiary.fullname + '</label>' +
                                            '</div>' +
                                        '</div>';
                            $('#beneficiaryCheckboxes').append(checkbox);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
            $('#visit_id').on('change', function() {
                var visitId = $(this).val();
                fetchProjectBeneficiaries(visitId);
            });
            fetchProjectBeneficiaries($('#visit_id').val());
        });
    </script>
@endsection
