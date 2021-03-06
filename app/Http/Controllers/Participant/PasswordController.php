<?php

namespace App\Http\Controllers\Participant;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Controllers\Controller;

/**
 * Class PasswordController
 * @package App\Http\Controllers\Participant
 */
class PasswordController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmail()
    {
        return view('participant.auth.passwords.email');
    }

    /**
     * @param null $token
     * @return $this
     * @throws NotFoundHttpException
     */
    public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        return view('participant.auth.passwords.reset')->with('token', $token);
    }
}
