<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('name')->paginate();
        if (\request()->search){
            $search = request()->search;
            $countries = Country::where('name', 'like', "%{$search}%")->orWhere('country_code', 'like', "%{$search}%")->latest()->paginate();
        }

        return view('countries.index', compact('countries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:countries',
            'country_code' => 'required|string|unique:countries'
        ]);

        Country::create($data);

        return back()->with('message', 'Country Added!');
    }

    public function update(Request $request, Country $country)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:countries,name,'.$country->id,
            'country_code' => 'required|string|unique:countries,country_code,'.$country->id
        ]);

        $country->update($data);

        return back()->with('message', 'Country Updated!');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return back()->with('message', 'Country deleted!');
    }
}
