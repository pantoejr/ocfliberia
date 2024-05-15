@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body p-4">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $role->name }}" class="form-control" readonly />
                </div>
                <div class="form-group">
                    <a href="{{ route('roles.index') }}" class="btn btn-light">Back to List</a>
                </div>
            </div>
        </div>
        <div class="row mb-4 mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Remove Permission(s) from {{ $role->name }}</div>
                    <div class="card-body">
                        @livewire('remove-role-permission', ['roleId' => $role->id])
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Assign Permission(s) to {{ $role->name }}</div>
                    <div class="card-body">
                        @livewire('add-role-permission', ['roleId' => $role->id])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
