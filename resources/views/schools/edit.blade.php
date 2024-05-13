@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('schools.update', ['id' => $school->id ]) }}">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control @error('name')
                            is-invalid @enderror "
                            value="{{ $school->name }}"
                        />
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="county_id" class="form-label">County</label>
                        <select class="form-control" id="county_id" name="county_id" required >
                            @foreach($counties as $countyId => $countyName)
                                <option value="{{ $countyId }}"  {{ $school->county_id == $countyId ? 'selected' : '' }}>
                                    {{ $countyName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control @error('location')
                            is-invalid
                        @enderror"
                        value="{{ $school->location }}"
                        />
                        @error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sponsor_id" class="form-label">Sponsor</label>
                        <select class="form-control" id="sponsor_id" name="sponsor_id" required >
                            @foreach($sponsors as $sponsorId => $sponsorName)
                                <option value="{{ $sponsorId }}"  {{ $school->sponsor_id == $sponsorId ? 'selected' : '' }}>
                                    {{ $sponsorName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Total Number of Girls</label>
                        <input type="number" name="total_girls" class="form-control" value="{{ $school->total_girls }}" />
                    </div>
                    <div class="custom-control custom-checkbox mb-4">
                        @if ($school->is_active == true)
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked />
                        @else
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" />
                        @endif

                        <label class="custom-control-label" for="is_active">
                            Is Active
                        </label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Update</button> | <a href="{{ route('schools.index') }}" class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

