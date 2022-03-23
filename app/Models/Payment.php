<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $table = 'payments';
    public $timestamps = true;
    protected $fillable = array('resturant_id', 'amount');

    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

    public function orders(){

        return $this->hasMany('App\Models\Order');
    }

}
