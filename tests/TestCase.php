<?php

namespace Tests;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    public function login(): User|Authenticatable
    {
        /** @var User|Authenticatable $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        return $user;
    }
}
