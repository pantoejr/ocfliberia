@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body px-4">
                <form method="POST" action="{{ route('graduates.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label mb-2">Fullname</label>
                                <input type="text" name="fullname"
                                    class="form-control @error('fullname') is-invalid @enderror" />
                                @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="school_type_id" class="form-label">Type of School</label>
                                <select class="form-control" id="school_type_id" name="school_type_id" required>
                                    @foreach ($schoolTypes as $schoolTypeId => $schoolTypeName)
                                        <option value="{{ $schoolTypeId }}">{{ $schoolTypeName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label mb-2">School Graduated</label>
                                <input type="text" name="school_graduated"
                                    class="form-control @error('school_graduated') is-invalid @enderror" />
                                @error('school_graduated')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label mb-2">Class Graduated</label>
                                <input type="text" name="class_graduated"
                                    class="form-control @error('class_graduated') is-invalid @enderror" />
                                @error('class_graduated')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label mb-2">Date Graduated</label>
                                <input type="date" name="date_graduated"
                                    class="form-control @error('date_graduated') is-invalid @enderror" />
                                @error('date_graduated')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success">Save</button> | <a href="{{ route('graduates.index') }}"
                            class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
