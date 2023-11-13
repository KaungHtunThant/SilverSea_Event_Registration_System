<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'conf_id',
        'name',
        'email',
        'phone',
        'company',
        'card',
    ];

    public function interests(): HasMany
    {
        return $this->hasMany(Interest::class, 'id');
    }
}
