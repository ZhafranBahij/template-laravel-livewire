<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\LivewireFilepond\WithFilePond;

class UserEdit extends Component
{
    use WithFilePond;
    public UserForm $form;

    public function mount(User $user)
    {
        $this->form->setFirst();
        $this->form->setData($user);
    }

    public function submit()
    {
        $this->form->update();

        Session::flash('message', 'User successfully updated.');

        $this->redirectRoute('user.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.user-form');
    }
}
