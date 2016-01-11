<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Exam;

class ParticipantsController extends Controller
{
    public function __construct()
    {
        view()->share('active', 'participants');
    }

    public function index(Exam $exam)
    {
        return 'Under construction';
    }
}
