<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'brand';

    public function manyMemberToManyMember() {
        return $this->belongsToMany('App\Models\Member','id','member_id');
    }
}
