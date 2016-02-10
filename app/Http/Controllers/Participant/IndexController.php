<?php

namespace App\Http\Controllers\Participant;

use App\Models\Exam;
use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class IndexController
 * @package App\Http\Controllers\Participant
 */
class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $participant = auth()->user()->participant->load('participantExams');
        $exams = Exam::getPublishedExams();
        $exams->load('questions');
        return view('participant.exam.index', [
            'exams'         => $exams,
            'participant'   => $participant,
            'TITLE'         => 'Exams'
        ]);
    }
}
