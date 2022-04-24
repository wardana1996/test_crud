<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneMany extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'phone_to_many';

    public function oneMemberToManyMember() {
        return $this->belongsTo('App\Models\Member','member_id','id');
    }
}
