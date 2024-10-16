<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [

        'type',
        'status',
        'user_id',
        'dependent_id',
        'buy_date',
        'department_id',
        'match_id',
        'bus_id',
        'refund_date',
        'qrcode',
        // 'trip_date'
    ];

    public function user()
  {
    return $this->belongsTo(User::class,'user_id');
  }
  public function dependent()
  {
    return $this->belongsTo(Dependent::class,'dependent_id');
  }
  public function department()
  {
    return $this->belongsTo(Department::class,'department_id');
  }
  public function trip()
  {
    return $this->belongsTo(DriverTrip::class,'bus_id','bus_id');
  }
  public function match()
  {
    return $this->belongsTo(AllMatches::class,'match_id');
  }



}
