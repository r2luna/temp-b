<?php

test('testando tela de login', function () {
    $this->get('/login')
        ->assertOk();
});

it('should be able to login', function () {
    $this->get('/login')
        ->assertOk();
});
