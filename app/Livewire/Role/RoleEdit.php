<?php

namespace App\Livewire\Role;

use App\Livewire\Forms\RoleForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleEdit extends Component
{
    public RoleForm $form;

    public function mount(Role $role)
    {
        $this->form->setData($role);
    }

    public function submit()
    {
        $this->form->update();

        Session::flash('message', 'Role successfully updated.');

        $this->redirectRoute('role.index');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.role.role-form');
    }
}
