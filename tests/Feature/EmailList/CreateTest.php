<?php

namespace Tests\Feature\EmailList;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CreateTest extends TestCase
{
    public function test_title_should_be_required()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->post(route('email-list.create'), [])
            ->assertSessionHasErrors(['title']);
    }

    public function test_title_should_have_a_max_of_255_characters()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->post(route('email-list.create'), ['title' => str_repeat('*', 256)])
            ->assertSessionHasErrors(['title']);
    }

    public function test_file_should_be_required()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->post(route('email-list.create'), [])
            ->assertSessionHasErrors(['file']);
    }

    public function test_it_should_be_able_create_an_email_list()
    {
        // Arrange
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'title' => 'Email List Test',
            'file' => UploadedFile::fake()->createWithContent(
                'sample_names.csv',
                <<<'CSV'
                Name,Email
                Joe Doe,joe@doe.com
                CSV
            ),
        ];

        // Act
        $request = $this->post(route('email-list.create'), $data);

        // Assert
        $request->assertRedirectToRoute('email-list.index');

        $this->assertDatabaseHas('email_lists', [
            'title' => 'Email List Test',
        ]);

        $this->assertDatabaseHas('subscribers', [
            'email_list_id' => 1,
            'name' => 'Joe Doe',
            'email' => 'joe@doe.com',
        ]);
    }
}
