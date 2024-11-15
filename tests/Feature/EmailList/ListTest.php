<?php

namespace Tests\Feature\EmailList;

use App\Models\EmailList;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ListTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->login();
    }

    public function test_needs_to_be_authenticated()
    {
        Auth::logout();

        $this->getJson(route('email-list.index'))->assertUnauthorized();

        $this->login();

        $this->get(route('email-list.index'))->assertSuccessful();
    }

    public function test_it_should_be_paginate()
    {
        // Arrange
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
