<?php

namespace App\Http\Controllers;

use App\Models\Neighborhood;
use Illuminate\Http\Request;

class NeighborhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $neighborhoods = Neighborhood::all();
        return view('dashboard.neighborhoods.index',compact('neighborhoods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('dashboard.neighborhoods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'neighborhood' => 'required',
            'city' => 'required|exists:cities,id'
        ]);

        $neighborhood = new Neighborhood;
        $neighborhood->name = $request->neighborhood;
        $neighborhood->city_id = $request->city;
        $neighborhood->save();
        return redirect(route('neighborhood.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $neighborhood = Neighborhood::find($id);
        return view('dashboard.neighborhoods.edit',compact('neighborhood'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            ['neighborhood' =>'required',
             'city'  => 'required|exists:cities,id'
            ]
        );

        $neighborhood = Neighborhood::find($id);
        $neighborhood->name = $request->neighborhood;
        $neighborhood->city_id = $request->city;
        $neighborhood->save();
        return redirect(route('neighborhood.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $neighborhood = Neighborhood::find($id);
        $neighborhood->delete();
        return redirect(route('neighborhood.index'));
    }
}


