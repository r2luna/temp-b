<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\EmailList;
use App\Models\Template;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $emailList = EmailList::inRandomOrder()->first();
            $template = Template::query()->inRandomOrder()->first();

            Campaign::factory()->create([
                'email_list_id' => $emailList->id,
                'template_id' => $template->id,
            ]);
        }

    }
}
