<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Http\Requests;

class ParticipantsController extends Controller
{
    public function __construct()
    {
        view()->share('active', 'participants');
        view()->share('TITLE', 'Participants');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participants = Participant::all();
        $participants->load('user')->load('country');

        return view('admin.home.participants', [
            'participants'  => $participants,
            'active'        => 'participants'
        ]);
    }

    public function downloadCv(Participant $participant)
    {
        $path = Participant::getPathForCV() . $participant->getAttribute('cv_file');
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $name = 'cv_file_' . $participant->getFullNameForCV() . '.' . $ext;
        return response()->download($path, $name);
    }
}
