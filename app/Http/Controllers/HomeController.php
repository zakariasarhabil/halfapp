<?php

namespace App\Http\Controllers;

use App\Marketer;
use App\OfficeOwner;
use App\RealState;
use App\Request as AppRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view(
            'dashbord.layout.sidebar',
            [
               'office' => OfficeOwner::get()->count(),
               'marketer' => Marketer::get()->count(),
               'real_state' => RealState::get()->count(),
               'req' => AppRequest::get()->count(),

            ]
        );
    }
}
