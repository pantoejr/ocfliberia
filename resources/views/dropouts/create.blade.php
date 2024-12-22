@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body px-4">
                <form method="POST" action="{{ route('dropouts.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label mb-2">Class</label>
                                <input type="text" name="class"
                                    class="form-control @error('class') is-invalid @enderror" />
                                @error('class')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label mb-2">Reason</label>
                                <input type="text" name="reason"
                                    class="form-control @error('reason') is-invalid @enderror" />
                                @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label mb-2">Date Dropout</label>
                                <input type="date" name="date_dropout"
                                    class="form-control @error('date_dropout') is-invalid @enderror" />
                                @error('date_dropout')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success">Save</button> | <a href="{{ route('dropouts.index') }}"
                            class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
