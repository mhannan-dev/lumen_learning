<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::orderBy('id', 'DESC')->get();
        return response()->json($countries, 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255|unique:countries,name'
        ]);
        $country = Country::create([
            'name' => $request->name,
        ]);
        return response()->json($country, 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        $country = Country::findOrFail($country);
        if (is_null($country)) {
            return response()->json('Record not found', 200);
        }
        return response()->json($country, 200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return response()->json($country, 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $country = $country->update($request->all());
        if (is_null($country)) {
            return response()->json('Record not found', 200);
        }
        return response()->json($country, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        // Working  code to delete Category with image
        if ($country) {
            $country->delete();
            return response()->json('Deleted done', 200);
        } else {
            return response()->json('Country not found.', 404);
        }
    }
}
