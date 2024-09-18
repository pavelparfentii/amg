<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitServices extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function service(){
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
