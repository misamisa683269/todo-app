<?php

test('トップページは Todo 一覧に転送される', function () {
    $this->get(route('home'))->assertRedirect('/todos');
});
