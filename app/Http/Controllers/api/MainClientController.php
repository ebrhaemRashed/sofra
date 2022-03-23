<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Resturant;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MainClientController extends Controller
{

    //create order
    public function orderCreate(Request $request){

        $rules = [
            'resturant_id' => 'required|exists:resturants,id',
            'meals.*.meal_id' => 'required|exists:meals,id',
            'meals.*.quantity' => 'required',
            'address'=>'required',
            'payment_method_id' =>'required|exists:payments,id'
        ];

        // dd($request->all());

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            $data = $validator->errors();
            return ApiResponse(2,$data->first(),$data);
        }


        $resturant = Resturant::find($request->resturant_id);
        if(!$resturant->is_opened == '1'){
            return ApiResponse(2,'faild',['resturant'=>'closed']);
        }



        $order = $request->user()->orders()->create([
            'resturant_id' => $request->resturant_id ,
            'status' => 'pending' , //default
            'address' => $request->address ,
            'payment_id' => $request->payment_method_id,
        ]);


        $cost = 0;
        $delivery_cost = $resturant->delivery_price;

        foreach($request->meals as $me){
            $meal = Meal::find($me['meal_id']);
            $readyMeal = [$me['meal_id'] => [
                'quantity' => $me['quantity'],
                'price_in_order' => $meal->price,
                'notes' => (isset($me['notes'])) ? $me['notes'] : ' '

            ]];
            $order->meals()->attach($readyMeal);
            $cost += $meal->price * $me['quantity'];
        }

        if($cost >= $resturant->min_charge){
            $total = $cost + $delivery_cost;
            $commession = Setting::find(1)->commession * $total/100;
            $net = $total - $commession;

            $updateOrder = tap($order)->update([
                'total_price' => $total,
                'commession' => $commession,
                'net' => $net
            ]);


        $notification = $resturant->notifications()->create([
            'title' => 'لديك طلب جديد ',
            'content' => 'لديك طلب من العميل '.$request->user()->name ,
            'order_id' => $order->id
        ]);

        $tokens = $resturant->tokens()->pluck('token')->toArray();
        $title = $notification->title;
        $body = $notification->content;
        $data = ['order_id' => $order->id];

        $send = notifyByFirebase($title,$body,$tokens,$data);
        info('firebase results :'.$send);


        return ApiResponse(1,'success',$updateOrder);
    }else {
        $order->meals->delete();
        $order->delete();
        return ApiResponse(2,'الطلب اقل من الحد الادنى ',[]);
    }


    }

    //client orders
    public function clientOrders(Request $request){
        $order =$request->user()->orders()->where(function($order) use($request){

            if($request->state == 'current'){
                $order->whereIn('state',['pending','accepted','confirmed']);
            }

            if($request->state == 'previous'){
                $order->whereIn('state',['rejected','delivered','declined']);
            }

            if(!$request->state){
                $order->all();
            }
        })->get();

        return ApiResponse(1,'success',$order);
    }



    //declined order
    public function declineOrder(Request $request){
        $order = $request->user()->orders()->find($request->order_id);
        if(!$order){
            return ApiResponse(2,'there is no order',[]);
        }

        if($order->state !='confirmed'){
            return ApiResponse(2,'no order',[]);
        }

        $order->update(['state'=>'declined']);
        $resturant = Resturant::find($order->resturant_id);
        $notification = $resturant->notifications()->create([
            'title' => 'تم رفض الاوردر ' ,
            'content' => 'تم رفض الاوردر من '.$request->user()->name,
            'order_id' => $order->id
        ]);

        $title = $notification->title;
        $body = $notification->content;
        $tokens = $notification->tokens()->pluck('token')->toArray();
        $data = ['order_id' => $order->id];

        $send = notifyByFirebase($title,$body,$tokens,$data);
        info('firebase results : '.$send);
        return ApiResponse(1,'تم رفض الطلب من العميل',[]);
    }


    //delivered order
    public function deliveredOrder(Request $request){
        $order = $request->user()->orders()->find($request->order_id);
        if(!$order){
            return ApiResponse(2,'there is no order',[]);
        }

        if($order->state != 'confirmed'){
            return ApiResponse(2,'no order',[]);
        }

        $order->update(['state' => 'delivered']);
        $resturant = Resturant::find($order->resturant_id);
        $notification =$resturant->notifications()->create([
            'title' => 'تم توصيل الطلب بنجاح ' ,
            'content' => 'تم توصيل الطلب بنجاح من  ' . $request->user()->name,
            'order_id' => $order->id,
        ]);

        $title = $notification->title;
        $body= $notification->body;
        $tokens = $notification->tokens()->pluck('token')->toArray();
        $data = ['order_id' => $order->id];

        $send = $notifyByFireBase($title,$body,$tokens,$data);
        info('firebase results' .$send);
        return ApiResponse(1,'تم توصيل الطلب للعميل وقبوله ',[]);
    }


    //notifications
    public function notifications(Request $request){
        $notifications = $request->user()->notifications()->get();
        return ApiResponse(1,'success',$notifications);
    }

    //review
    public function reviewCreate(Request $request){
        $validator = Validator::make($request->all(),['comment'=>'required','rate'=>'required']);
        if($validator->fails()){
            $errors = $validator->errors();
            return ApiResponse(2,$errors,$errors->first());
        }

        $review = $request->user()->reviews->create($request->all());
        return ApiResponse(1,'success',$review);
    }
}
