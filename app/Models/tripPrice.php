<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tripPrice extends Model
{
    use HasFactory;

    protected $table='trip_prices';
    protected $primaryKey=['stadium_id','station_id'];
    public $incrementing=false;
    protected $fillable=[
        'stadium_id',
        'station_id',
        'trip_price',
        'seat_price',
    ];
    public function station(){
        return $this->belongsTo(Station::class,'station_id');
    }

    public function stadium(){
        return $this->belongsTo(Stadium::class,'stadium_id');
    }
    // public function trip()
    // {
    //   return $this->belongsTo(DriverTrip::class);
    // }





}
