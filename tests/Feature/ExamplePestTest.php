<?php


test('testando tela de login', function(){
    $this->get('/login')
        ->assertOk();
});
// it();
