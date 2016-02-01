<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParticipantExam;
use App\Http\Requests;

class PendingExamsController extends Controller
{
    /**
     * PendingExamsController constructor.
     */
    public function __construct()
    {
        view()->share('active', 'pending');
        view()->share('TITLE', 'Pending exams');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(ParticipantExam::getPendingExams());
        $pendingExam = ParticipantExam::getPendingExams();
        $pendingExam->load('participant', 'participant.user', 'exam');
//        dd($pendingExam);
        return view('admin.exam.pending', [
            'exams' => $pendingExam
        ]);
    }

    public function startCheck(ParticipantExam $participantExam)
    {

    }
}
