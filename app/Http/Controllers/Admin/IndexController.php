<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Exam;

class IndexController extends Controller
{
    public function __construct()
    {
        view()->share('active', 'exams');
        view()->share('TITLE', 'Exams');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.exam.index', [
            'exams' => Exam::all()
        ]);
    }

}
