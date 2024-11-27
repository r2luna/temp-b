<?php

use App\Models\Template;

use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\delete;

it('should be able to delete a template from a list', function () {
    login();
    $template = Template::factory()->create();

    delete(route('templates.destroy', ['template' => $template]))
        ->assertRedirectToRoute('templates.index')
        ->assertSessionHas('message', __('Template successfully deleted!'));

    assertSoftDeleted('templates', [
        'id' => $template->id,
    ]);
});
