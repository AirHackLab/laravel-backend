<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial',
        'password',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
