<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TireProfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tirePositions()
    {
        return $this->hasMany(TirePosition::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
