<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::livewire('/todos', 'pages::todos.index')->name('todos.index');
    Route::livewire('/todos/create', 'pages::todos.create')->name('todos.create');
    Route::livewire('/todos/{todo}/edit', 'pages::todos.edit')->name('todos.edit');
});

require __DIR__ . '/settings.php';
