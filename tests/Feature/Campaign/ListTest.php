<?php

use App\Models\Campaign;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\get;
use function Pest\Laravel\getJson;

beforeEach(function () {
    login();
});

it('only logged users can access campaigns', function () {
    Auth::logout();
    getJson(route('campaigns.index'))
        ->assertUnauthorized();
});

it('should be possible see the entire list of campaigns', function () {
    Campaign::factory()->count(5)->create();

    get(route('campaigns.index'))
        ->assertViewHas('campaigns', function ($value) {
            expect($value)->count(5);

            return true;
        });
});

it('should be able to search a template by name', function () {
    Campaign::factory()->count(5)->create();
    Campaign::factory()->create(['name' => 'Charlie Smith']);

    get(route('campaigns.index', ['search' => 'Charlie']))
        ->assertViewHas('campaigns', function ($value) {
            expect($value)->count(1);
            expect($value)->first()->id->toBe(6);

            return true;
        });
});

it('should be able to search by id', function () {
    Campaign::factory()->create(['name' => 'Joe Doe']);
    Campaign::factory()->create(['name' => 'Jane Doe']);

    get(route('campaigns.index', ['search' => 2]))
        ->assertViewHas('campaigns', function ($value) {
            expect($value)->count(1);
            expect($value)->first()->id->toBe(2);

            return true;
        });
});

it('should be able to show deleted records', function () {
    Campaign::factory()->create(['deleted_at' => now()]);
    Campaign::factory()->create();

    get(route('campaigns.index'))
        ->assertViewHas('campaigns', function ($value) {
            expect($value)->count(1);

            return true;
        });

    get(route('campaigns.index', ['withTrashed' => 1]))
        ->assertViewHas('campaigns', function ($value) {
            expect($value)->count(2);

            return true;
        });
});

it('should be paginated', function () {
    Campaign::factory()->count(30)->create();

    get(route('campaigns.index'))
        ->assertViewHas('campaigns', function ($value) {

            expect($value)->count(5);
            expect($value)->toBeInstanceOf(LengthAwarePaginator::class);

            return true;
        });
});
