<?php

namespace App\Http\Controllers\Admin\Exam;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Exam;

class SettingController extends Controller
{
    public function __construct()
    {
        view()->share('active', 'setting');
    }

    public function index(Exam $exam)
    {
        return view('admin.exam.setting', [
            'exam'  => $exam
        ]);
    }

    /**
     * @param Exam $exam
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Exam $exam)
    {
        $exam->delete();

        return redirect()->route('admin.home.index')
            ->with('success', 'Exam successfully removed');
    }

    /**
     * @param Exam $exam
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function publish(Exam $exam)
    {
        if($this->validator($exam) == false) {

            return redirect()->back()
                ->withErrors('There are various-question with no existing 2 option');
        }

        $exam->update([
            'is_public' =>  1
        ]);

        return redirect()->route('admin.exam.view', ['exam' => $exam])
            ->with('success', 'Successfully published');
    }

    /**
     * @param Exam $exam
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publishCancel(Exam $exam)
    {
        $exam->update([
            'is_public' =>  0
        ]);

        return redirect()->route('admin.exam.view', ['exam' => $exam])
            ->with('success', 'Successfully unpublished');
    }

    /**
     * @param Exam $exam
     * @return bool
     */
    protected function validator(Exam $exam)
    {
        $questions = $exam->questions;

        foreach ($questions as $question) {

            if($question->validate() == false) {

                return false;
            }
        }

        return true;
    }

    /**
     * @param Request $request
     * @param Exam $exam
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Exam $exam)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'description'   => 'required|min:10'
        ]);

        $exam->update([
            'name'          => $request->get('name'),
            'description'   => $request->get('description')
        ]);

        return redirect()->back()
            ->with('success', 'Successfully updated');
    }
}
