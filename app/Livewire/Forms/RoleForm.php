<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class RoleForm extends Form
{
    public Role $role;
    public $name;
    public $formType = 'create';

    public function setData(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->formType = 'edit';
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
        });
    }

    public function update()
    {
        $data = $this->validate();

        DB::transaction(function () use ($data) {
            $this->role->update($data);
        });
    }
}
