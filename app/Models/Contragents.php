<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contragents extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function groups(){

        return $this->hasOne(ContragentGroups::class, 'id', 'group');
    }
}
