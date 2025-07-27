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
                                <input type="text" name="name" value="{{ $client->name }}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="{{ $client->email }}" required
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" value="{{ $client->phone_number }}"
                                    class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" name="location" value="{{ $client->location }}"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mb-4">
                                @if ($client->is_active)
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                        value="1" checked />
                                @else
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                        value="1" />
                                @endif
                                <label class="custom-control-label" for="is_active">
                                    Is Active
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-success">Update</button> |
                                <a href="{{ route('clients.index') }}" class="btn btn-info">Back</a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
