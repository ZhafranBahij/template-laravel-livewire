<?php

namespace App\Livewire\User;

use App\Models\User;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserIndex extends Component
{
    public $search = '';

    public $role = '';

    public function mount()
    {
        $this->authorize('viewAny', User::class);

        if (session()->has('message')) {
            LivewireAlert::title(Session('message'))
                ->success()
                ->show();
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);

        LivewireAlert::title('Delete Item')
            ->text('Are you sure you want to delete this item?')
            ->asConfirm()
            ->onConfirm('deleteItem', ['id' => $id])
            ->show();
    }

    public function deleteItem($data)
    {
        //

        $itemId = $data['id'];

        $user = User::findOrFail($itemId);
        $this->authorize('delete', $user);

        User::destroy($itemId);

        LivewireAlert::title('Success')
            ->text('Data Delete successfully.')
            ->success()
            ->timer(2000)
            ->show();

        $this->redirectRoute('user.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {

        $users = User::query()
            ->when($this->role, function ($query) {
                return $query->role($this->role);
            })
            ->where('name', 'like', '%'.$this->search.'%')
            ->latest()
            ->paginate(10);

        return view('livewire.user.user-index', compact('users'));
    }
}
