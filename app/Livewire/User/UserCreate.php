<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\LivewireFilepond\WithFilePond;

class UserCreate extends Component
{
    use WithFilePond;
    public UserForm $form;

    public function mount()
    {
        //
    }

    public function submit()
    {
        $this->form->store();

        Session::flash('message', 'User successfully created.');

        $this->redirectRoute('user.index');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.user-form');
    }
}
