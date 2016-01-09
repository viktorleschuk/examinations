<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id',
        'title', 'is_correct'
    ];

//    /**
//     * The attributes that should be casted to native types.
//     *
//     * @var array
//     */
//    protected $casts = [
//        'question_id'   => 'integer',
//        'title'         =>  'string',
//        ''
//    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }
}
