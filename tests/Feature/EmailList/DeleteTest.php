<?php

namespace Tests\Feature\EmailList;

use App\Models\EmailList;
use App\Models\Subscriber;

use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\delete;

it('should be able to delete an email list', function () {
    // Arrange
    login();
    $emailList = EmailList::factory()->create();
    $subscribers = Subscriber::factory()->count(10)->create(['email_list_id' => $emailList->id]);

    // Act
    $response = delete(route('email-list.delete', ['emailList' => $emailList]));

    // Assert
    $response->assertRedirect(route('email-list.index'));
    assertSoftDeleted('email_lists', ['id' => $emailList->id]);
    foreach ($subscribers as $subscriber) {
        assertSoftDeleted('subscribers', ['id' => $subscriber->id]);
    }
});
