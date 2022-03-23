<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\ContactUs;
use App\Models\Meal;
use App\Models\Neighborhood;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Resturant;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Http\Request;

class MainController extends Controller
{

    //cities
    public function cities(Request $request){
        if($request->id)
        {
            $city = City::find($request->id);
            return ApiResponse(1,'success',$city);
        }
        else
        {
            $cities = City::all();
            return ApiResponse(1,'success',$cities);
        }
    }

    //clients
    public function clients(Request $request){
        if($request->id)
        {
            $client = Client::find($request->id);
            return ApiResponse(1,'success',$client);
        }
        else
        {
            $clients = Client::all();
            return ApiResponse(1,'success',$clients);
        }

    }

    //neighborhoods
    public function neighborhoods(Request $request){
        if($request->city_id)
        {
            $neighborhood = Neighborhood::where('city_id',$request->city_id);
            return ApiResponse(1,'success',$neighborhood);
        }
        else
        {
            $neighborhoods = Neighborhood::all();
            return ApiResponse(1,'success',$neighborhoods);
        }

    }

    //resturants
    public function resturants(Request $request){
        if($request->id)
        {
            $resturant = Resturant::find($request->id);
            return ApiResponse(1,'success',$resturant);
        }
        else
        {
            $resturants = Resturant::all();
            return ApiResponse(1,'success',$resturants);
        }

    }

    //reviews
    public function reviews(Request $request){

        if($request->client_id || $request->resturant_id)
        {
            $reviews = Review::where(function($query)use ($request)
            {
                if($request->client_id)
                {
                    Review::where('client_id',$request->client_id);
                }

                if($request->returant_id)
                {
                    Review::where('resturant_id',$request->resturant_id);
                }
            });

        return ApiResponse(1,'success',$reviews);

        }


        else
        {
            $review = Review::all();
            return ApiResponse(1,'success',$review);
        }

    }


    //meals
    public function meals(Request $request){
        if($request->resturant_id)
        {
            $meal = Meal::where('resturant_id',$request->resturant_id);
            return ApiResponse(1,'success',$meal);
        }

        else
        {
            $meal = Meal::all();
            return ApiResponse(1,'success',$meal);
        }

    }


    //categories
    public function categories(Request $request){
        if($request->resturant_id)
        {
            $resturant = Resturant::find($request->resturant_id);
            $categories = $resturant->categories;
            return ApiResponse(1,'success',$categories);
        }

        else
        {
            $categories = Category::all();
            return ApiResponse(1,'success',$categories);
        }

    }

    //orders
    public function orders(Request $request){
        if($request->resturant_id || $request->client_id)
        {
            $orders = Order::where(function($query) use($request)
            {
                if($request->client_id)
                {
                    $query->where('client_id',$request->client_id);
                }

                if($request->resturant_id)
                {
                    $query->where('resturant_id',$request->resturant_id);
                }
            })->get();
            return ApiResponse(1,'success',$orders);
        }
        else
        {
            $orders = Order::all();
            return ApiResponse(1,'success',$orders);
        }

    }

    //offers
    public function offers(Request $request){
        if($request->meal_id || $request->resturant_id)
        {
            $offers = Offer::where(function($query) use($request){
                if($request->meal_id)
                {
                    $query->where('meal_id',$request->meal_id);
                }
                if($request->resturant_id)
                {
                    $query->where('resturant_id',$request->resturant_id);
                }
            })->get();
        return ApiResponse(1,'success',$offers);
        }

        else
        {
            $offers = Offer::all();
            return ApiResponse(1,'success',$offers);
        }
    }


    //settings
    public function settings(){
        $settings = Setting::all();
        return ApiResponse(1,'success',$settings);
    }

    //payments
    public function payments(Request $request){
        if($request->resturant_id)
        {
            $payments = Payment::where('resturant_id',$request->resturant_id);
            return ApiResponse(1,'success',$payments);
        }
        else
        {
            $payments =Payment::all();
            return ApiResponse(1,'success',$payments);
        }
    }

    public function contactUs(Request $request){
        if($request->client_id){
            $contacts = ContactUs::where('client_id',$request->client_id);
            return ApiResponse(1,'success',$contacts);
        }
        else
        {
            $contacts = ContactUs::all();
            return ApiResponse(1,'success',$contacts);
        }
    }


    //notifications and tokens not made because of morph relationships
}
