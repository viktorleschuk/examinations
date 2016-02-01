<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantExamAnswer extends Model
{
    /**
     * @var string
     */
    protected $table = 'participant_exams_answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'participant_exam_id', 'question_id', 'answer_id',
        'answer_body', 'elapsed_time', 'score'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function participantExam()
    {
        return $this->belongsTo('App\Models\ParticipantExam');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function answer()
    {
        return $this->belongsTo('App\Models\Answer');
    }
}
