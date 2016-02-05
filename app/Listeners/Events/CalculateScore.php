<?php

namespace App\Listeners\Events;

use App\Models\ParticipantExam;
use App\Models\ParticipantExamAnswer;

/**
 * Class CalculateScore
 * @package App\Listeners\Events
 */
class CalculateScore
{

    /**
     * @param ParticipantExamAnswer $answer
     */
    public function handle(ParticipantExamAnswer $answer)
    {
        $participantExam = $answer->getAttribute('participantExam');
        $participantExam->load('participantExamsAnswers');
        $participantExam->update([
            'score' => $participantExam->totalScore()
        ]);
    }
}