<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoVisitor extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function visitor(){
        return $this->hasOne(Visitors::class, 'id', 'visitor_id');
    }

    public function promo(){
        return $this->hasOne(Promo::class, 'id', 'promo_id');
    }
}
