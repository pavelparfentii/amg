<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function parent(){

        return $this->hasOne(ItemGroup::class, 'id', 'group_id');

    }

    public function price(){

    }

    public function orders(){

        return $this->hasMany(OrderItem::class, 'item_id', 'id');
    }
}
