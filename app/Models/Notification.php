<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'order_id', 'notificable_id', 'notificable_type');

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function notificationable()
    {
        return $this->morphTo();
    }

}
