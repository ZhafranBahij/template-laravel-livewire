<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <h2 class="text-2xl font-bold">
        User Form
    </h2>
    <form wire:submit.prevent="submit" class="flex flex-col gap-4">

        <x-filepond::upload wire:model="form.profile" />

        <flux:input wire:model="form.email" label="Email" type="email" />
        <flux:input wire:model="form.name" label="Name" type="text" />

        <flux:fieldset>
            <flux:legend>Roles</flux:legend>
            <flux:description>Assign roles to this user.</flux:description>
            <div class="flex flex-wrap gap-4 *:gap-x-2">
                @foreach ($this->form->roles as $role)
                    <flux:checkbox wire:model="form.selectedRoles" value="{{ $role }}"
                        label="{{ str($role)->headline() }}" />
                @endforeach
            </div>
        </flux:fieldset>

        @if ($this->form->formType == 'create')
            <flux:input wire:model="form.password" label="Password" type="password" />
        @endif
        <div class="flex flex-row">
            <flux:button variant="ghost" href="{{ route('user.index') }}" wire:navigate>
                Back
            </flux:button>
            <flux:button variant="primary" color="sky" type="submit">
                Submit
            </flux:button>
        </div>
    </form>
</div>
