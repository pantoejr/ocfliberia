@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('counties.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" />
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="custom-control custom-checkbox mb-4">
                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" />
                        <label class="custom-control-label" for="is_active">
                            Is Active
                        </label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Save</button> | <a href="{{ route('counties.index') }}" class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
