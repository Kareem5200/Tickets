<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    use HasFactory;

    protected $fillable=[
        'name',
        'ssn',
        'email',
        'password',
        'gender',
        'type',
        'personal_image',
        'status'

    ];

    public function trips(){

        return $this->hasMany(DriverTrip::class,'driver_id');

    }
}
