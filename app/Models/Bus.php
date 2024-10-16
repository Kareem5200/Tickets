<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    protected $table='buses';
    protected $fillable=[
        'seats',
        'bus_number',
        'status'
    ];

    // public function tickets()
    // {
    //   return $this->hasMany(Ticket::class,'bus_id');
    // }
    public function maintenances(){
        return $this->hasMany(Maintenance::class,'bus_id');
    }
    public function trips()
    {
      return $this->hasMany(DriverTrip::class,'bus_id');
    }

}
