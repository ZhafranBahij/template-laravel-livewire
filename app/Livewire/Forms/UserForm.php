<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class UserForm extends Form
{
    public User $user;
    public $name, $email, $password, $profile;
    public array $roles = [];
    public array $selectedRoles = [];
    public $formType = 'create';

    public function setFirst()
    {
        $this->roles = Role::pluck('name')->toArray();
    }

    public function setData(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->formType = 'edit';
        $this->selectedRoles = User::find($user->id)->roles->pluck('name')->toArray();
    }

    protected function rules()
    {
        if ($this->formType == 'edit') {
            return [
                'name' => 'required|max:255|string',
                'email' => 'required|email|max:255',
            ];
        }

        return [
            'name' => 'required|max:255|string',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|max:255',
            'profile' => 'nullable|file',
        ];
    }

    public function store()
    {
        $data = $this->validate();
        unset($data['profile']);

        DB::transaction(function () use ($data) {
            $user = User::create($data);
            $user->syncRoles($this->selectedRoles);

            if ($this->profile) {
                $user->addMedia($this->profile)->toMediaCollection('profile');
            }
        });
    }

    public function update()
    {
        $data = $this->validate();
        unset($data['profile']);

        DB::transaction(function () use ($data) {
            $this->user->update($data);
            $this->user->syncRoles($this->selectedRoles);

            if ($this->profile) {
                $this->user->clearMediaCollection('profile');
                $this->user->addMedia($this->profile)->toMediaCollection('profile');
            }
        });
    }
}
