<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code',
        'name',
        'position',
        'email',
        'password',
        'role_id',
        'last_name',
        'office_id',
        'area_id',
        'status',
        'phone',
        'company_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    #relacion 1 a muchos (TIENE MUCHOS TICKETS)
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
    #relacion 1 a muchos (TIENE MUCHOS LEVELS)
    public function levels(){
        return $this->hasMany(Level::class);
    }
    #relacion 1 a muchos inversa (PERTENECE A UNA OFICINA)
    public function office(){
        return $this->belongsTo(Office::class);
    }
     #relacion 1 a muchos inversa (PERTENECE A UNA AREA)
     public function area(){
        return $this->belongsTo(Area::class);
    }
    public function getRole(){
        return $role = Role::find($this->role_id);
    }
    
}
