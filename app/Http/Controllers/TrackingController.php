<?php

namespace App\Http\Controllers;

use App\Models\CampaignMail;

class TrackingController extends Controller
{
    public function openings(CampaignMail $mail)
    {
        $mail->openings++;
        $mail->save();
    }

    public function clicks(CampaignMail $mail)
    {
        $mail->clicks++;
        $mail->save();

        return redirect()->away(
            request()->get('f')
        );
    }
}
