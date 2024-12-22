@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body px-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label mb-2">Fullname</label>
                            <input type="text" name="fullname" value="{{ $dropout->fullname }}" readonly
                                class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label mb-2">Class</label>
                            <input type="text" name="fullname" value="{{ $dropout->class }}" readonly
                                class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label mb-2">Reason</label>
                            <input type="text" name="reason" value="{{ $dropout->reason }}" readonly
                                class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label mb-2">Date Dropout</label>
                            <input type="date" value="{{ $dropout->date_dropout }}" readonly name="date_dropout"
                                class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <a href="{{ route('dropouts.index') }}" class="btn btn-info">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
