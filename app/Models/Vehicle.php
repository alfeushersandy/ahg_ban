<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function tireProfile()
    {
        return $this->belongsTo(TireProfile::class, 'profile_ban_id');
    }

    public function tireUsages()
    {
        return $this->hasMany(TireUsage::class);
    }
}
