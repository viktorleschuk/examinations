<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParticipantExam;
use App\Http\Requests;
use App\Models\ParticipantExamAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $pendingExam = ParticipantExam::getPendingExams();
        $pendingExam->load('participant', 'participant.user', 'exam');
        return view('admin.exam.pending', [
            'exams' => $pendingExam
        ]);
    }

    /**
     * @param ParticipantExam $participantExam
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function check(ParticipantExam $participantExam)
    {
        $textQuestion = $participantExam->participantExamsAnswers()->getQuery()
            ->whereNotNull('answer_body')
            ->whereNull('score')
            ->first();

        if ($textQuestion == null) {

            $participantExam->update([
                'status'    => ParticipantExam::STATUS_COMPLETED,
                'score'     => $participantExam->participantExamsAnswers->sum('score')
            ]);

            return redirect()->route('admin.exams.index')
                ->with('success', 'Checking completed.');
        }

        return $this->getCheckPage($participantExam, $textQuestion);
    }

    /**
     * @param ParticipantExam $participantExam
     * @param ParticipantExamAnswer $answer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCheckPage(ParticipantExam $participantExam, ParticipantExamAnswer $answer)
    {
        if ($participantExam->getKey() != $answer->getAttribute('participant_exam_id')) {

            return view('errors.404');
        }

        $answers = ParticipantExamAnswer::where('participant_exam_id', $participantExam->getKey())->whereNotNull('answer_body')->get();

        $answer->load('question', 'question.exam');

        return view('admin.exam.check.question', ['participantExam' => $participantExam, 'answer' => $answer, 'answers' => $answers]);
    }

    /**
     * @param ParticipantExam $participantExam
     * @param ParticipantExamAnswer $answer
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function setScore(ParticipantExam $participantExam, ParticipantExamAnswer $answer, Request $request)
    {
        if ($participantExam->getKey() != $answer->getAttribute('participant_exam_id')) {

            return view('errors.404');
        }

        $validator = Validator::make($request->all(), [
            'score'     => 'required|numeric'
        ]);

        $score = $request->get('score');

        $error = null;

        if (!($score >= 0 && $score <= $answer->question->getAttribute('weight'))) {

            $error = 'Score must be between interval 0 - question weight.';
        }

        if ($validator->fails() || $error != null) {

            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->messages())
                ->with('error', $error);
        }

        $answer->update([
             'score'    => $request->get('score')
            ]);

        return $this->check($participantExam);
    }
}
