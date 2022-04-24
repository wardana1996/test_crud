<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'phone';

    public function memberToMember() {
        return $this->belongsTo('App\Models\Member','member_id','id');
    }
}
