<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    #relacion 1 a muchos inversa (PERTENECE A UNA SUBCATEGORIA)
    public function service(){
        return $this->belongsTo(Service::class);
    }
    #relacion 1 a muchos (TIENE MUCHOS SUBCATEGORIAS)
    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }
}
