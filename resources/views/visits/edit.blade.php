@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('visits.update', ['id' => $visit->id ]) }}">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $visit->name }}" />
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="school_id" class="form-label">School</label>
                        <select class="form-control @error('school_id')
                            is-invalid
                        @enderror" id="school_id" name="school_id">
                            @foreach($schools as $schoolId => $schoolName)
                                <option value="{{ $schoolId }}" {{ $visit->school_id == $schoolId ? 'selected' : '' }}>
                                    {{ $schoolName }}
                                </option>
                            @endforeach
                            @error('school_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Day of Visit</label>
                        <input type="date" name="visit_date" class="form-control @error('visit_date')
                            is-invalid
                        @enderror"
                        value="{{ $visit->visit_date }}"
                        />
                        @error('visit_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sponsor_id" class="form-label">Sponsor</label>
                        <select class="form-control" id="sponsor_id" name="sponsor_id" required >
                            @foreach($sponsors as $sponsorId => $sponsorName)
                                <option value="{{ $sponsorId }}" {{ $visit->sponsor_id == $sponsorId ? 'selected' : '' }}>
                                    {{ $sponsorName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror">
                            {{ $visit->description }}
                        </textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Update</button> | <a href="{{ route('visits.index') }}" class="btn btn-info">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
