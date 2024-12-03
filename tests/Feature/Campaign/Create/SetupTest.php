<?php

use App\Models\EmailList;
use App\Models\Template;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

beforeEach(function () {
    login();

    $this->route = route('campaigns.create');
});

test('when saving we need to update campaign session to have all the data', function () {
    EmailList::factory()->create();
    $template = Template::factory()->create();
    post($this->route, [
        'name' => 'First Campaign',
        'subject' => 'Subject',
        'email_list_id' => 1,
        'template_id' => 1,
        'track_click' => true,
        'track_open' => true,
    ]);

    expect(session()->get('campaign'))
        ->toBe([
            'name' => 'First Campaign',
            'subject' => 'Subject',
            'email_list_id' => 1,
            'template_id' => 1,
            'body' => $template->body,
            'track_click' => true,
            'track_open' => true,
            'send_at' => null,
            'send_when' => 'now',
        ]);
});

test('make sure that when we save the form we will be redirect back to the template tab', function () {
    EmailList::factory()->create();
    Template::factory()->create();
    post($this->route, [
        'name' => 'First Campaign',
        'subject' => 'Subject',
        'email_list_id' => 1,
        'template_id' => 1,
        'track_click' => true,
        'track_open' => true,
    ])->assertRedirect(route('campaigns.create', ['tab' => 'template']));
});

test('it should have on the view a list of email lists', function () {
    EmailList::factory()->count(2)->create();

    get($this->route)
        ->assertViewHas('emailLists', function ($value) {
            expect($value)->toHaveCount(2);

            expect($value->first())->toBeInstanceOf(EmailList::class);

            return true;
        });
});

test('it should have on the view a list of templates', function () {
    Template::factory()->count(2)->create();

    get($this->route)
        ->assertViewHas('templates', function ($value) {
            expect($value)->toHaveCount(2);

            expect($value->first())->toBeInstanceOf(Template::class);

            return true;
        });
});

test('it should have on the view a blank tab variable', function () {
    get($this->route)
        ->assertViewHas('tab', '');
});

test('it should have on the view the form variable set to _config', function () {
    get($this->route)
        ->assertViewHas('form', '_config');
});

test('it should have on the view all the data in the session in the variable data', function () {
    EmailList::factory()->create();
    $template = Template::factory()->create();

    post($this->route, [
        'name' => 'First Campaign',
        'subject' => 'Subject',
        'email_list_id' => 1,
        'template_id' => 1,
        'track_click' => true,
        'track_open' => true,
    ]);

    get($this->route, ['referer' => $this->route])
        ->assertViewHas('data', [
            'name' => 'First Campaign',
            'subject' => 'Subject',
            'email_list_id' => 1,
            'template_id' => 1,
            'body' => $template->body,
            'track_click' => true,
            'track_open' => true,
            'send_at' => null,
            'send_when' => 'now',
        ]);

});

test('if session is clear the variable data should have a default value', function () {
    expect(session('campaign'))->toBeNull();

    get($this->route)
        ->assertViewHas('data', [
            'name' => null,
            'subject' => null,
            'email_list_id' => null,
            'template_id' => null,
            'body' => null,
            'track_click' => null,
            'track_open' => null,
            'send_at' => null,
            'send_when' => 'now',
        ]);
});
// --
describe('validations', function () {
    test('required fields', function () {})->todo();
    test('name should have a max of 255 characters', function () {})->todo();
    test('subject should have a max of 40 characters', function () {})->todo();
    test('valid email list', function () {})->todo();
    test('valid template', function () {})->todo();
});
