<?php

use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    #[Validate('required|string|max:100')]
    public string $title = '';

    #[Validate('nullable|string|max:2000')]
    public string $description = '';

    public function save(): void
    {
        $validated = $this->validate();

        auth()->user()->todos()->create($validated);

        session()->flash('status', 'ToDoを登録しました。');

        $this->redirectRoute('dashboard', navigate: true);
    }
};
?>

<div class="mx-auto max-w-2xl space-y-6">
    <flux:heading size="xl">ToDoを登録</flux:heading>

    <form wire:submit="save" class="space-y-6">
        <flux:input wire:model="title" label="タイトル" placeholder="例: 宿題をやる" />
        <flux:textarea wire:model="description" label="説明" rows="4" />

        <div class="flex justify-end gap-3">
            <flux:button :href="route('dashboard')" variant="ghost" wire:navigate>キャンセル</flux:button>
            <flux:button type="submit" variant="primary">登録する</flux:button>
        </div>
    </form>
</div>
