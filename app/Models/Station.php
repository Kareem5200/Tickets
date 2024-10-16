<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;
    protected $fillable=[
        'location',
        'status'
    ];


    public function trip()
    {
      return $this->belongsTo(DriverTrip::class,'station_id');
    }

    public function prices()
    {
      return $this->hasMany(tripPrice::class,'station_id');
    }
}
