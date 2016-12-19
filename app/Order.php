<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['id','customer_id','total_price','status'];
    //public $timestamps = false;

}
