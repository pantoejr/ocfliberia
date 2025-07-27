@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('currencies.update', ['id' => $currency->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $currency->name }}" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Update</button> | <a href="{{ route('currencies.index') }}"
                            class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
