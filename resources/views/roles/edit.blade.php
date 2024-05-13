@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('roles.update',['id' => $role->id ]) }}">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $role->name }}" class="form-control" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Update</button> | <a href="{{ route('roles.index') }}" class="btn btn-light">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
