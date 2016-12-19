<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    protected $table = 'order_items';
    protected $fillable = ['id','order_id','product_id','quantity'];
    //public $timestamps = false;

}

