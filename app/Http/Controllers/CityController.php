<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('city.infoCity');
    }


    public function getMyCities()
    {
        $user = auth()->user();
        $cities = City::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->get();

        return view('city.myCities', [
            'cities' => $cities
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    
    public function store(Request $request)
{
    $userCitiesCount = City::where('user_id', auth()->id())->count();
    if ($userCitiesCount >= 5) {
        return redirect()->back()->with('error', 'Solo puedes tener un máximo de 5 ciudades.');
    }

    $data = $request->validate([
        'name' => 'required|string',
        'country' => 'required|string',
        'population' => 'nullable|integer',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    $data['user_id'] = auth()->id();

    $duplicateCity = City::where('user_id', auth()->id())
        ->where('name', $data['name'])
        ->where('country', $data['country'])
        ->exists();

    if ($duplicateCity) {
        return redirect()->back()->with('error', 'Ya tienes una ciudad registrada con ese nombre y país.');
    }

    $city = City::create($data);

    return redirect()->route('city.infoCity')->with('status', __('Saved city!'));
}


    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        return view('city.cityShow', [
            'city' => $city
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        if ($city->user_id == auth()->id()) {
            $city->delete();
            return redirect()->route('city.myCities')->with('status', 'Ciudad eliminada exitosamente.');
        } else {
            return redirect()->route('city.myCities')->with('error', 'No tienes permiso para eliminar esta ciudad.');
        }
    }

}

