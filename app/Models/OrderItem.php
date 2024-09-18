<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function item(){

        return $this->hasOne(Items::class, 'id', 'item_id');
    }

    public function order(){

        return $this->hasOne(Orders::class, 'id', 'order_id');
    }

}
