<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $states = State::with('country')->orderBy('name')->paginate();
        if (\request()->search){
            $search = request()->search;
            $states = State::where('name', 'like', "%{$search}%")->latest()->paginate();
        }
        $countries = Country::orderBy('name')->get();

        return view('states.index', compact('states', 'countries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:states',
            'country_id' => 'required|integer',
        ]);

        State::create($data);

        return back()->with('message', 'State Added!');
    }

    public function update(Request $request, State $state)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:states,name,'.$state->id,
            'country_id' => 'required|integer',
        ]);

        $state->update($data);

        return back()->with('message', 'State Updated!');
    }

    public function destroy(State $state)
    {
        $state->delete();
        return back()->with('message', 'State deleted!');
    }
}
