<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialists extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function forms(){
        return $this->hasMany(PrintForms::class, 'type', 'alias');
    }

}
