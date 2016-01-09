<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Exam;
use App\Models\Participant;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home.index');
    }

    public function exams()
    {
        return view('admin.exam.index', [
            'exams' => Exam::all()
        ]);
    }

    public function participants()
    {
        $participants = Participant::all();

        return view('admin.home.participants', [
            'participants'  => $participants
        ]);
    }
}
