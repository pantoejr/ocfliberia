@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('storage/'. $beneficiary->image ) }}" width="250" />
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fullname</label>
                                <input type="text" name="fullname" class="form-control"
                                    value="{{ $beneficiary->fullname }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="school_id" class="form-label">School</label>
                                <select class="form-control" id="school_id" name="school_id" disabled>
                                    @foreach($schools as $schoolId => $schoolName)
                                        <option value="{{ $schoolId }}"  {{ $beneficiary->school_id == $schoolId ? 'selected' : '' }}>
                                            {{ $schoolName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Age</label>
                                <input type="number" name="age" class="form-control"
                                    value="{{ $beneficiary->age }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control"
                                    value="{{ $beneficiary->date_of_birth }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <input type="text" name="location" class="form-control"
                                    value="{{ $beneficiary->location }}"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Contact</label>
                                <input type="text" name="contact" class="form-control" value="{{ $beneficiary->contact }}" disabled/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Current Grade</label>
                                <input type="text" name="class" class="form-control" value="{{ $beneficiary->class }}" disabled/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="custom-control custom-checkbox mb-4">
                                @if ($beneficiary->is_new)
                                    <input type="checkbox" class="custom-control-input" id="is_new" name="is_new" value="1" checked disabled />
                                @else
                                    <input type="checkbox" class="custom-control-input" id="is_new" name="is_new" value="1" disabled />
                                @endif
                                <label class="custom-control-label" for="is_new">
                                    Is New
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-checkbox mb-4">
                                @if ($beneficiary->is_active)
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked disabled />
                                @else
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" disabled />
                                @endif
                                <label class="custom-control-label" for="is_active">
                                    Is Active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mt-4">
                <a href="{{ route('beneficiaries.index') }}" class="btn btn-info">Back To List</a>
            </div>
        </div>
    </div>
</div>
@endsection
