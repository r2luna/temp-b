<?php

namespace App\Http\Controllers;

use App\Models\CampaignMail;

class TrackingController extends Controller
{
    public function openings(CampaignMail $mail)
    {
        if (! $mail->campaign->track_open) {
            return;
        }

        $mail->openings++;
        $mail->save();
    }

    public function clicks(CampaignMail $mail)
    {
        if ($mail->campaign->track_click) {
            $mail->clicks++;
            $mail->save();
        }

        return redirect()->away(
            request()->get('f')
        );
    }
}
