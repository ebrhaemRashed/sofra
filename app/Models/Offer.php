<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('description', 'meal_id', 'resturant_id', 'start_date', 'end_date', 'image');

    public function meal()
    {
        return $this->belongsTo('App\Models\Meal');
    }

    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

}
