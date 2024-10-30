<?php

namespace App\Jobs;

use App\Mail\EmailCampaign;
use App\Models\Campaign;
use App\Models\CampaignMail;
use App\Models\Subscriber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmailCampaignJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Campaign $campaign,
        public Subscriber $subscriber
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mail = CampaignMail::query()
            ->create([
                'campaign_id' => $this->campaign->id,
                'subscriber_id' => $this->subscriber->id,
                'sent_at' => $this->campaign->send_at,
            ]);

        Mail::to($this->subscriber->email)
            ->later($this->campaign->send_at, new EmailCampaign($this->campaign, $mail));
    }
}
