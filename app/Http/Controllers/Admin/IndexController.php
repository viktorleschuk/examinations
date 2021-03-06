<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Models\Exam;

/**
 * Class IndexController
 * @package App\Http\Controllers\Admin
 */
class IndexController extends Controller
{
    /**
     * IndexController constructor.
     */
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

    public function home()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {

            return redirect(route('admin.exams.index'));
        } else {

            return redirect(route('admin.auth.getLogin'));
        }
    }

}
