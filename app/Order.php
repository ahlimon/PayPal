<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['user_id','tickets','amount','name','phone','email','paypal','status'];
}
