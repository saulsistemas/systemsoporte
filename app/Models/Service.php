<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    #relacion 1 a muchos (TIENE MUCHOS CATEGORIAS)
    public function categories(){
        return $this->hasMany(Category::class);
    }
}
