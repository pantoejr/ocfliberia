@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('clients.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" required
                                    class="form-control @error('name') is-invalid @enderror" />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" required
                                    class="form-control @error('email') is-invalid @enderror" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" required
                                    class="form-control @error('phone_number') is-invalid @enderror" />
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" name="location" required
                                    class="form-control @error('location') is-invalid @enderror" />
                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mb-4">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                    value="1" />
                                <label class="custom-control-label" for="is_active">
                                    Is Active
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-success">Save</button> |
                                <a href="{{ route('clients.index') }}" class="btn btn-info">Back</a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
