<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function emailList(): BelongsTo
    {
        return $this->belongsTo(EmailList::class);
    }
}
