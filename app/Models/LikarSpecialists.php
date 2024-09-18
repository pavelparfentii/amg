<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Specialists;

class LikarSpecialists extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function specialist(){
        return $this->hasOne(Specialists::class, 'id', 'specialist_id');
    }
}
