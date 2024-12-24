@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body px-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label mb-2">Fullname</label>
                            <input type="text" name="fullname" class="form-control" value="{{ $graduate->fullname }}"
                                readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="school_type_id" class="form-label">Type of School</label>
                            <input type="text" name="schoolname" value="{{ $graduate->schoolType->name }}"
                                class="form-control" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label mb-2">School Graduated</label>
                            <input type="text" name="school_graduated" class="form-control"
                                value="{{ $graduate->school_graduated }}" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label mb-2">Class Graduated</label>
                            <input type="text" name="class_graduated" value="{{ $graduate->class_graduated }}"
                                class="form-control" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label mb-2">Date Graduated</label>
                            <input type="date" name="date_graduated" value="{{ $graduate->date_graduated }}"
                                class="form-control" readonly />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <a href="{{ route('graduates.index') }}" class="btn btn-info">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
