<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\DB;
use Livewire\Form;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleForm extends Form
{
    public Role $role;

    public $name;

    public array $selectedPermissions = [];

    public array $groupedPermissions = [];

    public $formType = 'create';

    public function setFirst()
    {
        // Group permissions by resource (e.g. "user", "role")
        $this->groupedPermissions = Permission::all()
            ->groupBy(fn ($p) => str($p->name)->before('.')->toString())
            ->toArray();
    }

    public function setData(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->formType = 'edit';
        $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
    }

    protected function rules()
    {
        if ($this->formType == 'edit') {
            return [
                'name' => 'required|max:255|string',
            ];
        }

        return [
            'name' => 'required|max:255|string',
        ];
    }

    public function store()
    {
        $data = $this->validate();

        DB::transaction(function () use ($data) {
            $role = Role::create($data);
            $role->syncPermissions($this->selectedPermissions);
        });
    }

    public function update()
    {
        $data = $this->validate();

        DB::transaction(function () use ($data) {
            $this->role->update($data);
            $this->role->syncPermissions($this->selectedPermissions);
        });
    }
}
