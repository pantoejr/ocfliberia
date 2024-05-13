@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('beneficiaries.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept=".jpg,.png,.gif,.jpeg" />
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Fullname</label>
                            <input type="text" name="fullname" class="form-control @error('fullname')
                                is-invalid @enderror "
                            />
                            @error('fullname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="school_id" class="form-label">School</label>
                            <select class="form-control @error('school_id')
                                is-invalid
                            @enderror" id="school_id" name="school_id">
                                @foreach($schools as $schoolId => $schoolName)
                                    <option value="{{ $schoolId }}">{{ $schoolName }}</option>
                                @endforeach
                                @error('school_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Age</label>
                            <input type="number" name="age" class="form-control @error('age')
                                is-invalid
                            @enderror" />
                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control @error('date_of_birth')
                                is-invalid
                            @enderror"/>
                            @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <input type="text" name="location" class="form-control @error('location')
                                is-invalid
                            @enderror"/>
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Contact</label>
                            <input type="text" name="contact" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Current Grade</label>
                            <input type="text" name="class" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox mb-4">
                            <input type="checkbox" class="custom-control-input" id="is_new" name="is_new" value="1" />
                            <label class="custom-control-label" for="is_new">
                                Is New
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox mb-4">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" />
                            <label class="custom-control-label" for="is_active">
                                Is Active
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Save</button> | <a href="{{ route('beneficiaries.index') }}" class="btn btn-info">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
