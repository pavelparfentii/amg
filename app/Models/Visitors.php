<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function promo(){
        return $this->hasMany(PromoVisitor::class, 'visitor_id', 'id');
    }

    public function histories(){
        return $this->hasMany(Visits::class, 'visitor_id', 'id')->whereIn('status', ['payed', 'partpayed'])->orderBy('date', 'desc');
    }

    public function visits(){
        return $this->hasMany(Visits::class, 'visitor_id', 'id');
    }
    public function balances(){

        $bal = $this->hasMany(VisitorBalances::class, 'visitor_id', 'id')->sum('summa');

        return $bal;
    }
}
