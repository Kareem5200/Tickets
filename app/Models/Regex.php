<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regex extends Model
{
    use HasFactory;
    protected $table='regexs';
    protected $fillable=['country','regex'];
}
