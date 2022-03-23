<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('client_id', 'resturant_id', 'delivery_price', 'total_price', 'address', 'status', 'commission');

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

    public function meals(){

        return $this->belongsToMany('App\Models\Meal');
    }

    public function payment(){

        return $this->belongsTo('App\Models\Payment');
    }
}
