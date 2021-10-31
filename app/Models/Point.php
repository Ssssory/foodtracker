<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'login',
        'password',
        'restaurant_id',
        'name',
    ];

    protected $guarded = [
        'closed_at'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function notifications()
    {
        return $this->hasMany(NotificationText::class);
    }
}
