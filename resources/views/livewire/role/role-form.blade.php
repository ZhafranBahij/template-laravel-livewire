<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <h2 class="text-2xl font-bold">
        Role Form
    </h2>
    <form wire:submit.prevent="submit" class="flex flex-col gap-4">

        <flux:input wire:model="form.name" label="Name" type="text" />

        @foreach ($this->form->groupedPermissions as $resource => $permissions)
            <flux:fieldset>
                <flux:legend>{{ str($resource)->headline() }} Permissions</flux:legend>
                <flux:description>Control what actions can be performed on {{ str($resource)->lower() }}.
                </flux:description>
                <div class="flex flex-wrap gap-4 *:gap-x-2">
                    @foreach ($permissions as $permission)
                        <flux:checkbox wire:model="form.selectedPermissions" value="{{ $permission['name'] }}"
                            label="{{ str($permission['name'])->after('.')->headline() }}" />
                    @endforeach
                </div>
            </flux:fieldset>
        @endforeach

        <div class="flex flex-row">
            <flux:button variant="ghost" href="{{ route('role.index') }}" wire:navigate>
                Back
            </flux:button>
            <flux:button variant="primary" color="sky" type="submit">
                Submit
            </flux:button>
        </div>
    </form>
</div>
