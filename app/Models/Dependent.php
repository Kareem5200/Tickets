<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    use HasFactory;


    protected $fillable=[
        'name',
        'ssn',
        'personal_image',
        'gender',
        'birth_certificate',
        'user_id',
        'birth_date',
        'status'
    ];

    public function parent()
    {
      return $this->belongsTo(User::class,'user_id');
    }
    public function tickets()
    {
      return $this->hasMany(Ticket::class,'dependent_id');
    }



}
