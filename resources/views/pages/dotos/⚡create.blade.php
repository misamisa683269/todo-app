<?php

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Title('ToDoを登録')] class extends Component {
    #[Validate('required|string|max:100')]
    public string $title = '';

    #[Validate('nullable|string|max:2000')]
    public string $description = '';

    public bool $submitted = false;

    public function save(): void
    {
        $this->validate();
        $this->submitted = true;
    }
}; ?>

<div class="mx-auto max-w-2xl space-y-6">
    <flux:heading size="xl">ToDoを登録</flux:heading>

    @if ($submitted)
        <flux:callout variant="success" icon="check-circle">
            <flux:callout.heading>入力内容を受け付けました</flux:callout.heading>
            <flux:callout.text>{{ $title }}</flux:callout.text>
        </flux:callout>
    @endif

    <form wire:submit="save" class="space-y-6">
        <flux:input wire:model="title" label="タイトル" placeholder="例: 宿題をやる" />
        <flux:textarea wire:model="description" label="説明" rows="4" />

        <div class="flex justify-end">
            <flux:button type="submit" variant="primary">登録する</flux:button>
        </div>
    </form>
</div>
