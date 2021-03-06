<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $fillable = ['name','project_id','user_id'];
    #relacion 1 a muchos inversa (PERTENECE A UNA PROJECTO)
    public function project(){
        return $this->belongsTo(Project::class);
    }
    #relacion 1 a muchos inversa (PERTENECE A UNA USUARIO)
    public function user(){
        return $this->belongsTo(User::class);
    }

    #relacion 1 a muchos (TIENE MUCHOS TICKET)
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
