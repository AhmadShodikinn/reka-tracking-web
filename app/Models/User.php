<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'users';

    protected $fillable = [
        'nip', 'role_id', 'name', 'email', 'password', 'phone_number',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function tracks()
    {
        return $this->hasMany(Track::class, 'driver_id');
    }

    public function hasAnyRelationship() {
    if ($this->tracks()->exists()) { 
        return true;
    }
    
    return false; 
}
}
