<?php

use App\Models\Todo;
use App\Models\User;

test('Todo 一覧が表示される', function () {
    $todo = Todo::factory()->create();

    $this->get(route('todos.index'))
        ->assertOk()
        ->assertSee($todo->title);
});

test('他人の Todo は編集画面を開けない', function () {
    $todo = Todo::factory()->create();
    $other = User::factory()->create();

    $this->actingAs($other)
        ->get(route('todos.edit', $todo))
        ->assertForbidden();
});
