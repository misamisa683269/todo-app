<?php

use App\Models\Todo;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Title('ToDoを編集')] class extends Component {
    public Todo $todo;

    #[Validate('required|string|max:100')]
    public string $title = '';

    #[Validate('nullable|string|max:2000')]
    public string $description = '';

    public function mount(Todo $todo): void
    {
        abort_unless($todo->user_id === auth()->id(), 403);
        $this->todo = $todo;
        $this->title = $todo->title;
        $this->description = $todo->description ?? '';
    }

    public function save(): void
    {
        abort_unless($this->todo->user_id === auth()->id(), 403);
        $this->todo->update($this->validate());

        session()->flash('status', 'ToDoを更新しました。');

        $this->redirectRoute('todos.index', navigate: true);
    }

    public function delete(): void
    {
        abort_unless($this->todo->user_id === auth()->id(), 403);
        $this->todo->delete();

        session()->flash('status', 'ToDoを削除しました。');

        $this->redirectRoute('todos.index', navigate: true);
    }
};
?>

<div class="mx-auto max-w-2xl space-y-6">
    <flux:heading size="xl">ToDoを編集</flux:heading>

    <form wire:submit="save" class="space-y-6">
        <flux:input wire:model="title" label="タイトル" />
        <flux:textarea wire:model="description" label="説明" rows="4" />

        <div class="flex justify-between">
            <flux:button wire:click="delete" wire:confirm="このToDoを削除しますか？" variant="danger" icon="trash">
                削除
            </flux:button>
            <div class="flex gap-3">
                <flux:button :href="route('todos.index')" variant="ghost" wire:navigate>キャンセル</flux:button>
                <flux:button type="submit" variant="primary">更新する</flux:button>
            </div>
        </div>
    </form>
</div>
