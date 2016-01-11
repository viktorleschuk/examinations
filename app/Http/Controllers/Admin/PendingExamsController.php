<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class PendingExamsController extends Controller
{
    public function __construct()
    {
        view()->share('active', 'pending');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'Under construction';
    }

}
