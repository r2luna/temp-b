<?php

use App\Models\Subscriber;

use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\delete;

it('should be able to delete a subscriber from a list', function () {
    login();
    $subscriber = Subscriber::factory()->create();

    delete(
        route('subscribers.destroy', ['emailList' => $subscriber->emailList, 'subscriber' => $subscriber])
    )->assertRedirect();

    assertSoftDeleted('subscribers', [
        'id' => $subscriber->id,
    ]);
});
