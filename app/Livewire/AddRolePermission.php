<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddRolePermission extends Component
{
    public $roleId;
    public $availablePermissions = [];
    public $selectedPermissions = [];

    public function mount($roleId)
    {
        $this->roleId = $roleId;
        $this->availablePermissions = Permission::pluck('name', 'id');
        $this->selectedPermissions = $this->getRolePermissions();
        $assignedPermissions = $this->selectedPermissions->toArray();
        $this->availablePermissions = $this->availablePermissions->except($assignedPermissions);
    }

    public function render()
    {
        $role = Role::findById($this->roleId);
        $availablePermissions = $this->availablePermissions;
        $selectedPermissions = $this->selectedPermissions;
        if (!$role) {
            return abort(404);
        }

        return view('livewire.add-role-permission', compact('role', 'availablePermissions', 'selectedPermissions'));
    }

    public function getRolePermissions()
    {
        return $role = Role::findById($this->roleId)->permissions()->pluck('id');
    }

    public function submit()
    {
        $role = Role::findById($this->roleId);
        $role->syncPermissions($this->selectedPermissions);
        return redirect()->route('roles.details', $role->id)->with('msg', 'Permissions assigned successfully!')->with('flag','alert-success');
    }
}
