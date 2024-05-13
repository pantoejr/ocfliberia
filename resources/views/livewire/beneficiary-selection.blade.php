<div class="row">
    <div class="col-md-12">
        <div class="row">
            @foreach ($beneficiaries as $beneficiary)
            <div class="col-md-2">
                <input type="checkbox" name="beneficiaries[]" value="{{ $beneficiary->id }}">
                <label>{{ $beneficiary->fullname }}</label>
            </div>
        @endforeach
        </div>
    </div>
</div>
