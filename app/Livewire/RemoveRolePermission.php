<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RemoveRolePermission extends Component
{
    public $roleId;
    public $availablePermissions = [];
    public $removableSelectedPermissions = [];

    public function mount($roleId)
    {
        $this->roleId = $roleId;
        $this->removableSelectedPermissions = [];
    }

    public function render()
    {
        $role = Role::find($this->roleId);

        if (!$role) {
            return abort(404);
        }

        $rolePermissions = $role->permissions()->pluck('name', 'id');

        return view('livewire.remove-role-permission', compact('role', 'rolePermissions',));
    }

    public function submit()
    {
        $role = Role::findById($this->roleId);

        foreach ($this->removableSelectedPermissions as $permissionId) {
            $permission = Permission::findById($permissionId);
            if ($permission) {
                $role->revokePermissionTo($permission);
            }
        }

        return redirect()->route('roles.details', $role->id)
            ->with('msg', 'Permissions revoked successfully!')
            ->with('flag', 'alert-danger');
    }
}
