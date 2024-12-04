<?php

use App\Models\Campaign;
use App\Models\CampaignMail;
use App\Models\EmailList;
use App\Models\Subscriber;

use function Pest\Laravel\get;

beforeEach(function () {
    login();

    $emailList = EmailList::factory()->has(Subscriber::factory()->count(3))->create();
    $this->campaign = Campaign::factory()->for($emailList)->create(['send_at' => now()->addDays(2)->format('Y-m-d')]);
    CampaignMail::query()->create(['clicks' => 7, 'openings' => 0, 'campaign_id' => $this->campaign->id, 'subscriber_id' => $emailList->subscribers[0]->id, 'sent_at' => $this->campaign->send_at]);
    CampaignMail::query()->create(['clicks' => 5, 'openings' => 23, 'campaign_id' => $this->campaign->id, 'subscriber_id' => $emailList->subscribers[1]->id, 'sent_at' => $this->campaign->send_at]);
    CampaignMail::query()->create(['clicks' => 0, 'openings' => 54, 'campaign_id' => $this->campaign->id, 'subscriber_id' => $emailList->subscribers[2]->id, 'sent_at' => $this->campaign->send_at]);
});

it('should show all the statistcs for the given campaign', function () {
    get(route('campaigns.show', ['campaign' => $this->campaign, 'what' => 'statistics']))
        ->assertViewHas('query', function ($query) {
            expect($query)
                ->total_openings->toBe(77)
                ->total_clicks->toBe(12)
                ->unique_openings->toBe(2)
                ->unique_clicks->toBe(2)
                ->openings_rate->toBe(67.0)
                ->clicks_rate->toBe(67.0);

            return true;
        })
        ->assertSeeInOrder([
            77, 'Opens',
            2, 'Unique Opens',
            '67%', 'Open rate',
            12, 'Clicks',
            2, 'Unique Clicks',
            '67%', 'Clicks Rate',
        ]);
});
