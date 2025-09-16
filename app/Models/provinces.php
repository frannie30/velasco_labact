<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    // Eloquent relationship: a province has many recipes
    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'province_id');
    }
}
