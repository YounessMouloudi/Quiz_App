<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Player extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
    ];

    protected $casts = [
        'email' => 'string',
        'phone' => 'string',
        'image' => 'string',
    ];

    public function score()
    {
        return $this->hasOne(Score::class);
    }
}
