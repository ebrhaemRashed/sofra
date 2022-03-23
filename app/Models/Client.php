<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;





class Client extends Model
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'confirm_password', 'phone', 'api_token', 'pin_code', 'neighborhood_id');

    public function neighborhood()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function contactUs()
    {
        return $this->hasMany('App\Models\ContactUs');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notificationable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenable');
    }
}
