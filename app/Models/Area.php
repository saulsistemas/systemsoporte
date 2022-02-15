<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    #relacion 1 a muchos (TIENE MUCHOS AREAS)
    public function areas(){
        return $this->hasMany(Area::class);
    }
}
