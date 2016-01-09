<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Exam;

class InfoController extends Controller
{
    public function __construct()
    {
        view()->share('active', 'info');
    }

    public function index(Exam $exam)
    {
        return view('admin.exam.info', [
            'exam'  => $exam
        ]);
    }
}
