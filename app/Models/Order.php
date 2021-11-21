<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
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

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function scopeToday($query, $point)
    {
        $query->where('point_id', $point->id)
            ->whereDate('created_at', Carbon::today());
    }
}
