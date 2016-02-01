<?php

namespace App\Http\Controllers\Admin\Exam;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Http\Requests;
use App\Models\Exam;


class QuestionController extends Controller
{

    private $questionRules = [
        'title'     =>  'required|max:255',
        'weight'    =>  'required',
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
        $exam->load('questions', 'questions.answers');

        return view('admin.exam.questions', [
            'exam'  => $exam
        ]);
    }

    /**
     * @param Exam $exam
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Exam $exam)
    {
        return view('admin.exam.question.create', [
            'exam'  => $exam
        ]);
    }

    /**
     * @param Request $request
     * @param Exam $exam
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Exam $exam)
    {
        $this->validate($request, $this->questionRules);

        Question::create([
            'exam_id'   => $exam->getKey(),
            'title'     => $request->get('title'),
            'weight'    => $request->get('weight'),
            'type'      => $request->get('type')
        ]);

        return redirect()->route('admin.exam.questions', ['exam' => $exam])
            ->with('success', 'Question successfully added');
    }

    /**
     * @param Exam $exam
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Exam $exam, Question $question)
    {
        if (!$question->getAttribute('exam_id') == $exam->getKey()) {

            return redirect()->route('admin.exams.index')
                ->withErrors('This question is not belong to this exam');
        }

        return view('admin.exam.question.edit', [
            'exam'      => $exam,
            'question'  => $question
        ]);
    }

    /**
     * @param Exam $exam
     * @param Question $question
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Exam $exam, Question $question)
    {
        if (!$question->getAttribute('exam_id') == $exam->getKey()) {

            return redirect()->back('admin.exams.index')
                ->withErrors('This question is not belong to this exam');
        }

        $question->delete();

        return redirect()->back()
            ->with('success', 'Question successfully deleted');
    }

    /**
     * @param Exam $exam
     * @param Question $question
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Exam $exam, Question $question, Request $request)
    {
        $this->validate($request, $this->questionRules);

        $question->update([
            'title'     => $request->get('title'),
            'weight'    => $request->get('weight'),
            'type'      => $request->get('type')
        ]);

        return redirect()->route('admin.exam.questions', ['exam' => $exam])
            ->with('success', 'Successfully editing');
    }

    /**
     * @param Exam $exam
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Exam $exam, Question $question)
    {
        return view('admin.exam.question.view', [
            'exam'      => $exam,
            'question'  => $question
        ]);
    }
}
