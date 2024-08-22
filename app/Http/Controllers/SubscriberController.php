<?php

namespace App\Http\Controllers;

use App\Models\EmailList;
use Illuminate\Database\Eloquent\Builder;

class SubscriberController extends Controller
{
    public function index(EmailList $emailList)
    {
        $search = request()->search;

        return view('subscriber.index', [
            'emailList' => $emailList,
            'subscribers' => $emailList
                ->subscribers()

                ->when($search, fn (Builder $query) => $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('id', '=', $search)
                )
                ->paginate(),
            'search' => $search,
        ]);
    }
}
