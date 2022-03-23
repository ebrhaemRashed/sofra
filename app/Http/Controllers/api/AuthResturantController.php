<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\ClientMail;
use App\Models\Client;
use App\Models\Resturant;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AuthResturantController extends Controller
{
    //register
    public function register(Request $request){

        $rules = array(
            'name' => 'required',
            'phone' => 'required|unique:returants',
            'email' => 'required|unique:returants',
            'password' => 'required|confirmed',
            'neighborhood_id' =>'required'

        );

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            $data = $validator->errors();
            return ApiResponse(2,$data->first(),$data);
        }

        $resturant = Resturant::Create($request->all());
        $resturant->password = bcrypt($request->password);
        $resturant->confirm_password = bcrypt($request->password_confirmation);
        $api_token =$resturant->api_token = Str::random(50);
        $resturant->save();

        return ApiResponse(1,'success',['api_token'=>$api_token,'resturant'=>$resturant]);


    }

    //login
    public function login(Request $request){
        $rules = array(
            'phone'=>'required',
            'password'=>'required'
        );

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $data = $validator->errors();
            return ApiResponse(2,$data->first(),$data);
        }

        $resturant = Resturant::where('phone',$request->phone)->first();
        if($resturant){
            if(Hash::check($request->password,$resturant->password)){
                $resturant->api_token = str::random(50);
                $resturant->save();
                return ApiResponse(1,'success',['api_token'=>$resturant->api_token,'resturant'=>$resturant]);
            }else{
                return ApiResponse(2,'faild',['password'=> 'incorrect password']);
            }
        }else{
            return ApiResponse(2,'faild',['phone'=> 'incorrect phone number']);
        }
    }

    //forget password
    public function forgetPassword(Request $request){

        $validator = Validator::make($request->all(),['phone'=>'required']);
        if($validator->fails()){
            $errors =$validator->errors();
            return ApiResponse(2,$errors->first(),$errors);
        }


        $resturant = Resturant::where('phone',$request->phone)->first();
        if($resturant){
            $code = rand(1111,9999);
            $name = $resturant->name;
            $resturant->pin_code = $code;
            $resturant->save();
            Mail::to($resturant->email)->send(new resturantMail($code,$name));
            return ApiResponse(1,'success',['code' =>$resturant->pin_code]);
        }else{
            return ApiResponse(2,'faild',['data'=>'phone is not correct']);
        }

    }

    //reset password
    public function resetPassword(Request $request){

        $rules = [
            'phone' => 'required',
            'pin_code' => 'required',
            'password' => 'required|confirmed'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $errors = $validator->errors();
            return ApiResponse(2,$errors->first(),$errors);
        }

        $resturant = Resturant::where('phone',$request->phone)->where('pin_code',$request->pin_code)->first();
        if($resturant){
            $resturant->password = bcrypt($request->password);
            $resturant->save();
            $resturant->pin_code->delete();
            return ApiResponse(1,'success',$resturant);
        }else{
            return ApiResponse(2,'falid',['data'=> 'check your phone or code']);
        }

    }


    //register token => for notification
    public function registerToken(Request $request){

        $rules = [
            'token' => 'required',
            'tokenable_type' => 'required',   //client
            'tokenable_id' => 'required'      //1
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $errors = $validator->errors();
            return ApiResponse(2,$errors->first(),$errors);
        }

        $token = $request->user->tokens()->create($request->all());
        return ApiResponse(1,'success',['token'=>$token]);
    }


    //remove token =>for notifications
    public function removeToken(Request $request){
        $validator = Validator::make($request->all(),['token'=>'required']);
        if($validator->fails()){
            $errors = $validator->errors();
            return ApiResponse(2,$errors->first(),$errors);
        }

        Token::where('token',$request->token)->delete();
        return ApiResponse(1,'success',['delete'=> ' deleted']);
    }

    //edit profile
    public function editProfile(Request $request){

        $rules = [
            'phone'=> 'required',
            'name'=>'required',
            'email' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $errors= $validator->errors();
            return ApiResponse(2,$errors->first(),$errors);
        }


        $user= $request->user();;
        $user->update($request->all());

        if($request->has('password')){
            $user->password = bcrypt($request->password);
            $user->save();

        }
        return ApiResponse(1,'success',$user);
    }





    //logout
    // public function logout(){
    //     auth('client')->logout();
    //     return ApiResponse(1,'success',['user'=>'logged out successfully']);
    // }


}
