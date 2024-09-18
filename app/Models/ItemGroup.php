<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function count_items(){
        return $this->hasMany(Items::class, 'group_id', 'id')->count();
    }

    public function items(){
        return $this->hasMany(Items::class, 'group_id', 'id');
    }

}
