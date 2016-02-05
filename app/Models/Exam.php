<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{

    const LEVEL_JUNIOR    = 1;
    const LEVEL_MIDDLE  = 2;
    const LEVEL_SENIOR    = 3;

    /**
     * @var string
     */
    protected $table = 'exams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
        'level', 'time', 'is_public'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Models\Question', 'exam_id', 'id');
    }


    /**
     * @return array
     */
    public static function getAvailableLevels()
    {
        return array(
            self::LEVEL_JUNIOR  => 'Junior',
            self::LEVEL_MIDDLE  => 'Middle',
            self::LEVEL_SENIOR  => 'Senior'
        );
    }

    /**
     * @return mixed
     */
    public function getLevelName()
    {
        return array_get(self::getAvailableLevels(), $this->getAttribute('level'));
    }

    /**
     * @return mixed
     */
    public static function getPublishedExams()
    {
        return self::select()
            ->where('is_public', 1)
            ->get();
    }

    /**
     * @return mixed
     */
    public function getTotalWeight()
    {
        $this->load('questions');
        return $this->getAttribute('questions')
            ->sum('weight');
    }

    /**
     * @param Participant $participant
     * @return bool
     */
    public function doesParticipantCompleteExam(Participant $participant)
    {

        foreach($participant->participantExams as $exam) {

            if($this->getKey() == $exam->getAttribute('exam_id')) {

                return true;
            }
        }

        return false;
    }

    /**
     * @param Participant $participant
     * @param Exam $exam
     * @return mixed
     */
    public function getParticipantExamStatus(Participant $participant, Exam $exam)
    {
        return $participant->participantExams
            ->where('exam_id', $exam->getKey())
            ->get();
    }

    /**
     * @param ParticipantExam $participantExam
     * @return mixed
     */
    public function getStatusName(ParticipantExam $participantExam)
    {
        return ParticipantExam::getStatusByIndex($participantExam->getAttribute('status'));
    }

    /**
     * @return array
     */
    public function getAvailablePosition()
    {
        return ParticipantExam::getAvailablePosition();
    }

    /**
     * @return bool
     */
    public function validate()
    {
        foreach($this->getAttribute('questions') as $question) {

            if (!$question->validate() || !$question->hasCorrectAnswer()) {

                return false;
            }
        }

        return true;
    }
}
