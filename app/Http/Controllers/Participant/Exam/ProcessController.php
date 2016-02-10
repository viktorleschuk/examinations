<?php

namespace App\Http\Controllers\Participant\Exam;

use Illuminate\Support\Facades\Validator;
use App\Models\ParticipantExamAnswer;
use App\Http\Controllers\Controller;
use App\Models\ParticipantExam;
use Illuminate\Http\Request;
use App\Services\Process;
use App\Models\Question;
use App\Http\Requests;
use App\Models\Exam;
use Carbon\Carbon;

/**
 * Class ProcessController
 * @package App\Http\Controllers\Participant\Exam
 */
class ProcessController extends Controller
{
    /**
     * ProcessController constructor.
     */
    public function __construct()
    {
        view()->share('TITLE', 'Process');
    }

    /**
     * @param Request $request
     * @param Exam $exam
     * @return \Illuminate\Http\RedirectResponse
     */
    public function start(Request $request, Exam $exam)
    {
        $this->validate($request, [
            'position' => 'required|integer',
        ]);

        if ($request->get('js-enabled') != 1) {

            redirect()->route('participant.errors.no-js');
        }

        if ((new Process($exam))->doesParticipantStartPassExam()) {

            ParticipantExam::create([
                'status'            => ParticipantExam::STATUS_IN_PROCESS,
                'participant_id'    => auth()->user()->participant->getKey(),
                'exam_id'           => $exam->getKey(),
                'desired_position'  => $request->get('position'),
            ]);

            return redirect()->route('participant.exam.question', ['exam' => $exam]);

        } else {

            redirect()->route('participant.exam.view', ['exam' => $exam])
                ->with('info', sprintf('You can\'t starting passing exam, because status of this exam - %s',
                    auth()->user()->participant->getParticipantExam($exam)->getStatusName()));
        }
    }

    /**
     * @param Exam $exam
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uniqueQuestion(Exam $exam)
    {

        $participantExam = auth()->user()->participant->getParticipantExam($exam);

        $data = $participantExam->participantExamsAnswers()->getQuery()
            ->where(function($query) {
                $query->whereNull('answer_body')
                    ->whereNotNull('answer_id');
            })
            ->orWhere(function($query) {
                $query->whereNull('answer_id')
                    ->whereNotNull('answer_body');
            })
                ->lists('question_id');

        $question = $exam->questions()->getQuery()->whereNotIn('id', $data)->first();

        if ($question == null) {

            return $this->endExam($participantExam, $participantExam->getAttribute('created_at')->diffInSeconds(Carbon::now()));
        }

        if ($question->getAttribute('type') == Question::TYPE_VARIOUS) {

            $question->load('answers');
        }

        return redirect()->route('participant.exam.process.question', [
            'exam'      => $exam,
            'question'  => $question
        ]);
    }

    /**
     * @param Exam $exam
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getQuestion(Exam $exam, Question $question)
    {
        $service = new Process($exam);

        if ($service->doesParticipantPassQuestion($question)) {

            $participantExamAnswer = ParticipantExamAnswer::where([
                'participant_exam_id'   => auth()->user()->participant->getParticipantExam($exam)->getKey(),
                'question_id'           => $question->getKey()
            ])->first();

            $exam->load('questions');

            return view('participant.exam.process.question', [
                'exam'      => $exam,
                'question'  => $question,
                'time'      => $service->timeLeft(),
                'previous'  => $participantExamAnswer
            ]);
        }

        if($service->timeLeft() <= 0) {

            return $this->timeOver($exam);
        }

        return view('errors.404');

    }

    /**
     * @param Request $request
     * @param Question $question
     * @param Exam $exam
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleQuestion(Exam $exam, Question $question, Request $request)
    {
        if (!$request->get('jquery_enabled')) {

            return redirect()->route('participant.errors.no-js');
        }

        $validator = Validator::make($request->all(), [
            'answer'    => 'required'
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator->messages());
        }

        $participantExam = auth()->user()->participant->getParticipantExam($exam);
        $timeToQuestions = ParticipantExamAnswer::where(['participant_exam_id' => $participantExam->getKey()])->sum('elapsed_time');
        $elapsedTime = Carbon::now()->diffInSeconds($participantExam->getAttribute('created_at')) - $timeToQuestions;

        $participantExamAnswer = ParticipantExamAnswer::updateOrCreate(
            [
                'question_id'           => $question->getKey(),
                'participant_exam_id'   => auth()->user()->participant->getParticipantExam($exam)->getKey()
            ],
            [
                'answer_id'             => $question->getAttribute('type') == Question::TYPE_VARIOUS
                    ? $request->get('answer')
                    : null,
                'answer_body'           => $question->getAttribute('type') == Question::TYPE_TEXT
                    ? $request->get('answer')
                    : null,
                'score'                 => $question->getAttribute('type') == Question::TYPE_VARIOUS
                    ? $this->checkVariousQuestion($question, $request->get('answer'))
                    : null,
            ]);

        $participantExamAnswer->increment('elapsed_time', $elapsedTime);

        return $this->uniqueQuestion($exam);
    }

    /**
     * @param Exam $exam
     * @return \Illuminate\Http\RedirectResponse
     */
    public function timeOver(Exam $exam)
    {
        $participantExam = auth()->user()->participant->getParticipantExam($exam);

        return $this->endExam($participantExam, $exam->getAttribute('time'));
    }

    protected function checkVariousQuestion(Question $question, $answer_id)
    {
        if ($question->answers()->getQuery()->where('is_correct', true)->first()->getKey() == $answer_id) {

            return $question->getAttribute('weight');
        }

        return 0;
    }

    public function endExam(ParticipantExam $participantExam, $time)
    {
        $participantExam->load('participantExamsAnswers');

        if ($time == null) {

            $time = 0;
        }

        if (!$participantExam->doesExistTextAnswers()) {

            $participantExam->update([
                'status'        => ParticipantExam::STATUS_COMPLETED,
                'elapsed_time'  => $time
            ]);

            return redirect()->route('participant.exam.view', ['exam' => $participantExam->getAttribute('exam')])
                ->with('info', 'Exam completed! (all question has answers or time over)');
        }

        $participantExam->update([
            'status'        => ParticipantExam::STATUS_PENDING,
            'elapsed_time'  => $time
        ]);

        return redirect()->route('participant.exam.view', ['exam' => $participantExam->getAttribute('exam')])
        ->with('info', 'Exam completed! (all question has answers or time over) You will see, when admin checked it. ');
    }

    public function saveTime(Exam $exam, Question $question)
    {
        $participantExam = auth()->user()->participant->getParticipantExam($exam);

        $participantExamAnswer = ParticipantExamAnswer::where([
            'participant_exam_id'   => $participantExam->getKey(),
            'question_id'           => $question->getKey()
        ])->first();

        if ($participantExamAnswer == null) {

            $participantExamAnswer = ParticipantExamAnswer::create([
                'participant_exam_id'   => $participantExam->getKey(),
                'question_id'           => $question->getKey(),
            ]);
        }

        $timeToQuestions = ParticipantExamAnswer::where(['participant_exam_id' => $participantExam->getKey()])->sum('elapsed_time');
        $elapsedTime = Carbon::now()->diffInSeconds($participantExam->getAttribute('created_at')) - $timeToQuestions;

        $participantExamAnswer->increment('elapsed_time', $elapsedTime);
    }
}
