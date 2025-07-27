@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="mb-4">{{ $title }}</h3>
                <div class="card mb-5">
                    <div class="card-body p-4">
                        <form action="{{ route('account.update', ['id' => $user->id]) }}" novalidate
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <img src="{{ asset('storage/' . $user->imagePath) }}" class="card-img" />
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="imagePath" class="form-label">Image</label>
                                                <input type="file" name="imagePath" id="imagePath"
                                                    class="form-control @error('imagePath') is-invalid @enderror"
                                                    accept=".jpg,.png,.gif,.jpeg" />
                                                @error('imagePath')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Fullname</label>
                                                <input type="text" name="name" id="name"
                                                    value="{{ $user->name }}"
                                                    class="form-control @error('name') is-invalid @enderror" />
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" value="{{ $user->email }}"
                                                    id="email" class="form-control @error('email') is-invalid @enderror"
                                                    required />
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contact" class="form-label">Contact</label>
                                                <input type="text" name="contact" value="{{ $user->contact }}"
                                                    id="contact"
                                                    class="form-control @error('contact') is-invalid @enderror" />
                                                @error('contact')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" name="address" value="{{ $user->address }}"
                                                    id="address"
                                                    class="form-control @error('address') is-invalid @enderror" required />
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role_id" class="form-label">Role</label>
                                                <select class="form-control" id="role_id" name="role_id" required>
                                                    @foreach ($roles as $rolesid => $rolename)
                                                        <option value="{{ $rolesid }}"
                                                            {{ $user->role_id == $rolesid ? 'selected' : '' }}>
                                                            {{ $rolename }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                @if ($user->is_active == true)
                                                    <input type="checkbox" class="custom-control-input" id="is_active"
                                                        name="is_active" value="1" checked />
                                                @else
                                                    <input type="checkbox" class="custom-control-input" id="is_active"
                                                        name="is_active" value="1" />
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
                                                <button class="btn btn-success">Update</button> |
                                                <a href="{{ route('account.users') }}" class="btn btn-info">Back</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
