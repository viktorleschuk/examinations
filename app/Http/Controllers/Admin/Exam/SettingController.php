<?php

namespace App\Http\Controllers\Admin\Exam;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Exam;

/**
 * Class SettingController
 * @package App\Http\Controllers\Admin\Exam
 */
class SettingController extends Controller
{
    /**
     * SettingController constructor.
     */
    public function __construct()
    {
        view()->share('active', 'setting');
        view()->share('TITLE', 'Exam (settings)');
    }

    /**
     * @param Exam $exam
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

        return redirect()->route('admin.exams.index')
            ->with('success', 'Exam successfully removed');
    }

    /**
     * @param Exam $exam
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function publish(Exam $exam)
    {
        if (count($exam->questions) == 0) {

            return redirect()->back()
                ->withErrors('No questions in the exam');
        }

        if (!$exam->validate()) {

            return redirect()->back()
                ->withErrors('There are various-question with no existing 2 option, or not existing correct answer');
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
