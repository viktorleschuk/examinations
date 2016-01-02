<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    const TYPE_VARIOUS  = 1;
    const TYPE_TEXT     = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exam_id', 'title',
        'weight', 'type'
    ];
}
