<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Meal;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainResturantController extends Controller
{
    //create offer
    public function offerCreate(Request $request){
        $rules = [
            'meal_id' => 'required|exists:meals,id',
            'resturant_id' => 'required|exists:resturants,id',
            'satrt_date' => 'required',
            'end_date'=>'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $errors = $validator->errors();
            return ApiResponse(2,$errors,$errors->first());
        }

        $offer = $request->user()->offers()->create($request->all());
        $imgName = $request->file('image')->getClientOriginalName();
        $request->file('image')->store('public/upload/'.$imgName);
        $offer->image = 'storage/upload/'.$imgName ;
        $offer->save();
        return ApiResponse(1,'success',$offer);
    }

    //edit offer
    public function offerEdit(Request $request){
        $rules = [
            'offer_id' => 'required|exists:offers,id',
            'meal_id' => 'required|exists:meals,id',
            'resturant_id' => 'required|exists:resturants,id',
            'satrt_date' => 'required',
            'end_date'=>'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $errors = $validator->errors();
            return ApiResponse(2,$errors,$errors->first());
        }

        $offer = $request->user()->offers()->find($request->offer_id);
        $updated = tap($offer)->update($request->all());

        if($request->has('image')){
        $imgName = $request->file('image')->getClientOriginalName();
        $request->file('image')->store('public/upload/'.$imgName);
        $offer->image = 'storage/upload/'.$imgName ;
        $offer->save();
         }

        return ApiResponse(1,'success',$offer);
    }

    //delete offer
    public function offerDelete(Request $request){
        $validator = Validator::make($request->all(),['offer_id' => 'required']);
        if($validator->fails()){
            $errors = $validator->errors();
            return ApiResponse(2,$errors,$errors->first());
        }

        $offer = $request->user()->offers->find($request->offer_id);
        $offer->delete();
        return ApiResponse(1,'success',['delete'=> 'ture']);
    }

    //create meal
    public function mealCreate(Request $request){
        $rules= [
            'name' => 'required',
            'price' => 'required',
            'image' => 'required|image'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $errors = $validator->errors();
            return ApiResponse(2,$errors,$errors->first());
        }

        $meal = $request->user()->meals()->create($request->all());
        $imgName = $request->file('image')->getClientOriginalName();   //im.jpg
        $request->file('image')->store('public/upload/'.$imgName);    //in storage folder
        $meal->image = 'storage/upload/'.$imgName;    //in public folder
        $meal->save();
    }

    //edit meal
    public function mealEdit(Request $request){

        $rules= [
            'name' => 'required',
            'price' => 'required',
            'meal_id' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $errors = $validator->errors();
            return ApiResponse(2,$errors,$errors->first());
        }

        $meal = $request->user()->meals()->find($request->meal_id);
        $meal->update($request->all());
        $imgName = $request->file('image')->getClientOriginalName();
        $request->file('image')->store('public/upload/'.$imgName);
        $meal->image = 'storage/upload/'.$imgName;
        $meal->save();
        return ApiResponse(1,'success',$meal);
    }

    //delete meal
    public function mealDelete(Request $request){
        $meal = $request->user()->meals->find($request->meal_id);
        $meal->delete();
        return ApiResponse(1,'success',[]);
    }


    //accept order
    public function orderAccept(Request $request){
        $order = $request->user()->orders()->find($request->order_id);
        if(!$order){
            return ApiResponse(2,'there in no order',[]);
        }

        if($order->state != 'pending'){
            return ApiResponse(2,'no order',[]);
        }

        $updated = tap($order)->update(['state'=>'accepted']);

        $client = Client::where('id',$request->client_id);
        $notification = $client->notifications()->create([
            'title' => 'تم قبول طلبك',
            'content' => 'تم قبول طلب من '.$request->user()->name,
            'order_id' => $order->id
        ]);

        $title = $notification->title;
        $body = $notification->content;
        $tokens = $client->tokens()->pluck('token')->toArray();
        $data = ['order_id' => $order->id];

        $send = notifyByFirebase($title,$body,$tokens,$data);
        info('firebase results:'.$send);
        return ApiResponse(1,'success',['order accepted' => $updated]);
    }

    //reject order
    public function orderReject(Request $request){
        $order = $request->user()->orders()->find($request->order_id);
        if(!$order){
            return ApiResponse(2,'there is no order',[]);
        }

        if($order->state != 'accepted'){
            return ApiResponse(2,'no order',[]);
        }

        $updated= $order->update(['state'=> 'rejected']);

        $client = Client::find($request->client_id);
        $notification = $client->notifications()->create([
            'title' => 'تم رفض طلبك',
            'content' => 'تم رفض طلبك من '.$request->user()->name,
            'order_id' => $order->id,
        ]);

        $title = $notification->title;
        $body = $notification->content;
        $tokens = $client->tokens()->pluck('token')->toArray();
        $data = ['order_id' => $order->id];

        $send = notifyByFirebase($title,$body,$tokens,$data);
        info('firebase results :'.$send);
        return ApiResponse(1,'success',$updated);
    }

    //orders
    public function orders(Request $request){
        $orders = $request->user()->orders()->where(function($order)use($request){
            if($request->state == 'current'){
                $order->whereIn('state',['pending','accepted','confirmed']);
            }
            if($request->state == 'previous'){
                $order->whereIn('state',['rejected','delivered']);
            }
        })->get();
        return ApiResponse(1,'success',$orders);
    }

    //notifications
    public function notifications(Request $request){
        $notifications = $request->user()->notifications()->get();
        return ApiResponse(1,'success',$notifications);
    }


    //reviews about resturant from client
    public function reviews(Request $request){
        $reviews = $request->user()->reviews()->all();
        return ApiResponse(1,'success',$reviews);
    }







}
