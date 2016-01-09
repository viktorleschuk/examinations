<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
}
