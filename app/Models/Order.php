<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'order_id',
        'client_id',
        'point_id',
        'status',
    ];


    public function setStatusAttribute($value)
    {
        if (empty($this->attributes['status'])) {
            // TODO: status const
            $this->attributes['status'] = 'new';
        }else{
            $this->attributes['status'] = $value;
        }
        
    }

    public function point()
    {
        return $this->belongsTo(Point::class);
    }
}
