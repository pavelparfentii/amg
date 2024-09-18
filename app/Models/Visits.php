<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
    use HasFactory;

    public function creator(){
        return $this->hasOne(User::class, 'id', 'creater_id');
    }

    public function cabinets(){
        return $this->hasOne(Cabinets::class, 'id', 'cabinet');
    }

    public function notes(){
        return $this->hasOne(VisitNotes::class, 'visit_id', 'id');
    }

    public function visitor(){
        return $this->hasOne(Visitors::class, 'id', 'visitor_id');
    }

    public function likars(){
        return $this->hasOne(User::class, 'id', 'likar');
    }

    public function from_likars(){
        return $this->hasOne(FromLikar::class, 'id', 'from_likar');
    }

    public function services(){
        return $this->hasMany(VisitServices::class, 'visit_id', 'id');
    }

    public function cost(){
        return $this->hasMany(VisitServices::class, 'visit_id', 'id')->sum('summa');
    }

    public function pays(){
        return $this->hasMany(VisitPays::class, 'visit_id', 'id')->distinct('pay_type');
    }

    public function cash_pay(){
        return $this->hasMany(VisitPays::class, 'visit_id', 'id')->where('pay_type', 'cash')->sum('summa');
    }

    public function card_pay(){
        return $this->hasMany(VisitPays::class, 'visit_id', 'id')->where('pay_type', 'card')->sum('summa');
    }

    public function invoice_pay(){
        return $this->hasMany(VisitPays::class, 'visit_id', 'id')->where('pay_type', 'invoice')->sum('summa');
    }

    public function balance_pay(){
        return $this->hasMany(VisitPays::class, 'visit_id', 'id')->where('pay_type', 'balance')->sum('summa');
    }

    public function info(){
        return $this->hasOne(VisitInfo::class, 'visit_id', 'id');
    }


}
