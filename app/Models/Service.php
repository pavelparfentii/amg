<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function parent(){
        return $this->hasOne(ServicesGroup::class, 'id', 'group_id');
    }

    public function promo(){
        return $this->hasMany(PromoServices::class, 'service_id', 'id');
    }
}
