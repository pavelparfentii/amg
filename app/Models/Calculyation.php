<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculyation extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function service(){

        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    public function items(){

        return $this->hasMany(CalculyationItem::class, 'calculyation_id', 'id')->where('item_type', 'item');
    }

    public function pfs(){

        return $this->hasMany(CalculyationItem::class, 'calculyation_id', 'id')->where('item_type', 'pf');
    }

    public function services(){

        return $this->hasMany(CalculyationItem::class, 'calculyation_id', 'id')->where('item_type', 'service');
    }

    public function all_items(){
        return $this->hasMany(CalculyationItem::class, 'calculyation_id', 'id');
    }

    public function summa(){

        $summa = 0;
        foreach($this->all_items as $item){
            $summa += round($item->count * $item->price, 2);
        }

        return $summa;
    }
}
