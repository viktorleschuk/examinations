<?php

namespace App\Http\Controllers\Admin\Exam;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Exam;

/**
 * Class CreateController
 * @package App\Http\Controllers\Admin\Exam
 */
class CreateController extends Controller
{
    /**
     * CreateController constructor.
     */
    public function __construct()
    {
        view()->share('active', 'create');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.exam.create');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required|max:255',
            'description'       => 'required|max:255',
            'time'              => 'required|numeric',
            'level'             => 'required|in:' . join(',', array_keys(Exam::getAvailableLevels()))
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->messages());
        }

        $exam = Exam::create([
            'name'          =>  $request->get('name'),
            'description'   =>  $request->get('description'),
            'time'          =>  $request->get('time')*60,
            'level'         =>  $request->get('level')
        ]);

        return redirect()->route('admin.exam.view', [
            'exam'  =>  $exam->getKey()
        ]);
    }
}
