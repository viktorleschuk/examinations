<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantExam extends Model
{
    const STATUS_IN_PROCESS     = 1;
    const STATUS_PENDING        = 2;
    const STATUS_COMPLETED      = 3;

    const POSITION_FRONT    = 1;
    const POSITION_BACK     = 2;
    const POSITION_QA       = 3;
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
        'status', 'score', 'elapsed_time', 'desired_position'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function participant()
    {
        return $this->belongsTo('App\Models\Participant');
    }

    /**
     * @param $index
     * @return string
     */
    public static function getStatusByIndex($index)
    {
        switch($index) {

            case self::STATUS_IN_PROCESS:
                return 'In process';
            case self::STATUS_PENDING:
                return 'Pending';
            case self::STATUS_COMPLETED:
                return 'Completed';
        }
    }

    public static function getAvailablePosition()
    {
        return array(
            self::POSITION_FRONT    => 'Front end',
            self::POSITION_BACK     => 'Back end',
            self::POSITION_QA       => 'Q&A'
        );
    }

    public function getElapsedTime()
    {
        return $this->getAttribute('participantExamsAnswers')
            ->sum('elapsed_time');
    }
}
