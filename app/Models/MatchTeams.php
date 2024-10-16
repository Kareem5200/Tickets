<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchTeams extends Model
{
    use HasFactory;
    protected $table="match_teams";
    protected $primary=['match_id','teams_id'];
    protected $fillable=['match_id','teams_id'];
}
