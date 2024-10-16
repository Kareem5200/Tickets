<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    use HasFactory;
    protected $table='stadiums';
    protected $fillable=[
        'name',
        'location',
        'capacity'
    ];

    public function departments(){

        return $this->hasMany(Department::class,'stadium_id','id');
    }
    public function matches(){

        return $this->hasMany(AllMatches::class,'stadium_id');
    }
    public function prices()
    {
      return $this->hasMany(tripPrice::class,'stadium_id');
    }


}
