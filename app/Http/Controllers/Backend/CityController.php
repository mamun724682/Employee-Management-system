<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('state')->orderBy('name')->paginate();
        if (\request()->search){
            $search = request()->search;
            $cities = city::where('name', 'like', "%{$search}%")->latest()->paginate();
        }
        $states = State::orderBy('name')->get();

        return view('cities.index', compact('cities', 'states'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:cities',
            'state_id' => 'required|integer',
        ]);

        City::create($data);

        return back()->with('message', 'City Added!');
    }

    public function update(Request $request, City $city)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:cities,name,'.$city->id,
            'state_id' => 'required|integer',
        ]);

        $city->update($data);

        return back()->with('message', 'City Updated!');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return back()->with('message', 'City deleted!');
    }
}
