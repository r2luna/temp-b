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
}
