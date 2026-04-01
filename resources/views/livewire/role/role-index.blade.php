<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div>
        <div class="flex flex-row gap-2 items-center">
            <h2 class="text-2xl font-bold">Role</h2>
            @can('create-role')
                <flux:button href="{{ route('role.create') }}" variant="primary" icon="plus" wire:navigate>
                    Create
                </flux:button>
            @endcan
        </div>

        <div class="flex flex-row justify-end gap-x-2">
            {{-- <div>
                <flux:select wire:model.live.debounce.250ms="role" placeholder="Choose role...">
                    <flux:select.option></flux:select.option>
                    <flux:select.option>admin</flux:select.option>
                    <flux:select.option>participant</flux:select.option>
                </flux:select>
            </div> --}}
            <div class="w-32">
                <flux:input wire:model.live.debounce.250ms="search" placeholder="Search..." icon="magnifying-glass"
                    class="w-32" />
            </div>
        </div>
        <flux:table>
            <flux:table.columns>
                <flux:table.column>Action</flux:table.column>
                <flux:table.column>Role</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach ($roles as $data)
                    <flux:table.row :key="$data->id">
                        <flux:table.cell>
                            @can('edit-role')
                                <flux:button href="{{ route('role.edit', $data->id) }}" variant="ghost" size="sm"
                                    icon="pencil" inset="top bottom" wire:navigate>
                                    Edit
                                </flux:button>
                            @endcan
                            @can('delete-role')
                                <flux:button wire:click="delete({{ $data->id }})" variant="danger" size="sm"
                                    icon="trash" inset="top bottom">
                                    Delete
                                </flux:button>
                            @endcan
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $data->name }}
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
        {{ $roles->links() }}
    </div>
</div>
