<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public function tickets(){
        #relacion 1 a muchos (TIENE MUCHOS TICKETS)
        return $this->hasMany(Ticket::class);
    }
}
