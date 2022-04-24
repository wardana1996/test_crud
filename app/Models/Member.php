<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'member';

    public function phoneToPhone() {
        return $this->hasOne('App\Models\Phone','member_id','id');
    }

    public function onePhoneToManyPhone() {
        return $this->hasMany('App\Models\PhoneMany','member_id','id');
    }

    public function manyBrandToManyBrand() {
        return $this->belongsToMany('App\Models\Brand');
    }
}
