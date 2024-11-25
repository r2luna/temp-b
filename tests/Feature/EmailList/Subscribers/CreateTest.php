<?php

use App\Models\EmailList;
use App\Models\Subscriber;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

beforeEach(function () {
    login();

    $this->emailList = EmailList::factory()->create();
    $this->route = route('subscribers.create', $this->emailList);
});

it('should be able to create a new subcriber', function () {
    post($this->route, ['name' => 'Joe Doe', 'email' => 'joe@doe.com'])
        ->assertRedirect(route('subscribers.index', $this->emailList));

    assertDatabaseHas('subscribers', [
        'email_list_id' => $this->emailList->id,
        'name' => 'Joe Doe',
        'email' => 'joe@doe.com',
    ]);
});

test('name should be required', function () {
    post($this->route, ['name' => null, 'email' => 'joe@doe.com'])
        ->assertSessionHasErrors(['name' => __('validation.required', ['attribute' => 'name'])]);
});

test('name should have a max of 255 character', function () {
    post($this->route, ['name' => str_repeat('*', 256), 'email' => 'joe@doe.com'])
        ->assertSessionHasErrors(['name' => __('validation.max.string', ['attribute' => 'name', 'max' => 255])]);
});

test('email should be required', function () {
    post($this->route, ['name' => null, 'email' => null])
        ->assertSessionHasErrors(['email' => __('validation.required', ['attribute' => 'email'])]);
});

test('email should be an email', function () {
    post($this->route, ['name' => null, 'email' => 'not-real-email'])
        ->assertSessionHasErrors(['email' => __('validation.email', ['attribute' => 'email'])]);
});

test('email should have a max of 255 character', function () {
    post($this->route, ['email' => str_repeat('a', 256).'@email.com'])
        ->assertSessionHasErrors(['email' => __('validation.max.string', ['attribute' => 'email', 'max' => 255])]);
});

test('email should be unique inside an email list', function () {
    Subscriber::factory()->create(['email_list_id' => $this->emailList->id, 'email' => 'joe@doe.com']);

    post($this->route, ['name' => null, 'email' => 'joe@doe.com'])
        ->assertSessionHasErrors(['email' => __('validation.unique', ['attribute' => 'email'])]);
});
