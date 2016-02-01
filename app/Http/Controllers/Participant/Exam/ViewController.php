<?php

namespace App\Http\Controllers\Participant\Exam;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Exam;

class ViewController extends Controller
{
    /**
     * @param Exam $exam
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Exam $exam)
    {
        $participant = auth()->user()->participant->load('participantExams');

        return view('participant.exam.view', [
            'exam'          => $exam,
            'participant'   => $participant,
            'TITLE'         => $exam->getAttribute('name')
        ]);
    }

}
