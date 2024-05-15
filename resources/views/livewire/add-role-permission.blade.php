<form wire:submit.prevent="submit">
    @csrf
    @if ($availablePermissions->isEmpty())
        <p>No permissions available to assign. This role may already have all permissions.</p>
    @else
        @foreach ($availablePermissions as $permissionId => $permissionName)
            <div class="form-group">
                <input wire:model="selectedPermissions" type="checkbox" value="{{ $permissionName }}" id="{{ $permissionName }}"/>
                <label for="{{ $permissionName }}">{{ $permissionName }}</label>
            </div>
            <hr>
        @endforeach
    @endif

    <button type="submit" class="btn btn-primary btn-block">Assign Permissions</button>
</form>

