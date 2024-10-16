<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'price',
        'capacity',
        'stadium_id'
    ];

    public function stadium(){

        return $this->belongsTo(Stadium::class,'stadium_id');
    }
    public function tickets()
    {
      return $this->hasMany(Ticket::class,'department_id');
    }





}
