<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offers = Offer::where(function($offer) use($request){
            if($request->meal){
                $offer->where('meal_id',$request->meal);
            }
            if($request->resturant){
                $offer->where('resturant_id',$request->resturant);
            }
        })->get();
        return view('dashboard.offers.index',compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('dashboard.offers.create');
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
            'offer' => 'required',
            'meal' => 'required|exists:meals,id',
            'resturant' => 'required|exists:resturants,id'
        ]);

        $offer = new Offer;
        $offer->name = $request->offer;
        $offer->meal_id= $request->meal;
        $offer->resturant_id= $request->resturant;
        $offer->save();
        return redirect(route('offer.index'));
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
        $offer = Offer::find($id);
        return view('dashboard.offers.edit',compact('offer'));
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
            [
            'offer' =>'required',
            'meal'  => 'required|exists:meals,id',
            'resturant' =>'required|exists:resturants,id'
            ]
        );

        $offer = Offer::find($id);
        $offer->name = $request->offer;
        $offer->meal_id = $request->meal;
        $offer->resturant_id = $request->resturant;
        $offer->save();
        return redirect(route('offer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = Offer::find($id);
        $offer->delete();
        return redirect(route('offer.index'));
    }
}


