<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $table='maintenance';
    protected $fillable=[
        'maintenance_descrption',
        'maintenance_price',
        'maintenance_date',
        'bus_id',
    ];



    public function bus(){
        return $this->belongsTo(Bus::class,'bus_id');
    }
}
