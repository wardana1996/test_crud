<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand_Member extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'member_brand';
}
