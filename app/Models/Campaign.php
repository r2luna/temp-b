<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected function casts()
    {
        return [
            'send_at' => 'datetime',
        ];
    }

    public function emailList()
    {
        return $this->belongsTo(EmailList::class);
    }

    public function mails()
    {
        return $this->hasMany(CampaignMail::class);
    }
}
