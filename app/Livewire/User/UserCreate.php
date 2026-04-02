<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
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
        $this->authorize('create', User::class);

        $this->form->setFirst();
    }

    public function submit()
    {
        $this->authorize('create', User::class);

        $this->form->store();

        Session::flash('message', 'User successfully created.');

        $this->redirectRoute('user.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.user-form');
    }
}
