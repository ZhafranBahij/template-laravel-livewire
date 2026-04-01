<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div>
        <div class="flex flex-row gap-2 items-center">
            <h2 class="text-2xl font-bold">User</h2>
            @can('user.create')
                <flux:button href="{{ route('user.create') }}" variant="primary" icon="plus" wire:navigate>
                    Create
                </flux:button>
            @endcan
        </div>

        <div class="flex flex-row justify-end gap-x-2">
            <div class="w-32">
                <flux:input wire:model.live.debounce.250ms="search" placeholder="Search..." icon="magnifying-glass"
                    class="w-32" />
            </div>
        </div>
        <flux:table>
            <flux:table.columns>
                <flux:table.column>Action</flux:table.column>
                <flux:table.column>User</flux:table.column>
                <flux:table.column>Email</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach ($users as $data)
                    <flux:table.row :key="$data->id">
                        <flux:table.cell>
                            @can('user.edit')
                                <flux:button href="{{ route('user.edit', $data->id) }}" variant="ghost" size="sm"
                                    icon="pencil" inset="top bottom" wire:navigate>
                                    Edit
                                </flux:button>
                            @endcan
                            @can('user.delete')
                                <flux:button wire:click="delete({{ $data->id }})" variant="danger" size="sm"
                                    icon="trash" inset="top bottom">
                                    Delete
                                </flux:button>
                            @endcan
                        </flux:table.cell>
                        <flux:table.cell class="flex items-center gap-3">
                            <flux:avatar size="xs" src="{{ $data->getFirstMediaUrl('profile') }}" />
                            {{ $data->name }}
                        </flux:table.cell>
                        <flux:table.cell variant="strong">{{ $data->email }}</flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
        {{ $users->links() }}
    </div>
</div>
