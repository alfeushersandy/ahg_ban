<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tire extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function tireUsages()
    {
        return $this->hasMany(TireUsage::class);
    }
}
