<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantExam extends Model
{
    const STATUS_IN_PROCESS     = 1;
    const STATUS_PENDING        = 2;
    const STATUS_COMPLETED      = 3;

    /**
     * @var string
     */
    protected $table = 'participant_exams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'participant_id', 'exam_id',
        'status', 'score', 'elapsed_time'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participantExamsAnswers()
    {
        return $this->hasMany('App\Models\ParticipantExamAnswer', 'participant_exam_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo('App\Models\Exam');
    }
}
