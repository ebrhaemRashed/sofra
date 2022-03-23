<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Resturant extends Authenticatable
{

    use HasApiTokens;
    protected $table = 'resturants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'confirm_password', 'phone', 'api_token', 'pin_code', 'delivery_price', 'image', 'min_charge', 'is_opened', 'neighborhood_id');

    public function neighborhood()
    {
        return $this->belongsTo('App\Models\Neighborhood');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function meals()
    {
        return $this->hasMany('App\Models\Meal');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification','notificationable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token','tokenable');
    }

}
