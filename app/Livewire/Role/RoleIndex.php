<?php

namespace App\Livewire\Role;

use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleIndex extends Component
{
    public $search = '';

    public function mount()
    {
        if (session()->has('message')) {
            LivewireAlert::title(Session('message'))
                ->success()
                ->show();
        }
    }

    public function delete($id)
    {
        LivewireAlert::title('Delete Item')
            ->text('Are you sure you want to delete this item?')
            ->asConfirm()
            ->onConfirm('deleteItem', ['id' => $id])
            ->show();
    }

    public function deleteItem($data)
    {
        $itemId = $data['id'];

        Role::destroy($itemId);

        LivewireAlert::title('Success')
            ->text('Data Delete successfully.')
            ->success()
            ->timer(2000)
            ->show();

        $this->redirectRoute('role.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {

        $roles = Role::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.role.role-index', compact('roles'));
    }
}
