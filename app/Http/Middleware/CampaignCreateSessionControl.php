<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CampaignCreateSessionControl
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! str($request->header('referer'))->contains($request->route()->compiled->getStaticPrefix())) {
            session()->forget('campaign');
        } else {
            $session = session()->get('campaign');
            $tab = $request->route('tab');

            if (filled($tab) && blank(data_get($session, 'name'))) {
                return to_route('campaigns.create');
            }

            if ($tab == 'schedule' && blank(data_get($session, 'body'))) {
                return to_route('campaigns.create', ['tab' => 'template']);
            }
        }

        return $next($request);
    }
}
