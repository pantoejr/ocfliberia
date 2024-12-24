@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body px-4">
                <form method="POST" action="{{ route('graduates.update', ['id' => $graduate->id]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label mb-2">Fullname</label>
                                <input type="text" name="fullname" value="{{ $graduate->fullname }}"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="school_type_id" class="form-label">Type of School</label>
                                <select class="form-control" id="school_type_id" name="school_type_id" required>
                                    @foreach ($schoolTypes as $schoolTypeId => $schoolTypeName)
                                        <option value="{{ $schoolTypeId }}"
                                            {{ $graduate->school_type_id == $schoolTypeId ? 'selected' : '' }}>
                                            {{ $schoolTypeName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label mb-2">School Graduated</label>
                                <input type="text" name="school_graduated" value="{{ $graduate->school_graduated }}"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label mb-2">Class Graduated</label>
                                <input type="text" name="class_graduated" value="{{ $graduate->class_graduated }}"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label mb-2">Date Graduated</label>
                                <input type="date" name="date_graduated" value="{{ $graduate->date_graduated }}"
                                    class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success">Update</button> | <a href="{{ route('graduates.index') }}"
                            class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
