<form wire:submit.prevent="submit" >
    @csrf
    @foreach ($rolePermissions as $permissionId => $permissionName)
        <div class="form-group">
            <input type="checkbox" wire:model="removableSelectedPermissions" value="{{ $permissionId }}" id="{{ $permissionName }}">
            <label for="{{ $permissionName }}">{{ $permissionName }}</label>
        </div>
        <hr>
    @endforeach

    <button type="submit" class="btn bg-danger text-white btn-block">Remove Permissions</button>
</form>
