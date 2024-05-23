@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">{{ $title }}</h4>
                @livewire('student-report')
            </div>
        </div>
    </div>
@endsection
