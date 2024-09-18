<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculyationItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function item(){

        return $this->hasOne(Items::class, 'id', 'item_id');
    }

    public function pf(){

        return $this->hasOne(Calculyation::class, 'id', 'item_id');
    }

    public function service(){

        return $this->hasOne(SelfService::class, 'id', 'item_id');
    }
}
