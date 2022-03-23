<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $contacts = ContactUs::where(function($contact) use($request){
            if($request->client_id){
                $contact->where('client_id',$request->client_id);
            }
        })->get();
        return view('dashboard.contacts.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        $contact = ContactUs::find($id);
        $contact->delete();
        return redirect(route('contact.index'));
    }
}
