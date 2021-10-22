<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'login',
        'password',
        'email',
        'name',
    ];

    protected $guarded = [
        'closed_at'
    ];
}
