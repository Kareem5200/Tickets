<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllMatches extends Model
{
    use HasFactory;

    protected $table="matches";
    protected $fillable=[
        'stadium_id',
        'competition_id',
        'match_time',
        'match_date'
    ];

public function competition(){

    return $this->belongsTo(Competition::class,'competition_id');
}
public function stadium(){

    return $this->belongsTo(Stadium::class,'stadium_id','id');
}
public function tickets(){

    return $this->hasMany(Ticket::class,'match_id');
}
public function trips(){

    return $this->hasMany(DriverTrip::class,'match_id');
}

public function teams(){

    return $this->belongsToMany(Team::class,'match_teams','match_id','teams_id');
}









}
