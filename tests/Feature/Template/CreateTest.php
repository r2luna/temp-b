<?php

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

beforeEach(function () {
    login();

    $this->route = route('templates.store');
});

it('should be able to create a new template', function () {
    post($this->route, ['name' => 'Joe Doe', 'body' => '<span>Hello World!</span>'])
        ->assertRedirect(route('templates.index'));

    assertDatabaseHas('templates', [
        'name' => 'Joe Doe',
        'body' => '<span>Hello World!</span>',
    ]);
});

test('name should be required', function () {
    post($this->route, ['name' => null, 'body' => '<span>Hello World!</span>'])
        ->assertSessionHasErrors(['name' => __('validation.required', ['attribute' => 'name'])]);
});

test('name should have a max of 255 character', function () {
    post($this->route, ['name' => str_repeat('*', 256), 'body' => '<span>Hello World!</span>'])
        ->assertSessionHasErrors(['name' => __('validation.max.string', ['attribute' => 'name', 'max' => 255])]);
});

test('body should be required', function () {
    post($this->route, ['name' => null, 'body' => null])
        ->assertSessionHasErrors(['body' => __('validation.required', ['attribute' => 'body'])]);
});
