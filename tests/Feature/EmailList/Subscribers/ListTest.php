<?php

use App\Models\EmailList;
use App\Models\Subscriber;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\get;
use function Pest\Laravel\getJson;

beforeEach(function () {
    $this->emailList = EmailList::factory()->create();

    login();
});

it('only logged users can access the subscribers', function () {
    Auth::logout();
    getJson(route('subscribers.index', $this->emailList))
        ->assertUnauthorized();
});

it('should be possible see the entire list of subscribers', function () {
    Subscriber::factory()->count(4)->create(0);
    Subscriber::factory()->count(5)->create(['email_list_id' => $this->emailList->id]);

    get(route('subscribers.index', $this->emailList))
        ->assertViewHas('emailList', $this->emailList)
        ->assertViewHas('subscribers', function ($value) {
            expect($value)
                ->count(5);

            expect($value)
                ->first()
                ->email_list_id
                ->toBe($this->emailList->id);

            return true;
        });
});

it('should be able to search a subscriber', function () {
    Subscriber::factory()->count(5)->create(['email_list_id' => $this->emailList->id]);
    Subscriber::factory()->create([
        'name' => 'Charlie Smith',
        'email' => 'joe@doe.com',
        'email_list_id' => $this->emailList->id,
    ]);

    // Filtrar com email
    get(route('subscribers.index', ['emailList' => $this->emailList, 'search' => 'joe']))
        ->assertViewHas('subscribers', function ($value) {
            expect($value)->count(1);
            expect($value)->first()->id->toBe(6);

            return true;
        });

    // Filtrar com nome
    get(route('subscribers.index', ['emailList' => $this->emailList, 'search' => 'smith']))
        ->assertViewHas('subscribers', function ($value) {
            expect($value)->count(1);
            expect($value)->first()->id->toBe(6);

            return true;
        });

});

it('should be able to search by id', function () {
    Subscriber::factory()->create(['name' => 'Joe Doe', 'email' => 'joe@doe.com', 'email_list_id' => $this->emailList->id]);
    Subscriber::factory()->create(['name' => 'Jane Doe', 'email' => 'jane@doe.com', 'email_list_id' => $this->emailList->id]);

    // Filtrar com id
    get(route('subscribers.index', ['emailList' => $this->emailList, 'search' => 2]))
        ->assertViewHas('subscribers', function ($value) {
            expect($value)->count(1);
            expect($value)->first()->id->toBe(2);

            return true;
        });
});

it('should be able to show deleted records', function () {
    Subscriber::factory()->create(['deleted_at' => now()]);
    Subscriber::factory()->create();

    get(route('subscribers.index', ['emailList' => $this->emailList]))
        ->assertViewHas('subscribers', function ($value) {
            expect($value)->count(1);

            return true;
        });

    get(route('subscribers.index', ['emailList' => $this->emailList, 'withTrashed' => 1]))
        ->assertViewHas('subscribers', function ($value) {
            expect($value)->count(2);

            return true;
        });
});

it('should be paginated', function () {
    Subscriber::factory()->count(30)->create();

    get(route('subscribers.index', ['emailList' => $this->emailList]))
        ->assertViewHas('subscribers', function ($value) {

            expect($value)->count(15);
            expect($value)->toBeInstanceOf(LengthAwarePaginator::class);

            return true;
        });
});
