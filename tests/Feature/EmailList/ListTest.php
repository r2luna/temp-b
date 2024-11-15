<?php

use App\Models\EmailList;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\get;
use function Pest\Laravel\getJson;

pest()->group('email-list');

beforeEach(function () {
    login();
});

test('needs to be authenticated', function () {
    Auth::logout();

    getJson(route('email-list.index'))->assertUnauthorized();

    login();

    get(route('email-list.index'))->assertSuccessful();
});

test('it should be paginate', function () {
    // Arrange
    EmailList::factory()->count(40)->create();

    // Act
    $response = get(route('email-list.index'));

    // Asset
    $response->assertViewHas('emailLists', function ($list) {
        expect($list)->toBeInstanceOf(LengthAwarePaginator::class);
        expect($list)->toHaveCount(5);

        return true;
    });
});

test('it should be able to search a list', function () {
    // Arrange
    EmailList::factory()->count(10)->create();
    EmailList::factory()->create(['title' => 'Title 1']);
    $emailList = EmailList::factory()->create(['title' => 'Title Testing 2']);

    // Act
    $response = get(route('email-list.index', ['search' => 'Testing 2']));

    // Asset
    $response->assertViewHas('emailLists', function ($list) use ($emailList) {

        expect($list)->toHaveCount(1);
        expect($list->first()->id)->toEqual($emailList->id);

        return true;
    });
});
