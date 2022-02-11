<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    #relacion 1 a muchos inversa (PERTENECE A UNA SUBCATEGORIA)
    public function category(){
        return $this->belongsTo(Category::class);
    }
   #relacion 1 a muchos (TIENE MUCHOS TICKETS)
   public function tickets(){
    return $this->hasMany(Ticket::class);
}
}
