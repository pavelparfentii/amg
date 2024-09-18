<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function items(){

        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function provider(){

        return $this->hasOne(Contragents::class, 'id', 'contragent_id');
    }

    public function receiver(){

        return $this->hasOne(Contragents::class, 'id', 'receiver_id');
    }
}
