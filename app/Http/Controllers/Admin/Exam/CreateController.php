<?php

namespace App\Http\Controllers\Admin\Exam;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Exam;

class CreateController extends Controller
{
    public function __construct()
    {
        view()->share('active', 'create');
    }

    public function create()
    {
        return view('admin.exam.create');
    }

    public function postCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'description'       => 'required',
            'time'              => 'required',
            'level'             => 'required'
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->messages());
        }

        $exam = Exam::create([
            'name'          =>  $request->get('name'),
            'description'   =>  $request->get('description'),
            'time'          =>  $request->get('time'),
            'level'         =>  Exam::getLevelByName($request->get('level'))
        ]);

        return redirect()->route('admin.exam.view', [
            'exam'  =>  $exam->getKey()
        ]);
    }
}
