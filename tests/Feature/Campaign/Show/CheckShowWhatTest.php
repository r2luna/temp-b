<?php

use App\Models\Campaign;
use App\Models\EmailList;
use App\Models\Subscriber;

use function Pest\Laravel\get;

test('check if is null redirect to statistics', function () {
    login();
    $emailList = EmailList::factory()->has(Subscriber::factory()->count(3))->create();
    $campaign = Campaign::factory()->for($emailList)->create(['send_at' => now()->addDays(2)->format('Y-m-d')]);

    get(route('campaigns.show', ['campaign' => $campaign]))
        ->assertRedirectToRoute('campaigns.show', ['campaign' => $campaign, 'what' => 'statistics']);
});
