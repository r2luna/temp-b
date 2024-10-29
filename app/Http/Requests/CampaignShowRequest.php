<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignShowRequest extends FormRequest
{
    public function authorize(): bool
    {
        $campaign = $this->route('campaign');
        $what = $this->route('what');

        if (is_null($what)) {
            return to_route('campaigns.show', ['campaign' => $campaign, 'what' => 'statistics']);
        }
        abort_unless(in_array($what, ['statistics', 'open', 'clicked']), 404);

        return true;
    }
}
