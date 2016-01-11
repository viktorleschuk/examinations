<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Exam;

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
