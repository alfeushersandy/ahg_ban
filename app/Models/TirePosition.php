<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TirePosition extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function tireProfile()
    {
        return $this->belongsTo(TireProfile::class);
    }
}
