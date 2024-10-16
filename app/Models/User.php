<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'personal_image',
        'birth_date',
        'gender',
        'status',
        'ssn_image',
        'ssn',
        'passport_id',
        'phone_1',
        'phone_2',
        'address',
        'team_id',
        'panned_date',
        'panned_until',
        'blob_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


  public function team()
  {
    return $this->belongsTo(Team::class);
  }
  public function dependents()
  {
    return $this->hasMany(Dependent::class,'user_id');
  }
  public function tickets()
  {
    return $this->hasMany(Ticket::class,'user_id');
  }

}
