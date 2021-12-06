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
        'address'
    ];

    protected $guarded = [
        'closed_at'
    ];

    protected $hidden = [
        'closed_at',
        'token_start',
        'token',
        'closed_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
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
