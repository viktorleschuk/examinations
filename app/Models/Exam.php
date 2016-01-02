<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{

    const LEVEL_EASY    = 1;
    const LEVEL_MEDIUM  = 2;
    const LEVEL_HARD    = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
        'level', 'time'
    ];


}
