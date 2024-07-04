<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TireUsage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tire()
    {
        return $this->belongsTo(Tire::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
    public function position()
    {
        return $this->belongsTo(TirePosition::class);
    }
}
