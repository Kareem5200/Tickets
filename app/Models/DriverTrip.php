<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverTrip extends Model
{
    use HasFactory;
    protected $table='driver_trips';
    protected $primaryKey=['driver_id','match_id','bus_id','station_id','trip_date'];
    public $incrementing=false;
    protected $fillable=[
        'driver_id',
        'bus_id',
        'station_id',
        'trip_date',
        'travel_time',
        'match_id'
    ];

    public function driver()
    {
      return $this->belongsTo(Employee::class,'driver_id');
    }
    // public function stadium()
    // {
    //   return $this->belongsTo(Stadium::class,'stadium_id');
    // }
    public function bus()
    {
      return $this->belongsTo(Bus::class,'bus_id');
    }
    public function station()
    {
      return $this->belongsTo(Station::class,'station_id');
    }
    public function match()
    {
      return $this->belongsTo(AllMatches::class,'match_id');
    }

    public function tickets()
    {
      return $this->hasMany(Ticket::class,'bus_id','bus_id');
    }






}
