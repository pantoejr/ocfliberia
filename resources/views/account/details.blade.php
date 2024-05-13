@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="mb-4">{{ $title }}</h3>
                <div class="card mb-5">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="{{ asset('storage/'. $user->imagePath ) }}" class="card-img" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Fullname</label>
                                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control " disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" value="{{ $user->email }}" id="email" class="form-control" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact" class="form-label">Contact</label>
                                            <input type="text" name="contact" value="{{ $user->contact }}" id="contact" class="form-control" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" name="address" value="{{ $user->address }}" id="address" class="form-control" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role_id" class="form-label">Role</label>
                                            <select class="form-control" id="role_id" name="role_id" disabled >
                                                @foreach($roles as $rolesid => $rolename)
                                                    <option value="{{ $rolesid }}" {{ $user->role_id == $rolesid ? 'selected' : '' }}>
                                                        {{ $rolename }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="login_hint" class="form-label">Login Hint</label>
                                            <input type="text" name="login_hint" value="{{ $user->login_hint }}" id="login_hint" class="form-control" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="custom-control custom-checkbox">
                                            @if ($user->is_active == true)
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
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <a href="{{ route('account.users') }}" class="btn btn-info">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
