<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'division',
        'image_url',
    ];

    public function users()
    {
            return $this->hasMany(User::class);
    }

    public function matches(){

        return $this->belongsToMany(AllMatches::class,'match_teams','match_id','teams_id');


    }
}
