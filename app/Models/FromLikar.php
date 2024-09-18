<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FromLikar extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function user(){

        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
