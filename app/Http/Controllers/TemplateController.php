<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        $search = request()->get('search', null);
        $withTrashed = request()->get('withTrashed', false);

        return view('template.index', [
            'templates' => Template::query()
                ->when($withTrashed, fn (Builder $query) => $query->withTrashed())
                ->when($search, fn (Builder $query) => $query->where('name', 'like', "%$search%")->orWhere('id', '=', $search))
                ->paginate(5)
                ->appends(compact('search')),
            'search' => $search,
            'withTrashed' => $withTrashed,
        ]);
    }

    public function create()
    {
        return view('template.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'body' => ['required'],
        ]);

        Template::create($data);

        return to_route('template.index')
            ->with('message', __('Template successfully create!'));
    }

    public function show(Template $template)
    {
        return view('template.show', compact('template'));
    }

    public function edit(Template $template)
    {
        return view('template.edit', compact('template'));
    }

    public function update(Request $request, Template $template)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'body' => ['required'],
        ]);

        $template->fill($data);
        $template->save();

        return back()
            ->with('message', __('Template successfully updated!'));
    }

    public function destroy(Template $template)
    {
        $template->delete();

        return to_route('template.index')
            ->with('message', __('Template successfully updated!'));
    }
}
