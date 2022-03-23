<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{

    protected $table = 'meals';
    public $timestamps = true;
    protected $fillable = array('resturant_id', 'name', 'price', 'description', 'prepation_time', 'image');

    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function oreders(){

        return $this->belongsToMany('App\Models\Order');
    }

}
