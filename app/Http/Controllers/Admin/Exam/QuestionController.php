<?php

namespace App\Http\Controllers\Admin\Exam;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Exam;
use App\Models\Question;


class QuestionController extends Controller
{

    private $questionRules = [
        'title'     =>  'required',
        'weight'    =>  'required'
    ];

    /**
     * QuestionController constructor.
     */
    public function __construct()
    {
        view()->share('active', 'questions');
    }

    /**
     * @param Exam $exam
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Exam $exam)
    {
        return view('admin.exam.questions', [
            'exam'  => $exam
        ]);
    }

    /**
     * @param Exam $exam
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createQuestion(Exam $exam)
    {
        return view('admin.exam.create.question', [
            'exam'  => $exam
        ]);
    }

    /**
     * @param Request $request
     * @param Exam $exam
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postCreateQuestion(Request $request, Exam $exam)
    {
        $validator = Validator::make($request->all(), $this->questionRules);

        if ($validator->fails()) {

            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->messages());
        }



        Question::create([
            'exam_id'   => $exam->getKey(),
            'title'     => $request->get('title'),
            'weight'    => $request->get('weight'),
            'type'      => Question::getTypeByName($request->get('type'))
        ]);

//TODO message if successfully add question
        return redirect()->route('admin.exam.questions', ['exam' => $exam])
            ->with('success', 'Question successfully added');
    }

    public function edit(Exam $exam, Question $question)
    {
        return view('admin.exam.question.edit', [
            'exam'      => $exam,
            'question'  => $question
        ]);
    }

    public function delete(Exam $exam, Question $question)
    {
        $question->delete();

        return redirect()->back()
            ->with('message', 'Question successfully deleted');
    }

    public function postEdit(Exam $exam, Question $question, Request $request)
    {
        $validator = Validator::make($request->all(), $this->questionRules);

        if ($validator->fails()) {

            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->messages());
        }

        $question->update([
            'title'     => $request->get('title'),
            'weight'    => $request->get('weight')
        ]);
//TODO
        return redirect()->route('admin.exam.questions', ['exam' => $exam])
            ->with('message', 'Successfully editing');
    }
}
