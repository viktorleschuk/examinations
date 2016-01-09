<?php

namespace App\Http\Controllers\Admin\Exam;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Exam;

class IndexController extends Controller
{
    public function create()
    {
        return view('admin.exam.create.exam');
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
