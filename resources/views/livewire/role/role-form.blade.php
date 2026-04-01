<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <h2 class="text-2xl font-bold">
        Role Form
    </h2>
    <form wire:submit.prevent="submit" class="flex flex-col gap-4">

        <flux:input wire:model="form.name" label="Name" type="text" />

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
