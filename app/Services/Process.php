<?php

namespace App\Services;

use App\Models\Exam;
use Carbon\Carbon;
use App\Models\Question as QuestionModel;

class Process {

    /**
     * @var
     */
    protected $participantExam;

    /**
     * @var Exam
     */
    protected $exam;

    /**
     * Question constructor.
     * @param Exam $exam
     */
    public function __construct(Exam $exam)
    {
        $this->participantExam = auth()->user()->participant->getParticipantExam($exam);
        $this->exam = $exam;
    }

    /**
     * @return bool
     */
    public function doesParticipantPassQuestion(QuestionModel $question)
    {
        if ($this->participantExam == null || ($this->timeLeft() <= 0) || ($question->getAttribute('exam_id') != $this->exam->getKey())) {

            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function lastTime()
    {
        return $this->participantExam->getAttribute('created_at')->addSeconds($this->exam->getAttribute('time'));
    }

    /**
     * @return mixed
     */
    public function timeLeft()
    {
        return $this->lastTime()->diffInSeconds(Carbon::now());
    }
}