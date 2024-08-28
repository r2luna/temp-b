<?php

namespace App\Jobs;

use App\Mail\EmailCampaign;
use App\Models\Campaign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailCampaign implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Campaign $campaign
    ) {
        //
    }

    public function handle(): void
    {
        foreach ($this->campaign->emailList->subscribers as $subscriber) {
            Mail::to($subscriber->email)
                ->later($this->campaign->send_at, new EmailCampaign($this->campaign));
        }
    }
}
