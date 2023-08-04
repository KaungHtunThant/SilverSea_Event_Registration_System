<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'conf_id',
        'name',
        'email',
        'phone',
        'company',
        'sex',
        'dob',
        'card'
    ];
}
