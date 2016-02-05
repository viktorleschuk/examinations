<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Participant;
use App\Http\Requests;
use Illuminate\Http\Request;

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

        return view('admin.participants.index', [
            'participants'  => $participants,
        ]);
    }

    public function downloadCv(Participant $participant)
    {
        $path = Participant::getPathForCV() . $participant->getAttribute('cv_file');
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $name = 'cv_file_' . $participant->getFullNameForCV() . '.' . $ext;
        return response()->download($path, $name);
    }

    public function delete(Participant $participant)
    {
        $user = $participant->user;
        $participant->delete();
        $user->delete();
        return redirect()->back()
            ->with('success', 'Participant successfully removed!');
    }

    public function edit(Participant $participant)
    {
        $participant->load('user');
        $countries = Country::all();

        return view('admin.participants.edit', [
            'participant'   => $participant,
            'countries'     => $countries
        ]);
    }

    public function view(Participant $participant)
    {
        return view('admin.participants.view', [
            'participant' => $participant
        ]);
    }

    public function update(Participant $participant, Request $request)
    {
        $this->validate($request, [
            'first_name'    => 'required|max:255',
            'last_name'     => 'required|max:255',
            'country_id'    => 'required|numeric',
            'email'         => 'required|email|max:255|unique:users,role',
            'phone_number'  => 'required|max:255',
            'city'          => 'required|max:255',
            'skype_name'    => 'max:255',
        ]);

        $participant->user->update([
            'first_name'    => $request->get('first_name'),
            'last_name'     => $request->get('last_name'),
            'email'         => $request->get('email')
        ]);

        $participant->update([
            'country_id'    => $request->get('country_id'),
            'phone_number'  => $request->get('phone_number'),
            'city'          => $request->get('city'),
            'skype_name'    => $request->get('skype_name')
        ]);

        return redirect()->route('admin.participant.view', ['participant' => $participant])
            ->with('success', 'Successfully update!');
    }
}
