<?php

namespace App\Http\Controllers\Admin\Exam;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Answer;
use App\Http\Requests;
use App\Models\Exam;

/**
 * Class AnswerController
 * @package App\Http\Controllers\Admin\Exam
 */
class AnswerController extends Controller
{
    /**
     * AnswerController constructor.
     */
    public function __construct()
    {
        view()->share('active', 'questions');
        view()->share('TITLE', 'Answer - create');
    }

    /**
     * @param Exam $exam
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Exam $exam, Question $question)
    {
        return view('admin.exam.answer.create', [
            'exam'      => $exam,
            'question'  => $question
        ]);
    }

    /**
     * @param Exam $exam
     * @param Question $question
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Exam $exam, Question $question, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255'
        ]);

        if ($question->answers()->getQuery()->where('is_correct', true)->count() != 0 && ($request->get('is_correct') == true)) {

            return redirect()->back()
                ->withErrors('Correct answer already exists! (question can have, 1 correct answer)');
        }

        Answer::create([
            'question_id'   => $question->getKey(),
            'title'         => $request->get('title'),
            'is_correct'    => $request->get('is_correct') ? 1 : 0
        ]);

        return redirect()->back()
            ->with('success', 'Various successfully added');
    }

    /**
     * @param Answer $answer
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Answer $answer)
    {
        $answer->delete();

        return redirect()->back()
            ->with('success', 'Answer various successfully deleted.');
    }
}
