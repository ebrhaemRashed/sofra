<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $settings = Setting::all();
        return view('dashboard.settings.index',compact('settings'));
    }



    public function edit($id)
    {
        $setting = setting::find($id);
        return view('dashboard.settings.edit',compact('setting'));
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
            'email' =>'unique:settings,email,'.$id,
            'phone'  => 'unique:settings,phone,'.$id
           ]
        );

        $setting = setting::find($id);
        $setting->update($request->all());
        return redirect(route('setting.index'));
    }
}
