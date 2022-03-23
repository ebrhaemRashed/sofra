<?php

namespace App\Http\Controllers;

use App\Models\Resturant;
use Illuminate\Http\Request;

class ResturantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resturants = Resturant::where(function($resturant) use($request){
            if($request->neighborhood_id){
                $resturant->where('neighborhood_id',$request->neighborhood_id);
            }
        })->get();
        return view('dashboard.resturants.index',compact('resturants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resturant = Resturant::find($id);
        return view('dashboard.resturants.show',compact('resturant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        $resturant = Resturant::find($id);
        $resturant->delete();
        return redirect(route('Resturant.index'));
    }
}
