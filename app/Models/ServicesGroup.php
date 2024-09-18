<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesGroup extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function parent(){
        return $this->hasOne(ServicesGroup::class, 'id', 'parent_id');
    }

    public function count_service(){
        return $this->hasMany(Service::class, 'group_id', 'id')->count();
    }

    public function childrens(){
        return $this->hasMany(ServicesGroup::class, 'parent_id', 'id');
    }
}
