<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country as City;
use App\Models\State;

class CitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /*
  City list
   */
    public function index()
    {
        $cities = City::orderBy('name', 'asc')->get();
        $states = State::orderBy('name', 'asc')->get();
        return view('backend.pages.cities.index', compact('cities', 'states'));
    }


    /*
    Save cities
   */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'state_id' => 'nullable'
        ]);

        $city = new City();
        $city->name = $request->name;
        $city->state_id = $request->state_id;
        $city->save();

        session()->flash('success', 'City added successfully');
        return back();
    }


    /*
  Update cities
   */
    public function update(Request $request, $id)
    {
        $city = City::find($id);

        if ($city) {
            $this->validate($request, [
                'name' => 'required',
                'state_id' => 'nullable'
            ]);

            $city->name = $request->name;
            $city->state_id = $request->state_id;
            $city->save();

            session()->flash('success', 'City updated successfully');
            return redirect()->route('admin.cities.index');
        } else {
            return redirect()->route('admin.cities.index');
        }
    }

    /*
  Delete cities and related information
   */
    public function destroy($id)
    {
        $city = City::find($id);

        if ($city) {
            $city->delete();
            session()->flash('error', 'City deleted successfully');
            return redirect()->route('admin.cities.index');
        } else {
            return redirect()->route('admin.cities.index');
        }
    }
}
