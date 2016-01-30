<?php

namespace App\Http\Controllers\Participant;

use App\Models\Exam;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $participant = auth()->user()->participant->load('participantExams');

        return view('participant.exam.index', [
            'exams' => Exam::getPublishedExams(),
            'participant' => $participant
        ]);
    }
}
