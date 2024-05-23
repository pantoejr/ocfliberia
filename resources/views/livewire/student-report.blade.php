@php
    $count = 1;
@endphp
<div class="card">
    <div class="card-body p-4">
        <form class="mb-3" wire:submit="download">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <select class="form-control text-center" wire:model="schoolId" wire:change="updateTable">
                        <option value="0">Select School</option>
                        @foreach ($schools as $school)
                            <option value="{{ $school->id }}">
                                {{ $school->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <button type="submit" class="btn btn-primary">Export</button>
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Institution</th>
                        <th>Class</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $student->fullname }}</td>
                            <td>{{ $student->date_of_birth }}</td>
                            <td>{{ $student->school->name }}</td>
                            <td>{{ $student->class }}</td>
                        </tr>
                        @php
                            $count++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
