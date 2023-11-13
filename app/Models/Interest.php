<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = [
        'vis_id',
        'description'
    ];

    public function visitors(){
        return $this->belongsTo(Visitor::class, 'vis_id');
    }
}
