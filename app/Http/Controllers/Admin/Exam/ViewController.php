<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Exam;

/**
 * Class ViewController
 * @package App\Http\Controllers\Admin\Exam
 */
class ViewController extends Controller
{
    /**
     * InfoController constructor.
     */
    public function __construct()
    {
        view()->share('active', 'information');
        view()->share('TITLE', 'Information');
    }

    /**
     * @param Exam $exam
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Exam $exam)
    {
        return view('admin.exam.info', [
            'exam'  => $exam
        ]);
    }
}
