<?php

namespace Tests\Feature\EmailList;

use App\Models\EmailList;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class ListTest extends TestCase
{
    public function test_needs_to_be_authenticated()
    {
        $this->getJson(route('email-list.index'))->assertUnauthorized();

        /** @var Authenticatable $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->get(route('email-list.index'))->assertSuccessful();
    }

    public function test_it_should_be_paginate()
    {
        // Arrange
        /** @var Authenticatable $user */
        $user = User::factory()->create();

        $this->actingAs($user);
        EmailList::factory()->count(40)->create();

        // Act
        $response = $this->get(route('email-list.index'));

        // Asset
        $response->assertViewHas('emailLists', function ($list) {
            $this->assertInstanceOf(LengthAwarePaginator::class, $list);
            $this->assertCount(5, $list);

            return true;
        });
    }

    public function test_it_should_be_able_to_search_a_list()
    {
        // Arrange
        /** @var Authenticatable $user */
        $user = User::factory()->create();

        $this->actingAs($user);
        EmailList::factory()->count(10)->create();
        EmailList::factory()->create(['title' => 'Title 1']);
        $emailList = EmailList::factory()->create(['title' => 'Title Testing 2']);

        // Act
        $response = $this->get(route('email-list.index', ['search' => 'Testing 2']));

        // Asset
        $response->assertViewHas('emailLists', function ($list) use ($emailList) {

            $this->assertCount(1, $list);
            $this->assertEquals($emailList->id, $list->first()->id);

            return true;
        });
    }
}
