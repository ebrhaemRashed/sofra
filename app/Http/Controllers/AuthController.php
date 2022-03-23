<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    //register page
    public function registerPage(){
        return view('dashboard.register');
    }

    //register
    public function register(Request $request){
        $request->validate(
        [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' =>'required|confirmed'
        ]
        );

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('loginPage');
    }

    //login page
    public function loginPage(){
        return view('dashboard.login');
    }


    //login
    public function login(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(auth('user')->attempt($request->only('email','password')))
        {
           return redirect()->route('home');
        }

        else{
            return "data is incorrect";
        }


    }

    public function logout(){
        auth('user')->logout();
        return redirect()->route('loginPage');
    }





}
