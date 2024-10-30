<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignMail extends Model
{
    use HasFactory;

    public function scopeStatistics(Builder $query)
    {
        return $query->selectRaw('
                    count(subscriber_id) as total_subscribers
                ,  sum(openings) as total_openings
                ,  count(case when openings > 0 then subscriber_id end) as unique_openings
                ,  round((cast(count(case when openings > 0 then subscriber_id end) as float) / cast(count(subscriber_id) as float)) * 100) as openings_rate
                ,  sum(clicks) as total_clicks
                ,  count(case when clicks > 0 then subscriber_id end) as unique_clicks
                ,  round((cast(count(case when clicks > 0 then subscriber_id end) as float) / cast(count(subscriber_id) as float)) * 100) as clicks_rate
            ');
    }

    public function scopeOpenings(Builder $query, ?string $search)
    {
        return $query->with('subscriber')
            ->when($search, fn (Builder $query) => $query
                ->whereHas(
                    'subscriber', fn (Builder $query) => $query
                        ->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                )->orWhere('openings', '=', $search)
            )
            ->orderByDesc('openings');
    }

    public function scopeClicks(Builder $query, ?string $search)
    {
        return $query->with('subscriber')
            ->when($search, fn (Builder $query) => $query
                ->whereHas(
                    'subscriber', fn (Builder $query) => $query
                        ->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                )->orWhere('clicks', '=', $search)
            )
            ->orderByDesc('clicks');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}
