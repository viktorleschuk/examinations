<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Models\Exam;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    /**
     * InfoController constructor.
     */
    public function __construct()
    {
        view()->share('active', 'information');
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
