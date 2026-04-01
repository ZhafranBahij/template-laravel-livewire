<?php

namespace App\Livewire\Role;

use App\Livewire\Forms\RoleForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RoleCreate extends Component
{
    public RoleForm $form;

    public function mount()
    {
        $this->form->setFirst();
    }

    public function submit()
    {
        $this->form->store();

        Session::flash('message', 'Role successfully created.');

        $this->redirectRoute('role.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.role.role-form');
    }
}
