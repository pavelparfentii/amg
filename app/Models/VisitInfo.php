<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitInfo extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function visit(){

        return $this->hasOne(Visits::class, 'id', 'visit_id');

    }

}
