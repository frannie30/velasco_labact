<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{

    // Eloquent relationship: a province has many recipes
    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'province_id'); 
    }
}
